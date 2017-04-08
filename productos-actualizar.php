<?php
require_once './autoload.php';
require_once './includes/security.php';

// validaciones
if(!isset($_POST['id']) || 0 == (int)$_POST['id'])
    die('Código de producto inválido');

if(!isset($_POST['categorias_id']) || '' === $_POST['categorias_id'])
    die('Categoría inválida');

if(!isset($_POST['nombre']) || strlen($_POST['nombre']) <= 3)
    die('Modelo debe ser mayor a 3 caracteres');

if($_FILES['imagen']['error'] == 0){
    // validar archivo
    
    if($_FILES['imagen']['size'] > 1048576)
        die('El archivo es mayor a 1MB');
    
    $filesAllowed = ['image/jpeg', 'image/png', 'image/gif']; // mime-type
    if(!in_array($_FILES['imagen']['type'], $filesAllowed))
        die('Tipo de archivo no permitido: ' . join(', ', $filesAllowed));
    
    // mover el archivo
    $origen = $_FILES['imagen']['tmp_name']; // Ruta temporal en /tmp
    $destino = Constantes::RUTA_IMAGENES. $_FILES['imagen']['name'];
    move_uploaded_file($origen, $destino);
    
}

// recuperación de datos
$id = (int)$_POST['id'];
$categorias_id = (int)$_POST['categorias_id'];
$nombre = $_POST['nombre'];
$precio = (double)$_POST['precio'];
$stock = (int)$_POST['stock'];
$descripcion = $_POST['descripcion'];
if($_FILES['imagen']['error'] == 0){
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_tipo = $_FILES['imagen']['type'];
    $imagen_tamanio = $_FILES['imagen']['size'];
}
//$creado = date('Y-m-d h:i:s');
$estado = ( isset($_POST['estado']) )?1:0;

// Encapsulamiento
$producto = new Producto();
$producto->id = $id;
$producto->categorias_id = $categorias_id;
$producto->nombre = $nombre;
$producto->precio = $precio;
$producto->stock = $stock;
$producto->descripcion = $descripcion;
if($_FILES['imagen']['error'] == 0){
    $producto->imagen_nombre = $imagen_nombre;
    $producto->imagen_tipo = $imagen_tipo;
    $producto->imagen_tamanio = $imagen_tamanio;
}
//$producto->creado = $creado;
$producto->estado = $estado;

ProductoDAO::actualizar($producto);

Flash::success('Registro actualizado satisfactoriamente');

header('location: productos-listar.php');
