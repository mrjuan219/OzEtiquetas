<?php

class conexion
{

    public static function conectar()
    {
        $usuario = 'u291735209_cemarketing';
        $clave = '*kkz4@B6';
        $server = 'localhost';
        $db = 'u291735209_cemarketing';

        try {
            $conexion = new PDO("mysql:host=$server;dbname=$db", "$usuario", "$clave", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            return $conexion;
        } catch (PDOException $Exception) {
            print("<pre style='font-size: 1.6rem'>".print_r($Exception, true)."</pre>");
            echo "Error al conectar con la Base de Datos";
        }

        return $conexion;
    }
}
