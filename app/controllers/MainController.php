<?php
// app/controllers/MainController.php

class MainController {
    
    public function gestionarNavegacion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si hay una petición POST, procesamos el login antes de cargar la vista
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'login') {
            $this->procesarLogin();
        }

        if (isset($_SESSION['usuario_id'])) {
            return $this->obtenerRutaPrivada();
        } 
        
        return $this->obtenerRutaPublica();
    }

    private function procesarLogin() {
        global $conn; // Viene de conectorSQL.php
        
        // Validación de Backend: No permitir datos vacíos 
        $alias = isset($_POST['text']) ? $conn->real_escape_string($_POST['text']) : '';
        $pass = $_POST['password'] ?? '';

        if (empty($alias) || empty($pass)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            return;
        }

        $sql = "SELECT IdUsuario, alias, contrasena FROM usuario WHERE alias = '$alias'";
        $resultado = $conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($pass, $fila['contrasena'])) {
                $_SESSION['usuario_id'] = $fila['IdUsuario'];
                $_SESSION['nombre'] = $fila['alias'];
                header("Location: index.php?seccion=Inicio");
                exit();
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
            }
        } else {
            $_SESSION['error'] = "El usuario no existe.";
        }
    }

// app/controllers/MainController.php

private function obtenerRutaPrivada() {
    $seccion = $_GET['seccion'] ?? 'Inicio';
    
    // Mapeo exacto según tu árbol de carpetas en /app/views/
    $rutas = [
        'Inicio'      => 'inicio.php',
        'Pokedex'     => 'pokedex.php',
        'Contactanos' => 'contactanos.php',
        'Informacion' => 'info.php',
        'Tutorial'    => 'tutorial.php',
        'Jugar'       => 'juego/juego.php' // Nota la subcarpeta si aplica
    ];

    return $rutas[$seccion] ?? 'inicio.php';
}

private function obtenerRutaPublica() {
    $seccion = $_GET['seccion'] ?? 'Login';
    $rutas = [
        'Login'    => 'login.php',
        'Registro' => 'registro.php'
    ];
    return $rutas[$seccion] ?? 'login.php';
}
}