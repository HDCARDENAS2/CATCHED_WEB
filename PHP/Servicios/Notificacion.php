<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  05/11/2017
 */
require_once('Control.php');
require_once('../Config/CoreAjax.php');
require_once('../Modelo/Evento.php');
$control = new Control();
$ajax    = new CoreAjax();
$evento  = new Evento();
/*Peticion*/
$forma   = $_GET;
/*catos*/
$cadena  = $control->fn_get_dato($forma, 'key');
//Validacion de usuario
$datos = $control->fn_validar_usuario($cadena,$ajax);
if( $datos != null ){
	//Consulta de eventos
	$resultado = $evento->fn_consulta_evento(null,$ajax);
	$ajax->setResultado($resultado); 
}
	//retorno objeto ajax
$ajax->RetornarJSON();
?>