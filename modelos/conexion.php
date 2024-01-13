<?php
class Conexion{
    static public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=sis_apuuray","root","");
        return $link;
    }
}
?>