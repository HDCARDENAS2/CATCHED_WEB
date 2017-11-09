<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * LoginUsuario.php
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
//*******************
require_once('../Modelo/Evento.php');
//Logica del servicio

$evento = new Evento();

$resultado = $evento->fn_consulta_ultimo_evento_notifica(null,$ajax);

$fecha;

if($resultado != null){
    $fecha = $resultado['FECHA_CREACION'];
}else{
    $date = new DateTime();
    $fecha = $date->format('Y-m-d H:i:s');
}
$ajax->setDato('fecha',$fecha);
$ajax->setResultado($datos);

//retorno objeto ajax
$ajax->RetornarJSON();
?>