<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
//    sleep(1);
    
    $clientes = ClienteDAO::listar();
?>
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
            <td><a href="javascript:void(0)" onclick="eliminar(<?=$cliente->id?>)" class="btn btn-danger btn-sm">Eliminar</a></td>
        </tr>
      <?php } ?>
    </tbody>
</table>
    
    