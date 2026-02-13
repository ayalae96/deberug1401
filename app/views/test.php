
    <meta charset="UTF-8">
    <title>Poké-FX Ultra Engine</title>
    <style>
        :root {
            --primary: #fff;
            --glow: rgba(255,255,255,0.6);
        }

        body {
            background: #000;
            color: white;
            font-family: 'Orbitron', sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* --- UI LATERAL --- */
        #sidebar {
            width: 250px;
            background: rgba(15, 15, 15, 0.9);
            border-right: 2px solid #333;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 100;
        }

        .btn-type {
            background: #222;
            border: 1px solid #444;
            color: #aaa;
            padding: 10px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 2px;
            transition: 0.3s;
        }

        .btn-type.active {
            background: var(--primary);
            color: black;
            box-shadow: 0 0 20px var(--glow);
            border-color: white;
        }

        /* --- VIEWPORT --- */
        #viewport {
            flex-grow: 1;
            position: relative;
            background: radial-gradient(circle at center, #111 0%, #000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Capa de Flash para impactos */
        #flash-overlay {
            position: absolute;
            inset: 0;
            background: white;
            opacity: 0;
            pointer-events: none;
            z-index: 50;
        }

        .entity {
            width: 150px;
            height: 150px;
            border: 4px solid var(--primary);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.9);
            position: absolute;
            z-index: 10;
            box-shadow: 0 0 50px var(--glow);
        }

        #player { left: 10%; }
        #target { right: 10%; }

        /* --- PARTÍCULAS ULTRA --- */
        .p {
            position: absolute;
            pointer-events: none;
            border-radius: 50%;
            mix-blend-mode: screen;
            filter: blur(2px);
        }

        /* Estela de movimiento */
        .p::after {
            content: '';
            position: absolute;
            width: 100%; height: 100%;
            background: inherit;
            border-radius: inherit;
            filter: blur(5px);
            opacity: 0.5;
        }

        @keyframes ultra-launch {
            0% { transform: scale(0) translate(0,0) rotate(0deg); opacity: 0; }
            20% { opacity: 1; transform: scale(1.2) translate(20px, 0); }
            100% { transform: scale(0.2) translate(var(--tx), var(--ty)) rotate(360deg); opacity: 0; }
        }

        @keyframes projectile-path {
            0% { left: 20%; transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5) rotate(180deg); }
            100% { left: 75%; transform: scale(1); opacity: 0; }
        }

        /* --- ANIMACIONES DE ESTADO --- */
        .shake { animation: screen-shake 0.4s cubic-bezier(.36,.07,.19,.97) both; }
        @keyframes screen-shake {
            10%, 90% { transform: translate3d(-4px, 0, 0); }
            20%, 80% { transform: translate3d(8px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-12px, 0, 0); }
            40%, 60% { transform: translate3d(12px, 0, 0); }
        }

        .btn-attack {
            position: absolute;
            bottom: 40px;
            padding: 15px 50px;
            background: var(--primary);
            color: black;
            border: none;
            font-weight: bold;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 0 30px var(--glow);
            transition: 0.2s;
        }
        .btn-attack:hover { transform: scale(1.1); filter: brightness(1.2); }

    </style>


    <div id="sidebar">
        <h2 style="font-size: 14px; color: #555;">TIPO ELEMENTAL</h2>
        <div id="typeGrid" style="display: flex; flex-direction: column; gap: 5px;"></div>
    </div>

    <div id="viewport">
        <div id="flash-overlay"></div>
        <div id="player" class="entity">JUGADOR</div>
        <div id="target" class="entity">OBJETIVO</div>
        <button class="btn-attack" onclick="engine.ultimateAttack()">¡ATAQUE DEFINITIVO!</button>
    </div>

    <script>
        const TYPES = {
            fuego: { c: '#FF4D00', particles: 50, behavior: 'spiral' },
            electrico: { c: '#FFEF00', particles: 30, behavior: 'zap' },
            psiquico: { c: '#FF00E4', particles: 40, behavior: 'distort' },
            agua: { c: '#009DFF', particles: 60, behavior: 'wave' },
            siniestro: { c: '#3300FF', particles: 40, behavior: 'vortex' }
        };

        class UltraEngine {
            constructor() {
                this.current = 'fuego';
                this.viewport = document.getElementById('viewport');
                this.flash = document.getElementById('flash-overlay');
                this.init();
            }

            init() {
                const grid = document.getElementById('typeGrid');
                Object.keys(TYPES).forEach(t => {
                    const btn = document.createElement('button');
                    btn.className = 'btn-type';
                    btn.id = `btn-${t}`;
                    btn.innerText = t;
                    btn.onclick = () => this.setType(t);
                    grid.appendChild(btn);
                });
                this.setType('fuego');
            }

            setType(t) {
                this.current = t;
                document.querySelectorAll('.btn-type').forEach(b => b.classList.remove('active'));
                document.getElementById(`btn-${t}`).classList.add('active');
                document.documentElement.style.setProperty('--primary', TYPES[t].c);
                document.documentElement.style.setProperty('--glow', TYPES[t].c + '99');
            }

            createParticle(x, y, config) {
                const p = document.createElement('div');
                p.className = 'p';
                const size = Math.random() * 30 + 10;
                
                p.style.width = `${size}px`;
                p.style.height = `${size}px`;
                p.style.left = `${x}px`;
                p.style.top = `${y}px`;
                p.style.background = TYPES[this.current].c;
                p.style.boxShadow = `0 0 20px ${TYPES[this.current].c}`;
                
                p.style.setProperty('--tx', `${config.tx}px`);
                p.style.setProperty('--ty', `${config.ty}px`);
                
                p.style.animation = `ultra-launch ${config.duration}s ease-out forwards`;
                
                this.viewport.appendChild(p);
                p.addEventListener('animationend', () => p.remove());
            }

            triggerFlash() {
                this.flash.style.background = TYPES[this.current].c;
                this.flash.animate([
                    { opacity: 0.8 },
                    { opacity: 0 }
                ], { duration: 500, easing: 'ease-out' });
            }

            ultimateAttack() {
                const pRect = document.getElementById('player').getBoundingClientRect();
                const tRect = document.getElementById('target').getBoundingClientRect();
                
                // 1. CARGA (Partículas hacia adentro)
                for(let i=0; i<TYPES[this.current].particles; i++) {
                    setTimeout(() => {
                        this.createParticle(pRect.right, pRect.top + pRect.height/2, {
                            tx: Math.random() * 200 - 100,
                            ty: Math.random() * 200 - 100,
                            duration: 0.5
                        });
                    }, i * 10);
                }

                // 2. DISPARO (Proyectil Principal)
                setTimeout(() => {
                    const core = document.createElement('div');
                    core.className = 'entity';
                    core.style.width = '60px';
                    core.style.height = '60px';
                    core.style.background = 'white';
                    core.style.left = '20%';
                    core.style.boxShadow = `0 0 100px 20px ${TYPES[this.current].c}`;
                    core.style.animation = 'projectile-path 0.6s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards';
                    
                    this.viewport.appendChild(core);

                    // 3. IMPACTO
                    core.addEventListener('animationend', () => {
                        core.remove();
                        this.triggerFlash();
                        this.viewport.classList.add('shake');
                        
                        // Explosión masiva de partículas
                        for(let i=0; i<80; i++) {
                            const angle = (Math.PI * 2 / 80) * i;
                            const dist = 300 + Math.random() * 200;
                            this.createParticle(tRect.left, tRect.top + tRect.height/2, {
                                tx: Math.cos(angle) * dist,
                                ty: Math.sin(angle) * dist,
                                duration: 1 + Math.random()
                            });
                        }

                        setTimeout(() => this.viewport.classList.remove('shake'), 500);
                    });
                }, 600);
            }
        }

        const engine = new UltraEngine();
    </script>
