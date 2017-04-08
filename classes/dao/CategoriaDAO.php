<?php
class CategoriaDAO {
    
    public static function listar() {
        
        $sql = "select * from categorias order by orden";
        
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        $lista = array();
        while($object = $stmt->fetchObject('Categoria')){
            $lista[] = $object;
        }
        
        return $lista;
    }
    
}
