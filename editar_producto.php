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
    <!--*Lo que se muestra si no se ha enviado nada por GET.-->
    <form action="editar_producto.php" method="get">
      <h2>Selecciona el producto a modificar:</h2>
      <select name="producto" id="producto">
        <option value="1">Producto 1</option>
        <option value="2">Producto 2</option>
        <option value="3">Producto 3</option>
        <option value="4">Producto 4</option>
      </select>
      <button type="submit">Modificar</button>
    </form>
    <!--*Lo que se muestra si se ha enviado algo por GET.-->
    <form action="editar_producto.php" method="post">
      <label for="nombre">Nombre del producto</label>
      <input type="text" name="nombre" id="nombre" value="Nombre del producto" required>
      <label for="precio">Precio del producto</label>
      <input type="number" name="precio" step="0.01" value="0" id="precio" required>
      <label for="imagen">Imagen del producto</label>
      <input type="file" name="imagen" id="imagen" required>
      <label for="categoria">Categoría del producto</label>
      <select name="categoria" id="categoria" required>
        <option value="1">Categoria1</option> 
        <option value="2">Categoria2</option>
        <option value="3" selected>Categoria3</option> <!--! Controlar QUÉ opción está seleccionada.-->
        <option value="4">Categoria4</option>
      </select>
      <button type="submit">Insertar producto</button>
    </form>
    <!--*Lo que se muestra si se ha enviado algo por POST.-->
    <h2>Mensaje de actualización</h2>
    <a href="index.php"><button type="button">Volver al principio</button></a>
    <a href="editar_producto.php"><button type="button">Volver a modificar</button></a>
  </body>
</html>