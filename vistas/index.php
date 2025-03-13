<?php

//Conexion
require_once( 'modelos/conexion.php' );

//Controladores
require_once 'controlador/sessionControlador.php';
require_once 'controlador/plantillaControlador.php';
require_once 'controlador/productosControlador.php';
require_once 'controlador/serviciosControlador.php';
require_once 'controlador/usuarioControlador.php';
require_once 'controlador/educacionControlador.php';

//Modelos
require_once 'modelos/productos.php';
require_once 'modelos/paginas.php';
require_once 'modelos/carouseles.php';
require_once 'modelos/usuario.php';
require_once 'modelos/servicios.php';
require_once 'modelos/educacion.php';

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
?>
