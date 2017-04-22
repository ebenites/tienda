<?php
require_once './libs/nusoap/nusoap.php';

$wsdl = 'http://localhost/tienda/productos-ws.php?wsdl';
$cliente = new nusoap_client($wsdl, 'wsdl');

$result = $cliente->call('listar');

var_dump($result);