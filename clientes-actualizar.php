<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_POST['id'];   // id del producto a actualizar

$cliente = ClienteDAO::obtener($id);
$cliente->email = $_POST['email'];
$cliente->nombres = $_POST['nombres'];
$cliente->apellidos = $_POST['apellidos'];
$cliente->nacimiento = $_POST['nacimiento'];
$cliente->sexo = $_POST['sexo'];
$cliente->distritos_id = $_POST['distritos_id'];
$cliente->direccion = $_POST['direccion'];

if($_POST['password'] != ''){
    $cliente->password = $_POST['password'];
}

if($_FILES['foto']['error'] == 0){
    $cliente->foto = file_get_contents($_FILES['foto']['tmp_name']);
    $cliente->foto_tipo = $_FILES['foto']['type'];
    $cliente->foto_tamanio = $_FILES['foto']['size'];
}

ClienteDAO::actualizar($cliente);

Flash::success('Registro guardado satisfactoriamente');

header('location: clientes-listar.php');
