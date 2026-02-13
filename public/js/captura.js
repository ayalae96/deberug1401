     // El JavaScript no necesita cambios, la lógica de control es la misma.
        const actionArea = document.getElementById('actionArea');
        const progFill = document.getElementById('progFill');
        const mainContainer = document.getElementById('mainContainer');

        let isPressing = false;
        let progress = 0;
        let isCompleted = false;
        let lastFrameTime = 0;

        let lastHeartTime = 0;
        let nextHeartDelay = 0;
        let mousePos = { x: 0, y: 0 };

        function spawnHeart(x, y) {
            const heart = document.createElement('div');
            heart.classList.add('heart');
            heart.innerText = '❤️';
            heart.style.left = `${x}px`;
            heart.style.top = `${y}px`;
            heart.style.setProperty('--rot', `${Math.random() * 60 - 30}deg`);
            heart.style.fontSize = `${Math.random() * 15 + 20}px`;
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 1200);
        }

        function update(timestamp) {
            if (!lastFrameTime) lastFrameTime = timestamp;
            const dt = timestamp - lastFrameTime;
            lastFrameTime = timestamp;

            if (!isCompleted) {
                if (isPressing) {
                    progress += (100 / 3000) * dt; // Carga en 3s
                    if (timestamp - lastHeartTime > nextHeartDelay) {
                        spawnHeart(mousePos.x, mousePos.y);
                        lastHeartTime = timestamp;
                        nextHeartDelay = Math.random() * 200 + 100;
                    }
                } else {
                    progress -= (100 / 6000) * dt; // Descarga en 6s
                }

                progress = Math.max(0, Math.min(100, progress));
                progFill.style.width = `${progress}%`;

                if (progress >= 100) {
                    isCompleted = true;
                    mainContainer.classList.add('completed');
                }
            }
            requestAnimationFrame(update);
        }

        function getCoords(e) {
            const res = e.touches ? e.touches[0] : e;
            mousePos.x = res.clientX;
            mousePos.y = res.clientY;
        }

        function start(e) {
            if (isCompleted){
                                            alert("Felicidades! Capturase a tu primer Pokemon");

                return;
            } 
            isPressing = true;
            getCoords(e);
        }

        function stop() {
            isPressing = false;
        }

        actionArea.addEventListener('mousedown', start);
        actionArea.addEventListener('touchstart', (e) => { e.preventDefault(); start(e); }, {passive: false});
        window.addEventListener('mousemove', getCoords);
        window.addEventListener('touchmove', (e) => getCoords(e), {passive: false});
        window.addEventListener('mouseup', stop);
        window.addEventListener('touchend', stop);

        requestAnimationFrame(update)
        if(isCompleted){
                            alert("Felicidades! Capturase a tu primer Pokemon");

        };