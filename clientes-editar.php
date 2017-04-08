<?php
    require_once './autoload.php';
    require_once './includes/security.php';

    $id = (int)$_GET['id'];

    $cliente = ClienteDAO::obtener($id);
    //var_dump($cliente);
    
    $departamentos = UbigeoDAO::listar_departamentos();
    $provincias = UbigeoDAO::listar_provincias($cliente->departamentos_id);
    $distritos = UbigeoDAO::listar_distritos($cliente->provincias_id);
    
    // Cargar combos en caso de POST
    if(isset($_POST['departamentos_id'])){
        $provincias = UbigeoDAO::listar_provincias($_POST['departamentos_id']);
    }
    if(isset($_POST['provincias_id'])){
        $distritos = UbigeoDAO::listar_distritos($_POST['provincias_id']);
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'includes/head.php';?>
        <title></title>
        <script type="text/javascript">
            function cargarCombo(combo){
                combo.form.action = 'clientes-editar.php?id=<?= $cliente->id?>';
                combo.form.submit();
            }
        </script>
    </head>
    <body>
        
        <?php require_once './includes/header.php';?>
        <div class="container-fluid">
            
            <form method="post" action="clientes-actualizar.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Registro de cliente</legend>
                    
                    <input type="hidden" name="id" value="<?=$cliente->id?>" >
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese email" value="<?=(isset($_POST['email'])?$_POST['email']:$cliente->email)?>" >
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese password" value="<?=(isset($_POST['password'])?$_POST['password']:'')?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password2" class="form-control" placeholder="Ingrese nuevamente password" value="<?=(isset($_POST['password2'])?$_POST['password2']:'')?>" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombres</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Ingrese nombres" value="<?=(isset($_POST['nombres'])?$_POST['nombres']:$cliente->nombres)?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Ingrese apellidos" value="<?=(isset($_POST['apellidos'])?$_POST['apellidos']:$cliente->apellidos)?>" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Fecha de Nacimiento</label>
                            <input type="text" name="nacimiento" class="form-control" placeholder="YYYY-MM-DD" value="<?=(isset($_POST['nacimiento'])?$_POST['nacimiento']:$cliente->nacimiento)?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sexo</label><br/>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default <?php if((isset($_POST['sexo']) && $_POST['sexo']=='M') || (!isset($_POST['sexo']) && $cliente->sexo=='M')){?>active<?php }?> ">
                                    <input type="radio" name="sexo" value="M" <?php if((isset($_POST['sexo']) && $_POST['sexo']=='M') || (!isset($_POST['sexo']) && $cliente->sexo=='M')){?>checked<?php }?> > Masculino
                                </label>
                                <label class="btn btn-default <?php if((isset($_POST['sexo']) && $_POST['sexo']=='F') || (!isset($_POST['sexo']) && $cliente->sexo=='F')){?>active<?php }?> ">
                                    <input type="radio" name="sexo" value="F" <?php if((isset($_POST['sexo']) && $_POST['sexo']=='F') || (!isset($_POST['sexo']) && $cliente->sexo=='F')){?>checked<?php }?> > Femenino
                                  </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Departamento</label>
                            <select name="departamentos_id" class="form-control" onchange="cargarCombo(this)">
                                <?php  foreach ($departamentos as $departamento){?>
                                <option value="<?=$departamento->id ?>" <?php if((isset($_POST['departamentos_id']) && $_POST['departamentos_id']==$departamento->id) || (!isset($_POST['departamentos_id']) && $cliente->departamentos_id==$departamento->id)){?>selected<?php }?> ><?=$departamento->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Provincia</label>
                            <select name="provincias_id" class="form-control" onchange="cargarCombo(this)">
                                <?php  foreach ($provincias as $provincia){?>
                                <option value="<?=$provincia->id ?>" <?php if((isset($_POST['provincias_id']) && $_POST['provincias_id']==$provincia->id) || (!isset($_POST['provincias_id']) && $cliente->provincias_id==$provincia->id)){?>selected<?php }?> ><?=$provincia->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Distrito</label>
                            <select name="distritos_id" class="form-control">
                                <?php  foreach ($distritos as $distrito){?>
                                <option value="<?=$distrito->id ?>" <?php if((!isset($_POST['provincias_id']) && $cliente->distritos_id==$distrito->id)){?>selected<?php }?> ><?=$distrito->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Direcci&oacute;n</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Ingrese direcci&oacute;n" value="<?=(isset($_POST['direccion'])?$_POST['direccion']:$cliente->direccion)?>" >
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-md-11">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="form-group col-md-1">
                            <?php if(isset($cliente->foto_tipo)){ ?>
                            <a href="clientes-mostrar-foto.php?id=<?php echo $cliente->id ?>" target="_blank"><img src="clientes-mostrar-foto.php?id=<?php echo $cliente->id ?>" alt="foto" height="64" /></a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <a href="clientes-listar.php" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </fieldset>
            </form>
                 
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
