<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

$producto = ProductoDAO::obtener($id);

if($producto == null)
    die("Registro no encontrado");

// Eliminados el archivo
$filename = Constantes::RUTA_IMAGENES . $producto->imagen_nombre;
unlink($filename);

ProductoDAO::eliminar($id);

Flash::success('Registro eliminado satisfactoriamente');

header('location: productos-listar.php');