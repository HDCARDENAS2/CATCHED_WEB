<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * ConsultaUsuarios.php
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
require_once('../Modelo/Usuario.php');
//*******************
//Logica del servicio
$usuario = new Usuario();
//Consulta Usuarios
$resultado = $usuario->fn_consulta_usuarios(null,$ajax);
//Se guarda el resultado
$ajax->setResultado($resultado);
//retorno objeto ajax
$ajax->RetornarJSON();
//Fin   
?>