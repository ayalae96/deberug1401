    <header>
        <h1>PokeSmash!</h1>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <div style="text-align: right;">
                Entrenador: <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong> | 
                <a href="../app/controllers/logout.php">Salir</a>
            </div>
        <?php endif; ?>
    </header>