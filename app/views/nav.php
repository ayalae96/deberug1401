    <nav>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="index.php?seccion=Inicio">Inicio</a>
            <a href="index.php?seccion=Jugar">Jugar</a>
            <a href="index.php?seccion=Pokedex">Pokedex</a>
            <a href="index.php?seccion=Contactanos">Contacto</a>
            <a href="index.php?seccion=Informacion">Informacion</a>
            <a href="index.php?seccion=Tutorial">Tutorial</a>
        <?php else: ?>
            <a href="index.php?seccion=Login">Entrar</a>
            <a href="index.php?seccion=Registro">Registrarse</a>
        <?php endif; ?>
    </nav>