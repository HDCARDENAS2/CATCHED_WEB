<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * Notificacion.php
 */
/*
 * OBJETOS DE LA CLASE VALIDADOR
 $control = new Control();
 $ajax    = new CoreAjax();
 $forma   = $_POST;
 $datos   = Datos del usuario
 *
 */
//validador
require_once('Validador.php');
//Clases import
require_once('../Modelo/Evento.php');
//*******************
//Logica del servicio
$evento  = new Evento();
$fecha   =  $control->fn_get_dato($forma, 'fecha');



//Consulta Eventos
$resultado = $evento->fn_consulta_evento_notifica(null,$ajax,$fecha);
//Se guarda el resultado
$ajax->setResultado($resultado); 
//retorno objeto ajax
$ajax->RetornarJSON();
//Fin   
?>