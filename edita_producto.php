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
        $sentencia = $conexion->query("SELECT productos.id, productos.nombre FROM productos;");
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
      WHERE ID=".$_GET["producto"]);
    $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
    $conexion = null;
    ?>
    <form action="edita_producto.php?producto=<?php echo $id;?>" method="post">
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
    <h2>Mensaje de actualización</h2>
    <a href="index.php"><button type="button">Volver al principio</button></a>
    <a href="edita_producto.php?producto=<?php echo $_POST["producto"];?>">
      <button type="button">Volver a modificar</button>
    </a>
    <?php endif; ?>
  </body>
</html>