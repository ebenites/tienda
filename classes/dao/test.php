<?php
require_once '../common/Constantes.php';
require_once '../common/Conexion.php';
require_once '../dto/Producto.php';
require_once './ProductoDAO.php';

$lista = ProductoDAO::listar();
var_dump($lista);

foreach ($lista as $producto){
    echo $producto->precio2String() . '<br/>';
}