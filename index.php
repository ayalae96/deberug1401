<?php
// --- ZONA DE LÓGICA PHP (AL PRINCIPIO) ---

$mensaje_get = "";
$mensaje_post = "";

// 1. Lógica para GET (Navegación)
if (isset($_GET['seccion'])) {
    $seccion = htmlspecialchars($_GET['seccion']);
    echo'<script type="text/javascript">
        alert("'. $seccion .'");
        window.location.href="index.php";
        </script>';
    }

// 2. Lógica para POST (Formulario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    
    $mensaje_post = "
    <div style='border: 2px solid green; padding: 10px; background: #e6fffa;'>
        <h3>✅ Datos Recibidos por POST:</h3>
        <ul>
            <li>Nombre: $nombre</li>
            <li>Email: $email</li>
        </ul>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeSmash!</title>
    <link rel="stylesheet" href="estilos/estilos-principales.css">
    <link rel="stylesheet" href="estilos/estilos-dashboard.css">
    <link rel="stylesheet" href="estilos/estilos-registro.css">
</head>
<body>
    <header><h1>PokeSmash!</h1></header>
    <nav>
        <a href="index.php?seccion=Inicio">Inicio</a>
        <a href="index.php?seccion=Jugar">Jugar</a>
        <a href="index.php?seccion=Tutorial">Tutorial</a>
        <a href="index.php?seccion=Contactanos">Contactanos</a>
        <a href="index.php?seccion=Informacion">Informacion</a>
        <a href="index.php?seccion=Pokedex">Pokedex</a>

    </nav>
    <main>
        
    <div style="background: #fff3cd; padding: 10px;">
        <h3>Prueba POST (Formulario)</h3>
        <form action="index.php" method="POST">
            Nombre: <input type="text" name="nombre" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            <button type="submit">Enviar Datos</button>
        </form>

        <br>
        <?php echo $mensaje_post; ?>
    </div>
        <div id="Registro">
            <form action="Registro">
                <legend>Registrate</legend>
                <div>
                    <label for="Nombre">Nombres: </label>
                    <input type="text" id="nombre">
                </div>
                <div>
                    <label for="Nombre">Usuario: </label>
                    <input type="text" id="usuario">
                </div>
                <div id="iniciales">
                    <label for="Nombre">Inicial: <br></label>
                    <div id="0001" class="starter-seleccion"><img src="/juego/recursos/sprites/0001.png" alt=""></div>
                    <div id="0004" class="starter-seleccion"><img src="/juego/recursos/sprites/0004.png" alt=""></div>
                    <div id="0007" class="starter-seleccion"><img src="/juego/recursos/sprites/0007.png" alt=""></div>
                    
                </div>
                <div>
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
        <div id="Dashboard">
            <div id="Nombre">
            </div>
        </div>
    </main>
    <footer>Todos los derechos reservados Ayalae96@2025</footer>

</body>
<script src="scripts/index.js"></script>
</html>