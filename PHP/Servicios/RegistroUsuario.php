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
require_once('..\Modelo\Usuario.php');

$control = new Control();
$ajax    = new CoreAjax();
$general = new General();
$obj_usuario = new Usuario();
/*Peticion*/
$forma   = $_POST;
/*catos*/
$cadena  = $control->fn_get_dato($forma, 'key');
//*******************
//Logica del servicio
$resultado = $general->fn_consulta_parametro(null,$ajax,1);
if($resultado['VALOR_PARAMETRO'] == $cadena){
   
    $usuario     = $control->fn_get_dato($forma, 'USUARIO');
    $nombre      = $control->fn_get_dato($forma, 'NOMBRES');
    $password    = $control->fn_get_dato($forma, 'PASSWORD');
    $password_c  = $control->fn_get_dato($forma, 'PASSWORD_C');
    
    if($password == $password_c){
        
        if($obj_usuario->fn_consulta_usuario_id(null,$ajax,$usuario) == null){
            if($obj_usuario->fn_insert_usuario($usuario, $nombre, $password,$ajax,null)){
                $ajax->setMensaje("El usuario fue modificado con exito.");
                $ajax->setResultado("Exito");
            }
        }else{
            $ajax->setError("El usuario ya existe.");
        }      
    }else{
        $ajax->setError("Las Contrasenas No son iguales.");
    }
   
}else{
    $ajax->setError("Password Maestro Incorrecto.");
}
//retorno objeto ajax
$ajax->RetornarJSON();
//Fin
?>