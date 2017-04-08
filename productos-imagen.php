<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

$producto = ProductoDAO::obtener($id);

if($producto == null)
    die("Registro no encontrado");

//var_dump($producto);

// Cargamos la imagen

$filename = Constantes::RUTA_IMAGENES . $producto->imagen_nombre;

$finfo = finfo_open(FILEINFO_MIME_TYPE); // devuelve el tipo mime de su extensión
$content_type = finfo_file($finfo, $filename);
finfo_close($finfo);

header("Content-type: ".$content_type); // $producto->imagen_tipo
header("Content-Length: ".filesize($filename)); // $producto->imagen_tamanio
header("Content-Disposition: inline; filename=".$producto->imagen_nombre); //'Content-Disposition: attachment' si se quiere forzar la descarga

echo file_get_contents($filename);