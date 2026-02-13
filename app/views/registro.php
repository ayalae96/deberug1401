<?php

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $inicialId = isset($_POST['inicial']) ? $_POST['inicial'] : null;
    $_SESSION['sprite'] = $inicialId; // Guardamos el dato


    // 1. Validación de campos vacíos (Equivalente a tu JS)
    if (empty($nombre) || empty($pass) || empty($inicialId)) {
        $mensaje = "<script>alert('Por favor, completa todos los campos y selecciona un inicial.');</script>";
    } 
    // 2. Validación de contraseñas iguales
    else if ($pass !== $pass2) {
        $mensaje = "<script>alert('Las contraseñas no coinciden.');</script>";
    } 
    else {
        // Encriptar la contraseña
        $pass_segura = password_hash($pass, PASSWORD_DEFAULT);

        // 3. Insertar en la base de datos (Asegúrate de tener la columna 'inicial' en tu tabla)
        // Usamos alias para el nombre de usuario según tu código original
        $sql = "INSERT INTO usuario (alias, contrasena) VALUES ('$nombre', '$pass_segura')";

        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT IdUsuario, alias FROM usuario WHERE alias = '$nombre'";
            $resultado = $conn->query($sql);
                    $mensaje = "<script>alert('Las contraseñas no coinciden.');</script>";

            if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $_SESSION['usuario_id'] = $fila['IdUsuario'];
            $_SESSION['nombre'] = $fila['alias'];

            }
            // En lugar de mostrarRegistro(), redirigimos al login o dashboard
            header("Location: index.php?captura");
            exit();
        } else {
            $mensaje = "Error: " . $conn->error;
        }
    }
}
?>
<h1>Registrate para empezar tu aventura!</h1>
    <link rel="stylesheet" href="../../public/css/estilos-registro.css">
    <?php echo $mensaje; ?>

    <div id="Registro">
        <form method="POST" action="">
            <legend>REGÍSTRATE</legend>
            
            <div>
                <label>Nombre de Usuario:</label>
                <input type="text" name="nombre" placeholder="Tu alias" required>
            </div>

            <div>
                <label>Contraseña:</label>
                <input type="password" name="password" placeholder="Mínimo 6 caracteres" required>
            </div>

            <div>
                <label>Repetir Contraseña:</label>
                <input type="password" name="password2" placeholder="Confirma tu password" required>
            </div>

            <div id="iniciales-contenedor">
                <label>Selecciona tu Inicial:</label>
                <div class="opciones-pokemon">
                    <label class="starter-seleccion">
                        <input type="radio" name="inicial" value="0001" required>
                        <img src="../juego/recursos/sprites/0001.png" alt="Bulbasaur">
                    </label>

                    <label class="starter-seleccion">
                        <input type="radio" name="inicial" value="0004">
                        <img src="../juego/recursos/sprites/0004.png" alt="Charmander">
                    </label>

                    <label class="starter-seleccion">
                        <input type="radio" name="inicial" value="0007">
                        <img src="../juego/recursos/sprites/0007.png" alt="Squirtle">
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-registrar">Convertirse en Entrenador</button>
        </form>
    </div>
</body>
</html>