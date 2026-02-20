<?php
// Si el dato está en la sesión, construimos la ruta
if (isset($_SESSION['sprite'])) {
    $spritePath = "../juego/recursos/sprites/" . $_SESSION['sprite'] . ".png";
} else {
    // Una imagen por defecto si algo falla
    $spritePath = "../juego/recursos/sprites/0001.png"; 
}
?>
<link rel="stylesheet" href="../../public/css/captura.css">

<div id="mainContainer" class="main-container">
    
    <div id="actionArea" class="turtle-box">
        
        <div class="box-inner-clipper">
            
            <img class="img-original" src="<?php echo $spritePath; ?>" alt="Pokemon inicial a capturar">
            
            <div class="final-stack">
                <img class="img-circle" src="../juego/recursos/sprites/vacio.png" alt="Fondo">
                
                <img class="img-turtle-final" src="../juego/recursos/sprites/ball.png" alt="Capturado">
            </div>

        </div>
    </div>

    <div class="progress-container">
        <div id="progFill" class="progress-fill"></div>
    </div>

</div>

<script src="../../public/js/captura.js"></script>