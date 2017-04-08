<?php

class ClienteDAO {

    public static function validar($email, $password) {
        
        $query = "SELECT * FROM clientes WHERE email=:email and password=:password and estado=1";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if($fila = $stmt->fetchObject('Usuario')){
            return $fila;
        }
        return NULL;
    }
    
    public static function listar() {
        $lista = array();
        $query = "SELECT c.id, c.email, c.nombres, c.apellidos, c.sexo, c.nacimiento, c.direccion, c.foto_tipo, c.foto_tamanio, c.estado,
                  d.id AS distritos_id, d.nombre AS distritos_nombre, 
                  p.id AS provincias_id, p.nombre AS provincias_nombre,
                  t.id AS departamentos_id, t.nombre AS departamentos_nombre
                  FROM clientes c
                  INNER JOIN distritos d ON d.id=c.distritos_id
                  INNER JOIN provincias p ON p.id=d.provincias_id
                  INNER JOIN departamentos t ON t.id=p.departamentos_id
                  ORDER BY apellidos, nombres";
        $con = Conexion::getConexion() ;
        $stmt = $con->prepare($query);
        $stmt->execute();

        while($objeto = $stmt->fetchObject('Cliente')){
            $lista[] = $objeto;
        }

        return $lista;
    }
    
    public static function obtener($id) {
        $query = "SELECT c.id, c.email, c.nombres, c.apellidos, c.sexo, c.nacimiento, c.direccion, c.foto_tipo, c.foto_tamanio, c.estado, 
                  d.id AS distritos_id, d.nombre AS distritos_nombre, 
                  p.id AS provincias_id, p.nombre AS provincias_nombre,
                  t.id AS departamentos_id, t.nombre AS departamentos_nombre
                  FROM clientes c
                  INNER JOIN distritos d ON d.id=c.distritos_id
                  INNER JOIN provincias p ON p.id=d.provincias_id
                  INNER JOIN departamentos t ON t.id=p.departamentos_id
                  WHERE c.id=:id";
        $con = Conexion::getConexion() ;
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($objeto = $stmt->fetchObject('Cliente')){
            return $objeto;
        }

        return NULL;
    }
    
    public static function obtener_foto($id) {
        $query = "SELECT id, foto, foto_tipo, foto_tamanio FROM clientes WHERE id=:id";
        $con = Conexion::getConexion() ;
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($objeto = $stmt->fetchObject('Cliente')){
            return $objeto;
        }

        return NULL;
    }
    
    public static function registrar($cliente) {
        
        $query = "INSERT INTO clientes(email, `password`, nombres, apellidos, sexo, nacimiento, distritos_id, direccion, foto, foto_tipo, foto_tamanio, estado)
                  VALUES(:email, :password, :nombres, :apellidos, :sexo, :nacimiento, :distritos_id, :direccion, :foto, :foto_tipo, :foto_tamanio, 1)";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        
        $stmt->bindParam(':email', $cliente->email);
        $stmt->bindParam(':password', $cliente->password);
        $stmt->bindParam(':nombres', $cliente->nombres);
        $stmt->bindParam(':apellidos', $cliente->apellidos);
        $stmt->bindParam(':sexo', $cliente->sexo);
        $stmt->bindParam(':nacimiento', $cliente->nacimiento);
        $stmt->bindParam(':distritos_id', $cliente->distritos_id);
        $stmt->bindParam(':direccion', $cliente->direccion);
        $stmt->bindParam(':foto', $cliente->foto);
        $stmt->bindParam(':foto_tipo', $cliente->foto_tipo);
        $stmt->bindParam(':foto_tamanio', $cliente->foto_tamanio);
        
        $stmt->execute();
    }
    
    public static function actualizar($cliente) {
        
        $con = Conexion::getConexion();
        
        $con->beginTransaction();   //Iniciar transaccion
        
        $query = "UPDATE clientes SET email=:email, nombres=:nombres, apellidos=:apellidos, sexo=:sexo, nacimiento=:nacimiento, distritos_id=:distritos_id, direccion=:direccion "
                . "WHERE id=:id";
        
        $stmt = $con->prepare($query);
        
        $stmt->bindParam(':email', $cliente->email);
        $stmt->bindParam(':nombres', $cliente->nombres);
        $stmt->bindParam(':apellidos', $cliente->apellidos);
        $stmt->bindParam(':sexo', $cliente->sexo);
        $stmt->bindParam(':nacimiento', $cliente->nacimiento);
        $stmt->bindParam(':distritos_id', $cliente->distritos_id);
        $stmt->bindParam(':direccion', $cliente->direccion);
        $stmt->bindParam(':id', $cliente->id);
        
        $stmt->execute();
        
        if(isset($cliente->password)){
            
            $query = "UPDATE clientes SET `password`=:password "
                    . "WHERE id=:id";
            
            $stmt = $con->prepare($query);
            
            $stmt->bindParam(':password', $cliente->password);
            $stmt->bindParam(':id', $cliente->id);

            $stmt->execute();
            
        }
        
        if(isset($cliente->foto)){
            
            $query = "UPDATE clientes SET foto=:foto, foto_tipo=:foto_tipo, foto_tamanio=:foto_tamanio "
                    . "WHERE id=:id";
            
            $stmt = $con->prepare($query);
            
            $stmt->bindParam(':foto', $cliente->foto);
            $stmt->bindParam(':foto_tipo', $cliente->foto_tipo);
            $stmt->bindParam(':foto_tamanio', $cliente->foto_tamanio);
            $stmt->bindParam(':id', $cliente->id);

            $stmt->execute();
            
        }
        
        $con->commit(); //Consolidar transaccion
        
        // En Exception -> $con->rollback();
    }
    
    public static function eliminar($id) {
        
        $query = "DELETE FROM clientes WHERE id=:id";
        
        $con = Conexion::getConexion();
        $stmt = $con->prepare($query);
        
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
    }
        
}

?>
