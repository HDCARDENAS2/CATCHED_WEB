<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * Notificacion.php
 */
require_once('Control.php');
require_once('..\Config\CoreAjax.php');
require_once('..\Modelo\General.php');

$control = new Control();
$ajax    = new CoreAjax();
$general = new General();
/*Peticion*/
$forma   = $_GET;
/*catos*/
$cadena  = $control->fn_get_dato($forma, 'key');
//*******************
//Logica del servicio
$resultado = $general->fn_consulta_parametro(null,$ajax,1);
if($resultado['VALOR_PARAMETRO'] == $cadena){
    $resultado2 = $general->fn_consulta_parametro(null,$ajax,2);
    $ajax->setResultado($resultado2);
}else{
    $ajax->setError("Password Incorrecto.");
}
//retorno objeto ajax
$ajax->RetornarJSON();
//Fin
?>