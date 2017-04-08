<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];
$producto = ProductoDAO::obtener($id);

if($producto == null)
    die("Registro no encontrado");

?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <?php include './includes/head.php';?>
    </head>
    <body>
        
        <?php include './includes/header.php';?>
        
        <div class="container-fluid">
            
            <?php var_dump($producto) ?>
            
        </div>
        
        <?php include './includes/footer.php';?>
        
    </body>
</html>
