<?php
$user_name = "mitiendaonline";
$password = "1234";
$database = "mitiendaonline";
try{
    $conexion = new PDO("mysql:host=localhost;dbname=$database",$user_name,$password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException){
    die("ERROR: Conexión fallida a la base de datos :/");
}
?>