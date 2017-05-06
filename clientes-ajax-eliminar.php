<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

ClienteDAO::eliminar($id);

$message = ['type' => 'success', 'detail' => 'Registro eliminado satisfactoriamente'];
echo json_encode($message);