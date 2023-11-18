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
    <h1>Autenticación para entrar a la aplicación de productos</h1>
    <form action="formulario_login.php" method="post">
      <label for="correo">Correo electrónico</label>
      <input type="email" name="correo" id="correo">
      <label for="contraseña">Contraseña</label>
      <input type="password" name="contraseña" id="contraseña">
      <button type="submit">Enviar</button>
    </form>
  </body>
</html>