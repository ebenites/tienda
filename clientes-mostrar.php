<?php
require_once './autoload.php';
require_once './includes/security.php';

$id = (int)$_GET['id'];

$cliente = ClienteDAO::obtener($id);
//var_dump($producto);
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
            
            <h3>Detalle de Cliente</h3>
            
            <hr/>
            
            <div class="row">
                <div class="col-md-10">
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label>ID:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->id?>
                        </div>
                        <div class="col-md-2">
                            <label>EMAIL:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->email?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label>NOMBRES:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->nombres?>
                        </div>
                        <div class="col-md-2">
                            <label>APELLIDOS:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->apellidos?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label>SEXO:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->getSexoTexto()?>
                        </div>
                        <div class="col-md-2">
                            <label>NACIMIENTO:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->nacimiento?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label>DEPARTAMENTO:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->departamentos_nombre?>
                        </div>
                        <div class="col-md-2">
                            <label>PROVINCIA:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->provincias_nombre?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label>DISTRITO:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->distritos_nombre?>
                        </div>
                        <div class="col-md-2">
                            <label>DIRECCI&Oacute;N:</label>
                        </div>
                        <div class="col-md-4">
                            <?= $cliente->direccion?>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <?php if(isset($cliente->foto_tipo)){ ?>
                    <a href="clientes-mostrar-foto.php?id=<?php echo $cliente->id ?>" target="_blank"><img src="clientes-mostrar-foto.php?id=<?php echo $cliente->id ?>" alt="foto" height="128"/></a>
                    <?php } ?>
                </div>
            </div>
            
            <hr/>
            
            <a href="clientes-listar.php" class="btn btn-default">Regresar</a>
            <a href="clientes-editar.php?id=<?php echo $cliente->id ?>" class="btn btn-warning">Editar</a>
            <a href="clientes-eliminar.php?id=<?php echo $cliente->id ?>" class="btn btn-danger">Eliminar</a>
    
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
