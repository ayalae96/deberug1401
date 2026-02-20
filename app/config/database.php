<?php
// 1. Priorizamos las variables de Render, si no existen (como en tu PC), usa los valores por defecto
$host = getenv('DB_HOST') ?: 'localhost';
$nombre_db = getenv('DB_NAME') ?: 'juegopokemon';
$usuario_db = getenv('DB_USER') ?: 'root';
$clave_db = getenv('DB_PASS') ?: ''; 
$puerto = getenv('DB_PORT') ?: '3306'; // MySQL usa el 3306 por defecto

// 2. Intentar la conexión con el puerto incluido
$conn = new mysqli($host, $usuario_db, $clave_db, $nombre_db, $puerto);

// 3. Verificar errores
if ($conn->connect_error) {
    // En producción es mejor no mostrar detalles técnicos, pero para desarrollo esto ayuda:
    die("Error de conexión: " . $conn->connect_error);
}

// 4. Establecer el juego de caracteres (muy importante para nombres con tildes o eñes)
$conn->set_charset("utf8mb4");
?>