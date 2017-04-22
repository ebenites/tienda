<?php
require_once './libs/nusoap/nusoap.php';

$wsdl = 'http://localhost/tienda/usuarios-ws.php?wsdl';
$cliente = new nusoap_client($wsdl, 'wsdl');

$result = $cliente->call('listar');

var_dump($result);

$params = ['username' => 'jfarfan', 'password' => 'tecsup', 'idrol' => 2, 'nombres' => 'Jaime Farfan', 'email' => 'jfarfan@gmail.com'];
$result = $cliente->call('registrar', $params);

var_dump($result);

$result = $cliente->call('listar');

var_dump($result);