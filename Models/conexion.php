<?php

class Conexion
{
    static public function conectar()
    {
        $conexion = new PDO("mysql:host=localhost;dbname=inmobiliaria_costasur", "root", "");
        $conexion->exec("set names utf8");
        return $conexion;
    }
}
