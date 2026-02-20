<?php
// app/controllers/MainController.php

require_once '../app/models/Usuario.php';

class MainController {
    private $usuarioModel;

    public function __construct() {
        // Usamos la variable $conn que viene del include global en index.php
        global $conn; 
        $this->usuarioModel = new Usuario($conn);
    }
    
    public function gestionarNavegacion() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // --- MANEJO DE POST (Formularios) ---
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
            if ($_POST['action'] == 'login') {
                $this->procesarLogin();
            } elseif ($_POST['action'] == 'registrar') {
                $this->procesarRegistro();
            }
        }

        // --- SISTEMA DE RUTAS (GET) ---
        // Si el usuario está logueado, ve las rutas privadas
        if (isset($_SESSION['usuario_id'])) {
            return $this->obtenerRutaPrivada();
        } 
        
        // Si no, ve las rutas públicas
        return $this->obtenerRutaPublica();
    }

    private function procesarLogin() {
        $alias = $_POST['text'] ?? '';
        $pass = $_POST['password'] ?? '';

        if (empty($alias) || empty($pass)) {
            $_SESSION['error'] = "Por favor ingrese usuario y contraseña.";
            return;
        }

        $usuario = $this->usuarioModel->login($alias, $pass);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['IdUsuario'];
            $_SESSION['nombre'] = $usuario['Alias'];
            // Redirigir para limpiar el POST y entrar al dashboard
            header("Location: index.php?seccion=Inicio");
            exit();
        } else {
            $_SESSION['error'] = "Credenciales incorrectas.";
        }
    }

    private function procesarRegistro() {
        $nombre = $_POST['nombre'] ?? '';
        $pass = $_POST['password'] ?? '';
        $pass2 = $_POST['password2'] ?? '';
        // El inicial lo guardamos en sesión temporalmente o podrías crear otro modelo para guardarlo en la tabla 'equipo'
        $inicial = $_POST['inicial'] ?? null; 

        if (empty($nombre) || empty($pass) || empty($inicial)) {
            $_SESSION['error'] = "Todos los campos y el inicial son obligatorios.";
            return;
        }

        if ($pass !== $pass2) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            return;
        }

        // Llamamos al Modelo
        $resultado = $this->usuarioModel->registrar($nombre, $pass);

        if ($resultado['exito']) {
            $_SESSION['usuario_id'] = $resultado['id'];
            $_SESSION['nombre'] = $nombre;
            $_SESSION['sprite'] = $inicial; // Guardamos visualmente cuál eligió
            
            header("Location: index.php?seccion=Captura"); // <--- REDIRIGE A CAPTURA            exit();
        } else {
            $_SESSION['error'] = $resultado['mensaje'];
        }
    }

    private function obtenerRutaPrivada() {
        $seccion = $_GET['seccion'] ?? 'Inicio';
        
        // Lista blanca de archivos permitidos en views
        $rutas = [
            'Inicio'      => 'inicio.php',
            'Pokedex'     => 'pokedex.php',
            'Contactanos' => 'contactanos.php',
            'Informacion' => 'info.php',
            'Tutorial'    => 'tutorial.php',
            'Jugar'       => '../../juego/juego.php', // Ojo con esta ruta si está en subcarpeta
            'Captura'     => 'captura_view.php', // <--- AGREGA ESTA LÍNEA
            'Logout'      => '../controllers/logout.php' // Caso especial
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
?>