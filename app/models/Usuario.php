<?php
// app/models/Usuario.php

class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Validar usuario para Login
    public function login($alias, $password) {
        $alias = $this->conn->real_escape_string($alias);
        
        // Buscamos el usuario por su Alias
        $sql = "SELECT IdUsuario, Alias, Contrasena FROM usuario WHERE Alias = '$alias'";
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            // Verificar si la contraseña coincide con el hash
            if (password_verify($password, $usuario['Contrasena'])) {
                return $usuario;
            }
        }
        return false; // Retorna falso si falla
    }

    // Registrar nuevo usuario
    public function registrar($alias, $password) {
        $alias = $this->conn->real_escape_string($alias);

        // 1. Verificar si el usuario ya existe
        $checkSql = "SELECT IdUsuario FROM usuario WHERE Alias = '$alias'";
        $checkResult = $this->conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            return ["exito" => false, "mensaje" => "El nombre de usuario ya está ocupado."];
        }

        // 2. Encriptar contraseña
        $passHash = password_hash($password, PASSWORD_DEFAULT);

        // 3. Insertar en BD
        $sql = "INSERT INTO usuario (Alias, Contrasena, Puntos) VALUES ('$alias', '$passHash', 0)";

        if ($this->conn->query($sql) === TRUE) {
            return ["exito" => true, "id" => $this->conn->insert_id];
        } else {
            return ["exito" => false, "mensaje" => "Error SQL: " . $this->conn->error];
        }
    }
}
?>