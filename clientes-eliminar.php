<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

ClienteDAO::eliminar($id);

Flash::success('Registro eliminado satisfactoriamente.');

header('location: clientes-listar.php');