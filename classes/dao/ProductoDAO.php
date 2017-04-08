<?php
class ProductoDAO {
    
    public static function listar() {
        
        $sql = "select p.id, c.nombre as categorias_nombre, p.categorias_id, p.nombre, p.precio, p.stock, p.imagen_nombre, p.imagen_tipo, p.imagen_tamanio, p.creado, p.estado
                from productos p
                inner join categorias c on c.id=p.categorias_id";
        
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        $lista = array();
        while($object = $stmt->fetchObject('Producto')){
            $lista[] = $object;
        }
        
        return $lista;
    }
    
    public static function registrar($producto) {
        
        $sql = "insert into productos(categorias_id, nombre, descripcion, precio, stock, imagen_nombre, imagen_tipo, imagen_tamanio, creado, estado) 
                values(:categorias_id, :nombre, :descripcion, :precio, :stock, :imagen_nombre, :imagen_tipo, :imagen_tamanio, :creado, :estado)";
        
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':categorias_id', $producto->categorias_id);
        $stmt->bindParam(':nombre', $producto->nombre);
        $stmt->bindParam(':descripcion', $producto->descripcion);
        $stmt->bindParam(':precio', $producto->precio);
        $stmt->bindParam(':stock', $producto->stock);
        $stmt->bindParam(':imagen_nombre', $producto->imagen_nombre);
        $stmt->bindParam(':imagen_tipo', $producto->imagen_tipo);
        $stmt->bindParam(':imagen_tamanio', $producto->imagen_tamanio);
        $stmt->bindParam(':creado', $producto->creado);
        $stmt->bindParam(':estado', $producto->estado);
        $stmt->execute();
        
    }
    
    public static function obtener($id) {
        
        $sql = "select p.id, c.nombre as categorias_nombre, p.categorias_id, p.nombre, p.precio, p.stock, p.descripcion, p.imagen_nombre, p.imagen_tipo, p.imagen_tamanio, p.creado, p.estado
                from productos p
                inner join categorias c on c.id=p.categorias_id 
                where p.id=:id";
        
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        if($object = $stmt->fetchObject('Producto')){
            return $object;
        }
        
        return NULL;
    }
    
    public static function eliminar($id) {
        
        $sql = "delete from productos where id = :id";
        
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
    }
    
    public static function actualizar($producto) {
        
        if(isset($producto->imagen_nombre)){
            
            $sql = "update productos set categorias_id=:categorias_id, nombre=:nombre, descripcion=:descripcion, 
                   precio=:precio, stock=:stock, imagen_nombre=:imagen_nombre, imagen_tipo=:imagen_tipo, imagen_tamanio=:imagen_tamanio, estado=:estado 
                   where id = :id";
            
            $pdo = Conexion::getConexion();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':categorias_id', $producto->categorias_id);
            $stmt->bindParam(':nombre', $producto->nombre);
            $stmt->bindParam(':descripcion', $producto->descripcion);
            $stmt->bindParam(':precio', $producto->precio);
            $stmt->bindParam(':stock', $producto->stock);
            $stmt->bindParam(':imagen_nombre', $producto->imagen_nombre);
            $stmt->bindParam(':imagen_tipo', $producto->imagen_tipo);
            $stmt->bindParam(':imagen_tamanio', $producto->imagen_tamanio);
            $stmt->bindParam(':estado', $producto->estado);
            $stmt->bindParam(':id', $producto->id);
            $stmt->execute();
            
        }else{
            
            $sql = "update productos set categorias_id=:categorias_id, nombre=:nombre, descripcion=:descripcion, 
                   precio=:precio, stock=:stock, estado=:estado 
                   where id = :id";
            
            $pdo = Conexion::getConexion();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':categorias_id', $producto->categorias_id);
            $stmt->bindParam(':nombre', $producto->nombre);
            $stmt->bindParam(':descripcion', $producto->descripcion);
            $stmt->bindParam(':precio', $producto->precio);
            $stmt->bindParam(':stock', $producto->stock);
            $stmt->bindParam(':estado', $producto->estado);
            $stmt->bindParam(':id', $producto->id);
            $stmt->execute();
            
        }
        
    }
    
}
