<?php 
require_once './autoload.php';
require_once './includes/security.php';

$roles = RolDAO::listar();
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
            
            <form method="post" action="usuarios-registrar.php">
                
                <div class="panel panel-default">
                
                    <div class="panel-heading">
                        <h3 class="panel-title">Registro de Usuarios</h3>
                    </div>
                    
                    <div class="panel-body">
                    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Usuario</label>
                                <input type="text" name="username" class="form-control" placeholder="Ingrese usuario">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Rol</label>
                                <select name="roles_id" class="form-control">
                                    <?php foreach($roles as $rol) {?>
                                    <option value="<?php echo $rol->id?>"><?php echo $rol->nombre?></option>
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
                                <input type="text" name="nombres" class="form-control" placeholder="Ingrese nombres">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Ingrese email">
                            </div>
                        </div>

                    </div>
                        
                    <div class="panel-footer">
                        <input type="submit" value="Registrar" class="btn btn-primary"/>
                    </div>
                    
                </div>
                
            </form>
            
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
