<?php
class Producto {
    
    // Los atributos se definen en tiempo de ejecución por parte del PDO
    
    public function getPrecio2String() {
        // Require Intl extension 
        $fmt = new NumberFormatter('es_PE', NumberFormatter::CURRENCY); 
        return $fmt->formatCurrency($this->precio, "PEN");
    }
    
    public function getEstado2String() {
        return ($this->estado == 1)?"Activo":"Inactivo";
    }
    
    public function calcularPrecioDeVenta() {
        
    }
    
    public function thumbsGenerate() {
//        $this->imagen_nombre 
    }
    
}
