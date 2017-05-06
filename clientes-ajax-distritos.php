<?php
    require_once './autoload.php';
    require_once './includes/security.php';
    
    $id = $_GET['id'];
    
    $distritos = UbigeoDAO::listar_distritos($id);
    
    echo '<option value="" disabled="true" selected="true">-- Selecicone un distrito --</option>';
    
    foreach ($distritos as $distrito) {
        echo '<option value="'.$distrito->id.'">' . $distrito->nombre . '</option>';
    }
