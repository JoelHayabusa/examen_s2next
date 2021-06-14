<?php
 class Conexion
 {
    private $conect;

    public function __construct(){
        $connectionString = "mysql:hos=".DB_HOST.";dbname=".DB_NAME.";".DB_CHARSET;
        try{
            $this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexion exitosa";
        }catch(Exception $ex){
            $this->conect ='Error de conexión';
            echo "ERROR: ".$ex->getMessage();
        }
    }
    public function conect(){
        return $this->conect;
    }
 }

?>