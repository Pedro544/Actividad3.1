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
        <h1>Nuevo producto</h1>
        <h2>Ingresa la información del nuevo producto</h2>
        <form action="crear_producto.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre del producto</label>
            <input type="text" name="nombre" id="nombre">
            <label for="precio">Precio del producto</label>
            <input type="number" name="precio" id="precio">
            <label for="imagen">Imagen del producto</label>
            <input type="file" name="imagen" id="imagen">
            <label for="categoria">Categoría del producto</label>
            <select name="categoria" id="categoria">
                <option value="cat1">Categoria1</option>
                <option value="cat2">Categoria2</option>
                <option value="cat3">Categoria3</option>
                <option value="cat4">Categoria4</option>
            </select>
            <button type="submit">Insertar producto</button>
        </form>
    </body>
</html>