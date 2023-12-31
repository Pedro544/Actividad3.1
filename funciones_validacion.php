<?php
/**
 * Comprueba si el campo pasado como parámetro existe y su
 * valor es distinto de NULL.
 * 
 * Si es así, devuelve true, si no, devuelve false.
 */
function existeCampo($campo){
    return isset($campo);
}
/**
 * Comprueba si el parámetro representa un número o una string
 * numérica.
 * 
 * Si es así, devuelve true, si no, devuelve false.
 */
function esNumero($numero){
    return is_numeric($numero);
}
/**
 * Comprueba si el número pasado como parámetro tiene menos de
 * dos decimales.
 * 
 * Si es así, devuelve true, si no, devuelve false.
 */
function dosOMenosDecimales($numero){
    return strlen(substr(strrchr($numero,"."),1)) <= 2;
}
/**
 * Comprueba si el fichero pasado como parámetro representa una imagen.
 * 
 * Si es así, devuelve true, si no, devuelve false.
 */
function esImagen($imagen){
    return str_contains($imagen["type"],"image/");
}
/**
 * Comprueba si la cadena pasada como parámetro corresponde a una
 * de las cuatro categorías de productos que existen.
 * 
 * Si es así, devuelve true, si no, devuelve false.
 */
function categoriaValida($categoria){
    define("CATEGORIAS", array("1", "2", "3", "4")); //Valores en crear_producto.php
    return in_array($categoria,CATEGORIAS);
}
?>