<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = $_GET['id'];

$cliente = ClienteDAO::obtener_foto($id);

header("Content-type: ".$cliente->foto_tipo);
header('Content-Length: '.$cliente->foto_tamanio);
header("Content-Disposition: inline; filename=foto.jpg"); //'Content-Disposition: attachment' si se quiere forzar la descarga

echo $cliente->foto;