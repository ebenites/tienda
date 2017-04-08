<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

$usuario = UsuarioDAO::obtener($id);
//var_dump($usuario);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'includes/head.php';?>
        <title></title>
        
    </head>
    <body>
        
        <?php require_once './includes/header.php';?>
        <div class="container-fluid">
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Detalle de Usuarios</h3>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-1">
                            <label>ID:</label>
                        </div>
                        <div class="col-md-3">
                            <?= $usuario->id?>
                        </div>
                        <div class="col-md-1">
                            <label>USUARIO:</label>
                        </div>
                        <div class="col-md-3">
                            <?= $usuario->username?>
                        </div>
                        <div class="col-md-1">
                            <label>ROL:</label>
                        </div>
                        <div class="col-md-3">
                            <?= $usuario->roles_nombre?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1">
                            <label>NOMBRES:</label>
                        </div>
                        <div class="col-md-3">
                            <?= $usuario->nombres?>
                        </div>
                        <div class="col-md-1">
                            <label>EMAIL:</label>
                        </div>
                        <div class="col-md-3">
                            <?= $usuario->email?>
                        </div>
                    </div>

                </div>   

                <div class="panel-footer">
                    <a href="usuarios-listar.php" class="btn btn-default">Regresar</a>
                    <a href="usuarios-editar.php?id=<?php echo $usuario->id ?>" class="btn btn-warning">Editar</a>
                    <a href="usuarios-eliminar.php?id=<?php echo $usuario->id ?>" class="btn btn-danger">Eliminar</a>
                </div>

            </div>
            
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
