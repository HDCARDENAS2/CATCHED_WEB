<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * ConsultaEnventos.php
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
$evento = new Evento();
//Consulta Usuarios
$resultado = $evento->fn_consulta_eventos(null,$ajax);
//Se guarda el resultado
$ajax->setResultado($resultado);
//retorno objeto ajax
$ajax->RetornarJSON();
//Fin
?>
