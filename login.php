<?php
    require_once './autoload.php';
    
    if(!empty($_POST)){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $usuario = UsuarioDAO::validar($username, $password);
        if($usuario!=null){
            $_SESSION['usuario'] = $usuario;
            header('location: index.php');
            exit();
        } else {
            $error = "Usuario y/o clave incorrecto";
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <?php include './includes/head.php';?>
        <?php if(isset($error)){?>
        <script>
            $(function(){
                bootbox.alert('<?=$error?>');
            });
        </script>
        <?php } ?>
    </head>
    <body>

        <div class="container-fluid">

            <div id="loginbox" style="margin-top:50px;" class="mainbox col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 co col-md-6 col-md-offset-3l-sm-offset-2">                    

                <div class="panel panel-info" >

                    <div class="panel-heading">
                        <div class="panel-title">Ingreso al Sistema</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <?php if(isset($error)){?>
                        <div id="login-alert" class="alert alert-danger col-sm-12"><?=$error?></div>
                        <?php } ?>

                        <form id="loginform" class="form-horizontal" role="form" action="login.php" method="post">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="username" value="<?=(isset($_POST['username'])?$_POST['username']:'')?>" required="" placeholder="username" autocomplete="off">                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" required="" placeholder="password">
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <input type="submit" class="btn btn-success" value="Ingresar"/>
                                </div>
                            </div>

                        </form>     

                    </div>                     
                </div>  
            </div>

        </div>

    </body>
</html>
