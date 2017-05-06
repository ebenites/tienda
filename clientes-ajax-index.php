<?php
    require_once './autoload.php';
    require_once './includes/security.php'; 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include './includes/head.php';?>
        <title></title>
        <script type="text/javascript">
            $(function(){
                
                listar();
                
                listar_departamentos();
                
                $('[name="departamentos_id"]').change(function(){
                    //var departamento_id = $('[name="departamentos_id"]').val();
                    var departamento_id = $(this).val();
//                    console.log(departamento_id);
                    listar_provincias(departamento_id);
                    
                    // limpiar distritos
                    $('[name="distritos_id"]').empty();
                });
                
                $('[name="provincias_id"]').change(function(){
                    listar_distritos( $(this).val() );
                });
                
                // Datepicker
                $('[name="nacimiento"]').datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'es',
//                    startDate: new Date(),
                });
                
                // AjaxForm
                $('#clientes-form').ajaxForm({
                    clearForm: true,
                    dataType: 'json',
                    beforeSubmit: function(arr, $form, options){
                        // validar que las claves coincidan ...
                        
                        $('#clientes-table').spin();
                    },
                    success: function(data, status){
                        console.log(data);
                        bootbox.alert(data.detail + '<br/>' +data.nombres);
                        listar();
                    }
                });
                
            });
            
            function listar(){
                $('#clientes-table').spin().load('clientes-ajax-listar.php');
            }
            
            function listar_departamentos(){
                $('[name="departamentos_id"]').load('clientes-ajax-departamentos.php');
            }
            
            function listar_provincias(departamento_id){
                $('[name="provincias_id"]').load('clientes-ajax-provincias.php?id='+departamento_id);
            }
            
            function listar_distritos(provincia_id){
                $('[name="distritos_id"]').load('clientes-ajax-distritos.php?id='+provincia_id);
            }
            
            function eliminar(id){
                bootbox.confirm({
                    message: '¿Realmente deseas eliminar?',
                    buttons: {
                        confirm: {
                            label: 'Si',
                            className: 'btn-danger'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-default'
                        }
                    },
                    callback: function(result){
                        if(result){
                            $.get('clientes-ajax-eliminar.php', {'id': id}, function(data){
                                bootbox.alert(data.detail);
                                listar();
                            }, 'json');
                        }
                    },
                });
            }
        </script>
    </head>
    <body>
        
        <?php require_once './includes/header.php';?>
        <div class="container-fluid">
            
            <form id="clientes-form" method="post" action="clientes-ajax-registrar.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Registro de cliente</legend>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese email" >
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese password" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password2" class="form-control" placeholder="Ingrese nuevamente password" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombres</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Ingrese nombres" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Ingrese apellidos" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Fecha de Nacimiento</label>
                            <input type="text" name="nacimiento" class="form-control" placeholder="YYYY-MM-DD" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sexo</label><br/>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="sexo" value="M"> Masculino
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="sexo" value="F"> Femenino
                                  </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Departamento</label>
                            <select name="departamentos_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Provincia</label>
                            <select name="provincias_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Distrito</label>
                            <select name="distritos_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Direcci&oacute;n</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Ingrese direcci&oacute;n" >
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
            
            <div id="clientes-table" class="table-responsive"></div>
        
        </div>
       <?php require_once './includes/footer.php';?>
        
    </body>
</html>
