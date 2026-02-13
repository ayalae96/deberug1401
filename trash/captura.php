
<script>alert("Dale cariño a tu inicial para que se deje capturar");</script>

<link rel="stylesheet" href="captura.css">
<div class="main-container" id="mainContainer">
        <div class="turtle-box" id="actionArea">
            <div class="box-inner-clipper">
                
                <?php echo '<img src="juego/recursos/sprites/'.$_SESSION['sprite'].'.png" class="img-original" alt="Tortuga">' ?>
                
                <div class="final-stack">
                    <img src="juego/recursos/sprites/ball.png" class="img-circle" alt="Círculo">
                    
                    <img src="juego/recursos/sprites/vacio.png" class="img-turtle-final" alt="Tortuga Final">
                </div>

            </div>
        </div>

        <div class="progress-container">
            <div class="progress-fill" id="progFill"></div>
        </div>
    </div>
    <script src="captura.js"></script>
