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
    <title>PokeSmash! - Proyecto</title>
    <link rel="stylesheet" href="css/estilos-principales.css">
    <link rel="stylesheet" href="css/estilos-dashboard.css">
</head>
<body>

    <?php
        include __DIR__."/../app/views/header.php";
        include __DIR__ . "/../app/views/nav.php"; 
    ?>

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