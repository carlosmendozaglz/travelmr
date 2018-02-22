<?php

abstract class Conexion {
    protected $conexion_bd;
    protected $datahost;
    
    protected $servidor="localhost";
    protected $controlador;
    protected $puerto="3306";
    protected $basedatos="travel_agenci";
    protected $password="";
    protected $usuario="root";
    
/*    protected $servidor="mysql.hostinger.mx";
    protected $controlador;
    protected $puerto="3306";
    protected $basedatos="u201166030_tango";
    protected $password="holamundo1";
    protected $usuario="u201166030_tango";*/
            
    function __construct() {
    }

    protected function conectar(){
        try{
            return $this->datahost=new PDO("mysql:host=$this->servidor;port=$this->puerto;dbname=$this->basedatos",  $this->usuario,  $this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
        } catch (PDOException $ex) {
            echo 'No se puede conectar a la bd '.$ex->getMessage();
        }
    }
}
