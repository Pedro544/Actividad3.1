<?php
session_start();
if (!isset($_SESSION["ID_USUARIO"])){
    header("Location: formulario_login.php");
}
session_regenerate_id(true);
setcookie(session_name(),"",0,"/");
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Pedro García Santana">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cierre de sesión</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>
        <h1>¡Nos vemos!</h1>
        <a href="formulario_login.php"><button>Volver al inicio</button></a>
    </body>
</html>