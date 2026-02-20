<?php
require_once __DIR__ . '/../app/config/database.php'; 
require_once __DIR__ . '/../app/controllers/MainController.php';

$controller = new MainController();
$vista_a_cargar = $controller->gestionarNavegacion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PokeSmash! - Proyecto DAW</title>
    <link rel="stylesheet" href="css/estilos-principales.css">
    <link rel="stylesheet" href="css/estilos-dashboard.css">
</head>
<body>
    <header>
        <h1>PokeSmash!</h1>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <div style="text-align: right;">
                Entrenador: <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong> | 
                <a href="../app/controllers/logout.php">Salir</a>
            </div>
        <?php endif; ?>
    </header>

    <nav>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="index.php?seccion=Inicio">Inicio</a>
            <a href="index.php?seccion=Jugar">Jugar</a>
            <a href="index.php?seccion=Pokedex">Pokedex</a>
            <a href="index.php?seccion=Contactanos">Contacto</a>
            <a href="index.php?seccion=Informacion">Informacion</a>
        <?php else: ?>
            <a href="index.php?seccion=Login">Entrar</a>
            <a href="index.php?seccion=Registro">Registrarse</a>
        <?php endif; ?>
    </nav>

    <main id="ContenedorPrincipal">
        <?php 
                $path = __DIR__ . "/../app/views/" . $vista_a_cargar;            if (file_exists($path)) {
                include $path;
            } else {
                echo "<p>Contenido no disponible temporalmente.</p>";
                echo "<p style='color:red; font-weight:bold;'>DEBUG: PHP está buscando la vista exactamente en: <br>" . $path . "</p>";
            }
        ?>
    </main>

    <footer>Ayalae96@2025-2026</footer>
    <script src="js/index.js"></script>
</body>
</html>