<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
    $lista = ProductoDAO::listar();   
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <?php include './includes/head.php';?>
        <script>
            $(function(){
                $('a.colorbox').colorbox({photo:true});
            });
            
            function eliminar(id){
                bootbox.confirm('¿Realmente desea eliminar?', function(result){
                    if(result){
                        window.location.href = 'productos-eliminar.php?id='+id;
                    }
                });
            }
        </script>
    </head>
    <body>
        
        <?php include './includes/header.php';?>
        
        <div class="container-fluid">
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Listado de Productos</h3>
                </div>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CATEGORÍA</th>
                            <th>MODELO</th>
                            <th>PRECIO</th>
                            <th>IMAGEN</th>
                            <th>ESTADO</th>
                            <th width="50"></th>
                            <th width="50"></th>
                            <th width="50"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($lista as $producto){ ?>
                    <tr>
                        <td><?=$producto->id?></td>
                        <td><?=$producto->categorias_nombre?></td>
                        <td><?=$producto->nombre?></td>
                        <td><?=$producto->getPrecio2String()?></td>
                        <td><a href="productos-imagen.php?id=<?=$producto->id?>" class="colorbox"><img src="productos-imagen.php?id=<?=$producto->id?>" height="32"/></a></td>
                        <td><?=$producto->getEstado2String()?></td>
                        <td><a href="productos-ver.php?id=<?=$producto->id?>" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a></td>
                        <td><a href="productos-editar.php?id=<?=$producto->id?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a></td>
                        <td><a href="javascript:void(0)" onclick="eliminar(<?=$producto->id?>)" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            
                <div class="panel-footer">
                    <a href="productos-nuevo.php" class="btn btn-primary">Nuevo</a>
                </div>
                
            </div>
                
        </div>
        
        <?php include './includes/footer.php';?>
        
    </body>
</html>
