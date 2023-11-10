<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Pedro García Santana">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <table>
      <caption>Listado de productos</caption>
      <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Categoría</th>
        <th>Modificar</th>
        <th>Eliminar</th>
      </tr>
      <?php
      include "conexion.php";
      $sentencia_datos = $conexion->query(
        "SELECT 
          productos.id as ID, 
          productos.nombre AS producto, 
          precio, 
          imagen, 
          categorías.nombre AS categoria 
         FROM 
              productos 
         INNER JOIN 
              categorías 
         ON 
         categorías.id = productos.categoría 
         ORDER BY producto;"
      );
      $datos = $sentencia_datos->fetch(PDO::FETCH_ASSOC);
      while ($datos){
        echo "<tr>";
          echo "<td>". $datos["producto"] . "</td>";
          echo "<td>" . $datos["precio"] . "</td>";
          echo "<td>
                  <img src=\"imagenes_productos/".$datos["imagen"]."\" alt=".$datos["imagen"]." 
                  width=\"120\" height=\"120\">
                </td>";
          echo "<td>" . $datos["categoria"] . "</td>";
          echo "<td>
                  <a class=\"m-o-d\" href=\"edita_producto.php?producto=" . $datos["ID"] . "\">" .
                    "<img src=\"imgs/modify.png\" alt=\"modify.png\" width=\"90\" height=\"90\">
                  </a>    
                </td>";
          echo "<td>
                  <a class=\"m-o-d\" href=\"elimina_producto.php?producto=" . $datos["ID"] . "\">" .
                    "<img src=\"imgs/delete.png\" alt=\"delete.png\" width=\"120\" height=\"120\">
                  </a>    
                </td>";
        echo "</tr>";
        $datos = $sentencia_datos->fetch(PDO::FETCH_ASSOC);
      }
      $conexion = null;
      ?>
    </table>
  </body>
</html>