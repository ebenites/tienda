<?php
class Cliente {
 
    public function getSexoTexto() {
        if($this->sexo != null){
            switch ($this->sexo) {
                case 'M':
                    return 'Masculino';
                    break;
                case 'F':
                    return 'Femenino';
                    break;
                default:
                    return 'Indefinido';
                    break;
            }
        }
        return null;
    }
    
}
