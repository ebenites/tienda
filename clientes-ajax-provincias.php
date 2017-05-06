<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
    $id = $_GET['id'];
    
    $provincias = UbigeoDAO::listar_provincias($id);
    
    echo '<option value="" disabled="true" selected="true">-- Selecicone un provincia --</option>';
    
    foreach ($provincias as $provincia) {
        echo '<option value="'.$provincia->id.'">' . $provincia->nombre . '</option>';
    }
