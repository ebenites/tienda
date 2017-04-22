<?php
require_once './autoload.php';
require_once './libs/nusoap/nusoap.php';

function listar() {
    return UsuarioDAO::listar();
}

function registrar($username, $password, $idrol, $nombres, $email) {
    $usuario = new Usuario();
    $usuario->username = $username;
    $usuario->password = $password;
    $usuario->roles_id = $idrol;
    $usuario->nombres = $nombres;
    $usuario->email = $email;
    UsuarioDAO::registrar($usuario);
    return "Registro satisfactorio"; // string
}

$server = new soap_server();
$server->configureWSDL('TiendaCatalogo', "http://www.tecsup.edu.pe/tienda-ws");


//Tipo de dato completjo Producto (Objeto Usuario)
$server->wsdl->addComplexType(
    'Usuario',
    'complexType',
    'struct',
    'all',
    '',
    [ 
        "id"  => ["name"=>"id", "type"=>"xsd:int"], 
	"nombres" => ["name"=>"nombres", "type"=>"xsd:string"],
        "username" => ["name"=>"username", "type"=>"xsd:string"],
        "password" => ["name"=>"password", "type"=>"xsd:string"],
        "roles_nombre" => ["name"=>"roles_nombre", "type"=>"xsd:string"],
        "email" => ["name"=>"email", "type"=>"xsd:string"],
    ]
);

//Tipo de dato completjo UsuarioArray (Lista de Usuario)
$server->wsdl->addComplexType(
    'UsuarioArray',	// Nombre 
    'complexType',      // Tipo de Clase
    'array',            // Tipo de PHP
    '',					// Compositor
    'SOAP-ENC:Array',	// Restricted Base
    [],
    [['ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Usuario[]']],
    'tns:Usuario'
);


// registar las operacines
$server->register('listar', [], ['result' => 'tns:UsuarioArray']);

$server->register('registrar', ['username' => 'xsd:string', 'password' => 'xsd:string', 'idrol' => 'xsd:int', 'nombres' => 'xsd:string', 'email' => 'xsd:string'], ['result' => 'xsd:string']);

$server->service();