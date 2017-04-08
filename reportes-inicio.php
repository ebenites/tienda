<?php
    require_once './autoload.php';
    require_once './includes/security.php';
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
            
            <div class="row">
                
                <div class="col-md-6">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Exportar Productos</h3>
                        </div>
                        <div class="panel-body">
                            <a href="reportes-productos-exportexcel.php" class="btn btn-primary">Descargar Reporte</a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Importar Usuarios</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" action="reportes-usuarios-importar.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="archivo" class="form-control"/>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Importar"/>
                            </form>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
            
        </div>
            
        <?php include './includes/footer.php';?>
        
    </body>
</html>
