<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  05/11/2017
 */
require_once('Control.php');
require_once('../Config/CoreAjax.php');
$control = new Control();
$ajax    = new CoreAjax();
/*Peticion*/
$forma   = $_GET;
/*catos*/
$cadena  = $control->fn_get_dato($forma, 'key');
//Validacion de usuario6
$datos = $control->fn_validar_usuario($cadena,$ajax);
if( $datos == null ){
   $ajax->setError("El usuario no existe.");
   $ajax->RetornarJSON();
   die();
}else if( $datos != null ){   
    if($datos["IND_ESTADO"] == "0"){
        $ajax->setError("El usuario esta inactivo.");
        $ajax->RetornarJSON();
        die();
    }   
}
/*LOGICA DE LA CLASE*/


