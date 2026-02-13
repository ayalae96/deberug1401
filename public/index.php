<?php
// index.php - Ubicado en /public/

// Salimos de /public/ para entrar en /conector/ y /app/
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
            <a href="index.php?seccion=Pokedex">Pokedex (CRUD)</a>
            <a href="index.php?seccion=Contactanos">Contacto</a>
        <?php else: ?>
            <a href="index.php?seccion=Login">Entrar</a>
            <a href="index.php?seccion=Registro">Registrarse</a>
        <?php endif; ?>
    </nav>

    <main id="ContenedorPrincipal">
        <?php 
            // Carga concordante desde la carpeta de vistas [cite: 42]
                $path = __DIR__ . "/../app/views/" . $vista_a_cargar;            if (file_exists($path)) {
                include $path;
            } else {
                echo "<p>Contenido no disponible temporalmente.</p>";
            }
        ?>
    </main>

    <footer>Ayalae96@2025-2026</footer>
    <script src="js/index.js"></script>
</body>
</html>