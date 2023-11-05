<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Pedro García Santana">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de producto</title>
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <?php if (empty($_POST)): ?> <!--Si $_POST está vacío es porque no se envió nada, así que se muestra el formulario.-->
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
    </form> <!--Las etiquetas de cierre de <body> y <html> están al final-->
    <?php else :?> <!--Si $_POST no está vacío es porque se enviaron los datos. Primero se hace la validación y luego se muestra el resultado.-->
    <!--Validación-->
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
    if (!esNumero($precio) || !dosOMenosDecimales($precio)){
      $errores[] = "El precio del producto no fue enviado, tiene caracteres no numéricos o más de 2 cifras decimales.";
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
    <!--Contenido (body)-->
    <?php if (empty($errores)):?> <!--Si no hubo errores, se insertan los datos, se mueve la imagen y se muestra un mensaje junto con botón de vuelta a menú principal-->
    <?php
    include "conexion.php";
    $insert = $conexion->exec("INSERT INTO productos VALUES (NULL, '$nombre', $precio, '$nombreImagen', '$categoria');");
    move_uploaded_file($imagen["tmp_name"],"imagenes_productos/$nombreImagen");
    ?>
    <h2>El producto fue registrado correctamente.</h2>
    <a href='index.php'><button type='button'>Volver al menú principal</button></a>
    <?php else: ?> <!--Si hubo errores, se muestran en pantalla junto con botón de vuelta a página de formulario-->
    <h2>Hubo una serie de errores al insertar el producto:</h2>
    <?php
    foreach ($errores as $error) {
      echo "<p>-$error</p>";
    }
    ?>
    <a href='crear_producto.php'><button type='button'>Volver a rellenar el formulario</button></a>
    </body>
</html>
    <?php endif; ?>
<?php endif;?>