<?php
$host = getenv('DB_HOST') ?: 'localhost';
$nombre_db = getenv('DB_NAME') ?: 'juegopokemon';
$usuario_db = getenv('DB_USER') ?: 'root';
$clave_db = getenv('DB_PASS') ?: ''; 
$puerto = getenv('DB_PORT') ?: '3306'; 

$conn = new mysqli($host, $usuario_db, $clave_db, $nombre_db, $puerto);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>