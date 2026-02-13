<?php
// app/controllers/logout.php
session_start();
session_destroy(); 
// CORRECCIÓN: Salir de app/controllers para llegar a public/index.php
header("Location: ../../public/index.php"); 
exit();
?>