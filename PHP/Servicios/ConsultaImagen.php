<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * ConsultaImagen.php
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
//Consulta imagen
$cod_evento = $control->fn_get_dato($forma, 'cod_evento');
$resultado  = $evento->fn_consulta_imagen(null,$ajax,$cod_evento);
//Se guarda el resultado
$ajax->setResultado($resultado['IMAGEN']);
//retorno objeto ajax
$ajax->RetornarJSON();
//Fin   
?>