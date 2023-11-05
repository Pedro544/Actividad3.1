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
        <option value="Categoria1">Categoria1</option>
        <option value="Categoria2">Categoria2</option>
        <option value="Categoria3">Categoria3</option>
        <option value="Categoria4">Categoria4</option>
      </select>
      <button type="submit">Insertar producto</button>
    </form>
  </body>
</html>
<?php else :?>
  <?php
  include "conexion.php";
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
  //Inserción en la tabla del nuevo producto.
  // $precio = floatval($precio);
  // $nombreImagen = $imagen["name"];
  // $conexion->exec("INSERT INTO productos VALUES (NULL, $");
  ?>

  <?php else:?>

  <?php endif;?>

<?php endif;?>