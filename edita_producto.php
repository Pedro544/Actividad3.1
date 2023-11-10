<?php error_reporting(E_ERROR);?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Pedro García Santana">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificación de producto</title>
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <h1>Modificación de producto</h1>
    <?php if (empty($_GET)): ?>
    <form action="edita_producto.php?producto="<?php echo $_GET["producto"]?> method="get">
      <h2>Selecciona el producto a modificar:</h2>
      <select name="producto" id="producto">
        <?php
        include "conexion.php";
        $sentencia = $conexion->query("SELECT id, nombre FROM productos ORDER BY nombre;");
        $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
        while ($datos) {
          echo "<option value='".$datos["id"]."'>".$datos["nombre"]."</option'>";
          $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
        }
        ?>
      </select>
      <button type="submit">Modificar</button>
    </form>
    <?php elseif (empty($_POST)): ?>
    <?php
    $id = $_GET["producto"];
    include "conexion.php";
    $sentencia = $conexion->query(
      "SELECT 
      nombre, 
      precio, 
      categoría 
      FROM productos
      WHERE ID=".$_GET["producto"]
    );
    $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
    $conexion = null;
    ?>
    <form action="edita_producto.php?producto=<?php echo $id;?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="producto" value="<?php echo $id;?>">
      <label for='nombre'>Nombre del producto</label>
      <?php echo "<input type='text' name='nombre' id='nombre' value='".$datos["nombre"]."' required>";?>
      <label for='precio'>Precio del producto</label>
      <?php echo "<input type='number' name='precio' step='0.01' id='precio' value='".$datos["precio"]."' required>";?>
      <label for='imagen'>Imagen del producto</label>
      <input type='file' name='imagen' id='imagen' required>
      <label for='categoria'>Categoría del producto</label>
      <select name='categoria' id='categoria' required>
        <option value='1'<?php if($datos["categoría"] == 1){echo " selected";}?>>
          Categoria1
        </option>
        <option value='2'<?php if($datos["categoría"] == 2){echo " selected";}?>>
          Categoria2
        </option>
        <option value='3'<?php if($datos["categoría"] == 3){echo " selected";}?>>
          Categoria3
        </option>
        <option value='4'<?php if($datos["categoría"] == 4){echo " selected";}?>>
          Categoria4
        </option>
      </select>
      <button type='submit'>Cambiar producto</button>
    </form>
    <?php else: ?>
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
      $nombreImagenNueva = $imagen["name"];
    }
    if (!categoriaValida($categoria)){
      $errores[] = "La categoría del producto no coincide con ninguna de las que están registradas.";
    }
    ?>
    <?php if (empty($errores)):?>
    <?php
    include "conexion.php";
    $id_producto = $_POST["producto"];
    $nombreImagenVieja = $conexion->query(
      "SELECT imagen FROM productos WHERE id=$id_producto")
      ->fetch(PDO::FETCH_ASSOC)["imagen"];

    unlink("imagenes_productos/$nombreImagenVieja");
    move_uploaded_file($imagen["tmp_name"],"imagenes_productos/$nombreImagenNueva");
    $conexion->query(
      "UPDATE productos 
      SET nombre='$nombre', 
      precio=$precio, 
      imagen='$nombreImagenNueva', 
      categoría=$categoria 
      WHERE id=$id_producto;"
      );
    ?>
    <h2>El producto fue modificado correctamente</h2>
    <a href="index.php"><button type="button">Volver al principio</button></a>
    <?php else:?>
    <h2>Hubo una serie de errores al modificar el producto:</h2>
    <?php
      foreach ($errores as $error) {
        echo "<p>-$error</p>";
      }
    ?>
    <a href="edita_producto.php?producto=<?php echo $_POST["producto"];?>">
      <button type="button">Volver a modificar el producto</button>
    </a>
    <?php endif;?>
    <?php endif; ?>
  </body>
</html>