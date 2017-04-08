<?php
class Conexion {
    
    private static $instance = NULL;
    
    private function __construct() {
        
    }

    public static function getConexion() {
        if(self::$instance == NULL){
            $host = Constantes::DB_HOST;
            $dbname = Constantes::DB_SCHEMA;
            self::$instance = new PDO("mysql:host=$host;dbname=$dbname", Constantes::DB_USERNAME, Constantes::DB_PASSWORD);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        return self::$instance;
    }
    
}
