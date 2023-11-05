<?php if (empty($_POST)): ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Pedro García Santana">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de producto (Creación)</title>
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <h1>Nuevo producto</h1>
    <h2>Ingresa la información del nuevo producto</h2>
    <form action="crear_producto.php" method="post" enctype="multipart/form-data">
      <label for="nombre">Nombre del producto</label>
      <input type="text" name="nombre" id="nombre" required>
      <label for="precio">Precio del producto</label>
      <input type="number" name="precio" step="0.01" id="precio" required>
      <label for="imagen">Imagen del producto</label>
      <input type="file" name="imagen" id="imagen" required>
      <label for="categoria">Categoría del producto</label>
      <select name="categoria" id="categoria" required>
        <option value="1">Categoria1</option>
        <option value="2">Categoria2</option>
        <option value="3">Categoria3</option>
        <option value="4">Categoria4</option>
      </select>
      <button type="submit">Insertar producto</button>
    </form>
  </body>
</html>
<?php else :?>
  <?php
  include_once "funciones_validacion.php";
  $nombre = $_POST["nombre"];
  $precio = $_POST["precio"];
  $imagen = $_FILES["imagen"];
  $categoria = $_POST["categoria"];
  $errores = array();

  if ($nombre == "" || esNumero($nombre)){
    $errores[] = "El nombre del producto no fue enviado o solo tiene caracteres numéricos.";
  }

  if (!esNumero($precio)){
    $errores[] = "El precio del producto no fue enviado o tiene caracteres no numéricos.";
  } else{
    $precio = floatval($precio);
  }

  if ($imagen["error"] == 4 || !esImagen($imagen)){
    $errores[] = "El fichero con la imagen no fue enviado o el formato no corresponde a una imagen.";
  } else{
    $nombreImagen = $imagen["name"];
  }

  if (!categoriaValida($categoria)){
    $errores[] = "La categoría del producto no coincide con ninguna de las que están registradas.";
  }
  ?>
  <?php if (empty($errores)): ?>
    <?php
    include "conexion.php";
    $insert = $conexion->exec("INSERT INTO productos VALUES (NULL, '$nombre', $precio, '$nombreImagen', '$categoria');");
    ?>
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="UTF-8">
        <meta name="author" content="Pedro García Santana">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Creación de producto (Resultado)</title>
        <link rel="stylesheet" href="styles/styles.css">
      </head>
      <body>
        <?php
        echo "<h2>El producto fue registrado correctamente.</h2>";
        echo "<a href='index.php'><button type='button'>Volver al menú principal</button></a>";
        ?>
      </body>
    </html>
  <?php else:?>
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="UTF-8">
        <meta name="author" content="Pedro García Santana">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Creación de producto (Resultado)</title>
        <link rel="stylesheet" href="styles/styles.css">
      </head>
      <body>
        <?php
        echo "<h2>Hubo errores al insertar el producto:</h2>";
        foreach ($errores as $error) {
          echo "<p>-$error</p>";
        }
        echo "<a href='crear_producto.php'><button type='button'>Volver a rellenar el formulario</button></a>";
        ?>
      </body>
    </html>
  <?php endif;?>

<?php endif;?>