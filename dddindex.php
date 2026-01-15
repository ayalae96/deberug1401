<?php
// --- ZONA DE LÓGICA PHP (AL PRINCIPIO) ---

$mensaje_get = "";
$mensaje_post = "";

// 1. Lógica para GET (Navegación)
if (isset($_GET['seccion'])) {
    $seccion = htmlspecialchars($_GET['seccion']);
    echo'<script type="text/javascript">
        alert('+ $seccion +');
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea PHP - Solución Limpia</title>
</head>
<body>

    <h1>Tarea PHP: GET y POST</h1>

    <div style="background: #eee; padding: 10px;">
        <h3>Prueba GET (Navegación)</h3>
        <a href="index.php?seccion=Inicio">Inicio</a> | 
        <a href="index.php?seccion=Unidades">Unidades</a> | 
        <a href="index.php?seccion=Contacto">Contacto</a>
        
        <br><br>
    </div>

    <hr>

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

</body>
</html>