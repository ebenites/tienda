<?php 
require_once './autoload.php';
require_once './includes/security.php';

$usuarios = UsuarioDAO::listar();

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include './includes/head.php';?>
        <title></title>
        
    </head>
    <body>
        
        <?php require_once './includes/header.php';?>
        <div class="container-fluid">
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Listado de Usuarios</h3>
                </div>
                
                <table border="1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USUARIO</th>
                            <th>NOMBRES</th>
                            <th>EMAIL</th>
                            <th width="50">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($usuarios as $usuario){
                      ?>
                        <tr>
                            <td><?php echo $usuario->id ?></td>
                            <td><?php echo $usuario->username ?></td>
                            <td><?php echo $usuario->nombres ?></td>
                            <td><?php echo $usuario->email ?></td>
                            <td><a href="usuarios-ver.php?id=<?php echo $usuario->id ?>" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a></td>
                            <td><a href="usuarios-editar.php?id=<?php echo $usuario->id ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a></td>
                            <td><a href="usuarios-eliminar.php?id=<?php echo $usuario->id ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a></td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                </table>
                
                <div class="panel-footer">
                    <a href="usuarios-nuevo.php" class="btn btn-primary">Nuevo</a>
                </div>
                
            </div>
            
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
