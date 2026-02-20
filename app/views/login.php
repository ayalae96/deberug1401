<h1>¡Bienvenido Entrenador!</h1>
<?php if(isset($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>
    <link rel="stylesheet" href="../../public/css/estilos-registro.css">
        <link rel="stylesheet" href="../../public/css/estilos-principales.css">


<div id="Registro">
    <form method="POST" action="">
        <input type="hidden" name="action" value="login">
        <legend>INICIA SESIÓN</legend>
        <label>Usuario:</label>
        <input type="text" name="text" required>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit" class="btn-registrar">Entrar</button>
    </form>
</div>