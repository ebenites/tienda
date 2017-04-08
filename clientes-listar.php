<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
    $departamentos = UbigeoDAO::listar_departamentos();
    $provincias = array();
    $distritos = array();
    $clientes = ClienteDAO::listar();
    
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
        <?php include './includes/head.php';?>
        <title></title>
        <script type="text/javascript">
            function cargarCombo(combo){
                combo.form.action = 'clientes-listar.php';
                combo.form.submit();
            }
        </script>
    </head>
    <body>
        
        <?php require_once './includes/header.php';?>
        <div class="container-fluid">
            
            <form method="post" action="clientes-registrar.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Registro de cliente</legend>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese email" value="<?=(isset($_POST['email'])?$_POST['email']:'')?>" >
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
                            <input type="text" name="nombres" class="form-control" placeholder="Ingrese nombres" value="<?=(isset($_POST['nombres'])?$_POST['nombres']:'')?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Ingrese apellidos" value="<?=(isset($_POST['apellidos'])?$_POST['apellidos']:'')?>" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Fecha de Nacimiento</label>
                            <input type="text" name="nacimiento" class="form-control" placeholder="YYYY-MM-DD" value="<?=(isset($_POST['nacimiento'])?$_POST['nacimiento']:'')?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sexo</label><br/>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default <?php if(isset($_POST['sexo']) && $_POST['sexo']=='M'){?>active<?php }?> ">
                                    <input type="radio" name="sexo" value="M" <?php if(isset($_POST['sexo']) && $_POST['sexo']=='M'){?>checked<?php }?> > Masculino
                                </label>
                                <label class="btn btn-default <?php if(isset($_POST['sexo']) && $_POST['sexo']=='F'){?>active<?php }?> ">
                                    <input type="radio" name="sexo" value="F" <?php if(isset($_POST['sexo']) && $_POST['sexo']=='F'){?>checked<?php }?> > Femenino
                                  </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Departamento</label>
                            <select name="departamentos_id" class="form-control" onchange="cargarCombo(this)">
                                <?php  foreach ($departamentos as $departamento){?>
                                <option value="<?=$departamento->id ?>" <?php if(isset($_POST['departamentos_id']) && $_POST['departamentos_id']==$departamento->id){?>selected<?php }?> ><?=$departamento->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Provincia</label>
                            <select name="provincias_id" class="form-control" onchange="cargarCombo(this)">
                                <?php  foreach ($provincias as $provincia){?>
                                <option value="<?=$provincia->id ?>" <?php if(isset($_POST['provincias_id']) && $_POST['provincias_id']==$provincia->id){?>selected<?php }?> ><?=$provincia->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Distrito</label>
                            <select name="distritos_id" class="form-control">
                                <?php  foreach ($distritos as $distrito){?>
                                <option value="<?=$distrito->id ?>"><?=$distrito->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Direcci&oacute;n</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Ingrese direcci&oacute;n" value="<?=(isset($_POST['direccion'])?$_POST['direccion']:'')?>" >
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-md-12">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </fieldset>
            </form>
            
            <hr/>
            
            <div class="table-responsive">
            <table border="1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>EMAIL</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>NACIMIENTO</th>
                        <th>DEPARTAMENTO</th>
                        <th>PROVINCIA</th>
                        <th>DISTRITO</th>
                        <th>FOTO</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach($clientes as $cliente) {?>
                    <tr>
                        <td><?=$cliente->id?></td>
                        <td><?=$cliente->email?></td>
                        <td><?=$cliente->nombres?></td>
                        <td><?=$cliente->apellidos?></td>
                        <td><?=$cliente->nacimiento?></td>
                        <td><?=$cliente->departamentos_nombre?></td>
                        <td><?=$cliente->provincias_nombre?></td>
                        <td><?=$cliente->distritos_nombre?></td>
                        <td>
                           <?php if(isset($cliente->foto_tipo)){?>
                           <a href="clientes-mostrar-foto.php?id=<?=$cliente->id?>" target="_blank"><img src="clientes-mostrar-foto.php?id=<?=$cliente->id?>" height="64"/></a>
                           <?php } ?>
                        </td>
                        <td><a href="clientes-mostrar.php?id=<?=$cliente->id?>" class="btn btn-info btn-sm">Mostrar</a></td>
                        <td><a href="clientes-editar.php?id=<?=$cliente->id?>" class="btn btn-warning btn-sm">Editar</a></td>
                        <td><a href="clientes-eliminar.php?id=<?=$cliente->id?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            </div>
        
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
