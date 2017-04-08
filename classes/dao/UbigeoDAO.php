<?php

class UbigeoDAO {
    
    public static function listar_departamentos() {
        
        $lista = array();
        
        $sql = "SELECT * FROM departamentos ORDER BY nombre";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        while($objeto = $stmt->fetchObject('Departamento')){
            $lista[] = $objeto;
        }
        
        return $lista;
    }
    
    public static function listar_provincias($id = '15') {
        
        $lista = array();
        
        $sql = "SELECT * FROM provincias WHERE departamentos_id=:departamentos_id ORDER BY nombre";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':departamentos_id', $id);
        $stmt->execute();
        
        while($objeto = $stmt->fetchObject('Provincia')){
            $lista[] = $objeto;
        }
        
        return $lista;
    }
    
    public static function listar_distritos($id = '1501') {
        
        $lista = array();
        
        $sql = "SELECT * FROM distritos WHERE provincias_id=:provincias_id ORDER BY nombre";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':provincias_id', $id);
        $stmt->execute();
        
        while($objeto = $stmt->fetchObject('Distrito')){
            $lista[] = $objeto;
        }
        
        return $lista;
    }
    
}
