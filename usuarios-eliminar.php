<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id']; //filter_input(INPUT_GET, 'id');

UsuarioDAO::eliminar($id);

Flash::success('Registro eliminado satisfactoriamente.');

header('location: usuarios-listar.php');