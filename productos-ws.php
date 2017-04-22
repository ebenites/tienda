<?php
require_once './autoload.php';
require_once './libs/nusoap/nusoap.php';

function listar(){
    return ProductoDAO::listar(); // Lista de objetos
}

function obtener($id){
    return ProductoDAO::obtener($id); // Objeto
}

$server = new soap_server();
$server->configureWSDL('TiendaCatalogo', "http://www.tecsup.edu.pe/tienda-ws");

//Tipo de dato completjo Producto (Objeto Producto)
$server->wsdl->addComplexType(
    'Producto',
    'complexType',
    'struct',
    'all',
    '',
    [ 
        "id"  => ["name"=>"id", "type"=>"xsd:int"], 
	"nombre" => ["name"=>"nombre", "type"=>"xsd:string"],
        "categorias_nombre" => ["name"=>"categorias_nombre", "type"=>"xsd:string"],
        "precio" => ["name"=>"precio", "type"=>"xsd:double"],
    ]
);

//Tipo de dato completjo ProductoArray (Lista de Productos)
$server->wsdl->addComplexType(
    'ProductoArray',	// Nombre 
    'complexType',      // Tipo de Clase
    'array',            // Tipo de PHP
    '',					// Compositor
    'SOAP-ENC:Array',	// Restricted Base
    [],
    [['ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Producto[]']],
    'tns:Producto'
);

// registar las operacines
$server->register('listar', [], ['result' => 'tns:ProductoArray']);

$server->register('obtener', ['id' => 'xsd:int'], ['result' => 'tns:Producto']);

$server->service();