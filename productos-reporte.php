<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
    $categorias = CategoriaDAO::listar();   
    
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
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Stock de Productos por Categoría</h3>
                </div>
            
                <div class="panel-body">
                    <form action="productos-reporte.php" method="post" class="form-inline">

                        <div class="form-group">
                            <label for="categorias_id">Categoría</label>
                            <select name="categorias_id" id="categorias_id" class="form-control" required="">
                                <option value="" selected="" disabled="">Seleccione una categoría</option>
                                <?php foreach($categorias as $categoria){ ?>
                                <option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <input type="submit" value="Mostar" class="btn btn-primary">

                    </form>
                </div>
            </div>
                
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Gráfico de Pie</h3>
                </div>
                
                <div class="panel-body text-center">
                    <?php
                    if(isset($_POST['categorias_id'])){
                    ?>
                    <img src="productos-pie.php?categorias_id=<?=$_POST['categorias_id']?>" class="img-responsive">
                    <?php
                        }
                    ?>
                </div>
                
            </div>
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Gráfico de Líneas</h3>
                </div>
                
                <div class="panel-body text-center">
                    <?php
                    if(isset($_POST['categorias_id'])){
                    ?>
                    <img src="productos-line.php?categorias_id=<?=$_POST['categorias_id']?>" class="img-responsive">
                    <?php
                        }
                    ?>
                </div>
                
            </div>
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Gráfico de Barras</h3>
                </div>
                
                <div class="panel-body text-center">
                    <?php
                    if(isset($_POST['categorias_id'])){
                    ?>
                    <img src="productos-bar.php?categorias_id=<?=$_POST['categorias_id']?>" class="img-responsive">
                    <?php
                        }
                    ?>
                </div>
                
            </div>
                
        </div>
        
        <?php include './includes/footer.php';?>
        
    </body>
</html>
