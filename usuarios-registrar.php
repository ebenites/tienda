<?php
require_once './autoload.php';
require_once './includes/security.php';

$usuario = new Usuario();
$usuario->username = $_POST['username']; //filter_input(INPUT_POST, 'username');
$usuario->password = $_POST['password'];
$usuario->nombres = $_POST['nombres'];
$usuario->email = $_POST['email'];
$usuario->roles_id = $_POST['roles_id'];

UsuarioDAO::registrar($usuario);

Flash::success('Registro guardado satisfactoriamente.');

header('location: usuarios-listar.php');