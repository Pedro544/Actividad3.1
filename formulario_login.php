<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Pedro García Santana">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <?php if (empty($_POST)):?>
    <h1>Autenticación para entrar a la aplicación de productos</h1>
    <form action="formulario_login.php" method="post">
      <label for="correo">Correo electrónico</label>
      <input type="email" name="correo" id="correo" required>
      <label for="contraseña">Contraseña</label>
      <input type="password" name="contraseña" id="contraseña" required>
      <button type="submit">Enviar</button>
    </form>
    <?php else:?>
    <?php
    include "conexion.php";
    $consulta_ejecutada = $conexion->query(
        "SELECT 
        id,
        correo_electronico,
        contrasena_hash
        FROM usuarios
        WHERE correo_electronico='{$_POST["correo"]}'"
    );
    $datos = $consulta_ejecutada->fetch(PDO::FETCH_ASSOC);
    if (!$datos || !password_verify($_POST["contraseña"],$datos["contrasena_hash"])){
        echo "<h2>ERROR: El correo electrónico o contraseña no es correcto.</h2>";
    } else{
        session_start();
        $_SESSION["ID_USUARIO"] = $datos["id"];
        header("Location: index.php");
    }
    ?>
    <?php endif;?>
  </body>
</html>