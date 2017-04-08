<?php 
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

$roles = RolDAO::listar();
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
            
            <form method="post" action="usuarios-actualizar.php">
                
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Edición de Productos</h3>
                    </div>

                    <div class="panel-body">
                    
                        <input type="hidden" name="id" value="<?= $usuario->id?>"/>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Usuario</label>
                                <input type="text" name="username" class="form-control" placeholder="Ingrese usuario" value="<?= $usuario->username?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Rol</label>
                                <select name="roles_id" class="form-control">
                                    <?php foreach($roles as $rol) {?>
                                    <option value="<?php echo $rol->id?>" <?php if($rol->id == $usuario->roles_id){?>selected="selected"<?php } ?>><?php echo $rol->nombre?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Ingrese password">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Repetir password</label>
                                <input type="password" name="password2" class="form-control" placeholder="Ingrese password nuevamente">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nombres</label>
                                <input type="text" name="nombres" class="form-control" placeholder="Ingrese nombres" value="<?= $usuario->nombres?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Ingrese email" value="<?= $usuario->email?>">
                            </div>
                        </div>

                    </div>
                        
                    <div class="panel-footer">
                        <input type="submit" value="Actualizar" class="btn btn-primary"/>
                    </div>

                </div>
                
            </form>
            
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
