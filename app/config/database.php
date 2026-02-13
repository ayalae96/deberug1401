<?php
$host = "localhost";
$usuario_db = "root";  // Cambia esto por tu usuario de MySQL
$clave_db = "";        // Cambia esto por tu contraseña de MySQL
$nombre_db = "test_smash"; // El nombre de tu base de datos

$conn = new mysqli($host, $usuario_db, $clave_db, $nombre_db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>