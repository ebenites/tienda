<?php

class UsuarioDAO {

    public static function validar($username, $password) {
        
        $query = "select u.id, u.username, u.nombres, u.roles_id, r.nombre as roles_nombre, u.email 
                from usuarios u
                inner join roles r on r.id = u.roles_id
                where username=:username and password=:password";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if($fila = $stmt->fetchObject('Usuario')){
            return $fila;
        }
        return NULL;
    }
    
    public static function listar() {
        $lista = array();
        $query = "SELECT u.id, u.username, u.password, u.nombres, u.roles_id, r.nombre AS roles_nombre, u.email FROM usuarios u 
            INNER JOIN roles r ON r.id=u.roles_id 
            ORDER BY nombres";
        $con = Conexion::getConexion() ;
        $stmt = $con->prepare($query);
        $stmt->execute();

        while($objeto = $stmt->fetchObject('Usuario')){
            $lista[] = $objeto;
        }

        return $lista;
    }
    
    public static function obtener($id) {
        $query = "SELECT u.id, u.username, u.password, u.nombres, u.roles_id, r.nombre AS roles_nombre, u.email FROM usuarios u 
            INNER JOIN roles r ON r.id=u.roles_id 
            WHERE u.id=:id";
        $con = Conexion::getConexion() ;
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($objeto = $stmt->fetchObject('Usuario')){
            return $objeto;
        }

        return NULL;
    }
    
    public static function registrar($usuario) {
        
        $query = "INSERT INTO usuarios (username, `password`, nombres, roles_id, email) "
                . "VALUES (:username, :password, :nombres, :roles_id, :email)";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        
        $stmt->bindParam(':username', $usuario->username);
        $stmt->bindParam(':password', $usuario->password);
        $stmt->bindParam(':nombres', $usuario->nombres);
        $stmt->bindParam(':roles_id', $usuario->roles_id);
        $stmt->bindParam(':email', $usuario->email);
        
        $stmt->execute();
    }
    
    public static function actualizar($usuario) {
        
        $query = "UPDATE usuarios SET username=:username, `password`=:password, nombres=:nombres, roles_id=:roles_id, email=:email "
                . "WHERE id=:id";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        
        $stmt->bindParam(':username', $usuario->username);
        $stmt->bindParam(':password', $usuario->password);
        $stmt->bindParam(':nombres', $usuario->nombres);
        $stmt->bindParam(':roles_id', $usuario->roles_id);
        $stmt->bindParam(':email', $usuario->email);
        $stmt->bindParam(':id', $usuario->id);
        
        $stmt->execute();
    }
    
    public static function eliminar($id) {
        
        $query = "DELETE FROM usuarios WHERE id=:id";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
    }
        
}

?>
