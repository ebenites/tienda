<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
    $departamentos = UbigeoDAO::listar_departamentos();
    
    echo '<option value="" disabled="true" selected="true">-- Selecicone un departamento --</option>';
    
    foreach ($departamentos as $departamento) {
        echo '<option value="'.$departamento->id.'">' . $departamento->nombre . '</option>';
    }
