<?php
require_once 'autoload.php';
require_once '../libs/Slim/Slim.php';

Slim\Slim::registerAutoloader();

$app = new Slim\Slim();
$app->response->header('Content-Type', 'application/json');

$app->get('/productos', function(){
    
    $productos = ProductoDAO::listar();
    
    echo json_encode($productos);
});

$app->get('/productos/:id', function($id){
    
    $producto = ProductoDAO::obtener($id);
    
    echo json_encode($producto);
});

$app->post('/productos', function() use($app) {
    
    $body = $app->request()->getBody(); // {"categorias_id":"1","nombre":"Producto de prueba","precio":200.90,"stock":"23", "descripcion":"Cualquier descripción"}
    $producto = json_decode($body);
    
    $producto->creado = date('Y-m-d');
    $producto->estado = 1;
    
    ProductoDAO::registrar($producto);
    
    $data = ['message' => 'Registro guardado satisfactoriamente']; 
    echo json_encode($data);
});

$app->put('/productos/:id', function($id) use($app){
    
    $body = $app->request()->getBody(); // {"categorias_id":"1","nombre":"Producto modificado","precio":100.90,"stock":"23", "descripcion":"Cualquier descripción","estado":"1"}
    $producto = json_decode($body);
    
    $productoOriginal = ProductoDAO::obtener($id);
    
    if(isset($producto->categorias_id))
        $productoOriginal->categorias_id = $producto->categorias_id;
    if(isset($producto->nombre))
        $productoOriginal->nombre = $producto->nombre;
    if(isset($producto->precio))
        $productoOriginal->precio = $producto->precio;
    if(isset($producto->stock))
        $productoOriginal->stock = $producto->stock;
    if(isset($producto->descripcion))
        $productoOriginal->descripcion = $producto->descripcion;
    if(isset($producto->estado))
        $productoOriginal->estado = $producto->estado;
    
    ProductoDAO::actualizar($productoOriginal);
    
    $data = ['message' => 'Registro actualizado satisfactoriamente']; 
    echo json_encode($data);
});

$app->delete('/productos/:id', function($id){
    
    ProductoDAO::eliminar($id);
    
    $data = ['message' => 'Registro eliminado satisfactoriamente']; 
    echo json_encode($data);
});

$app->run();