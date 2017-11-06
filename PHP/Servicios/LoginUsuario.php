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
//Logica del servicio
$datos[0]["USUARIO"]    = "";
$datos[0]["CONTRASENA"] = "";
$ajax->setResultado($datos);
//retorno objeto ajax
$ajax->RetornarJSON();
?>