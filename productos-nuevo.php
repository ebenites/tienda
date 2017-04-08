<?php
    require_once './autoload.php';   
    require_once './includes/security.php';
    
    $categorias = CategoriaDAO::listar();
//    var_dump($categorias);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <?php include './includes/head.php';?>
        <script>
            $(function(){
                $("[name='estado']").bootstrapSwitch();
            });
        </script>
    </head>
    <body>
        
        <?php include './includes/header.php';?>
        
        <div class="container-fluid">
            
            <form action="productos-registrar.php" method="POST" enctype="multipart/form-data">
            
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Registro de Productos</h3>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label for="categorias_id">Categoría</label>
                            <select name="categorias_id" id="categorias_id" class="form-control" required="">
                                <option value="" selected="" disabled="">Seleccione una categoría</option>
                                <?php foreach($categorias as $categoria){ ?>
                                <option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required="" maxlength="100" placeholder="Ingrese el nombre">
                        </div>
                        
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <div class="input-group">
                                <div class="input-group-addon">S/.</div>
                                <input type="number" id="precio" name="precio" class="form-control" placeholder="Ingrese el precio">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" min="0" max="1000" placeholder="Ingrese el nombre">
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="form-control ckeditor"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" id="imagen" name="imagen" class="form-control">
                        </div>
                        
                        <input type="checkbox" name="estado" data-on-text="Activo" data-off-text="Inactivo" value="1" checked="">

                    </div>

                    <div class="panel-footer">
                        <input type="submit" value="Registrar" class="btn btn-primary"/>
                    </div>

                </div>
                
            </form>
            
        </div>
        
        <?php include './includes/footer.php';?>
        
    </body>
</html>
