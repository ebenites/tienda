<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_POST['id'];   // id del registro a actualizar

$usuario = UsuarioDAO::obtener($id);
$usuario->username = $_POST['username']; //filter_input(INPUT_POST, 'username');
$usuario->nombres = $_POST['nombres'];
$usuario->email = $_POST['email'];
$usuario->roles_id = $_POST['roles_id'];
if(!empty($_POST['password'])){
    $usuario->password = $_POST['password'];
}

UsuarioDAO::actualizar($usuario);

Flash::success('Registro guardado satisfactoriamente.');

header('location: usuarios-listar.php');