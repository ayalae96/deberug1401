<?php
// Lógica de negocio [cite: 25]
session_start();
if (!isset($_SESSION['sprite'])) {
    header("Location: index.php"); // Redirección si no hay datos 
    exit();
}
$spritePath = "juego/recursos/sprites/" . $_SESSION['sprite'] . ".png";

// Carga la interfaz [cite: 24]
include '../views/captura_view.php';
?>