<?php
include "datos_conexion.php";
try{
    $conexion = new PDO("mysql:host=localhost;dbname=$database",$user_name,"$password");
    $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException){
    die("ERROR: Conexión fallida a la base de datos...");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Pedro García Santana">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mantenimiento de bases de datos</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>
        <h1>Mantenimiento de productos de tienda online</h1>
        <h2>¿Qué quieres hacer?</h2>
        <a href="crear_producto.php"><button type="button">Crear producto</button></a>
        <a href="listado_productos.php"><button>Consultar el listado de productos</button></a>
        <a href="modifica_producto.php"><button>Modificar producto</button></a>
        <a href="elimina_producto.php"><button>Eliminar producto</button></a>
    </body>
</html>