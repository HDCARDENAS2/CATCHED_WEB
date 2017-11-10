<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name  Notificacion
 * @Date  06/11/2017
 * Notificacion.php
 */
require_once('Validador.php');
require_once('../Modelo/General.php');
require_once('../Modelo/Usuario.php');

$general = new General();
$obj_usuario = new Usuario();
/*Peticion*/
//*******************

$usuario     = $control->fn_get_dato($forma, 'USUARIO');
$nombre      = $control->fn_get_dato($forma, 'NOMBRES');
$password    = $control->fn_get_dato($forma, 'PASSWORD');
$password_c  = $control->fn_get_dato($forma, 'PASSWORD_C');

if($password == ""){
    $password = null;
}
    
if($password == $password_c || $password = null){
    
    $datos_cs =  $obj_usuario->fn_consulta_usuario_id(null,$ajax,$usuario);
    
    $continuar = true;
    
    if($datos_cs != null){
        if($datos_cs['COD_USUARIO'] != $datos['COD_USUARIO'] ){
            $continuar = false;
        }
    }
    
    if( $continuar == true ){
        if($obj_usuario->fn_modificar_usuario($datos['COD_USUARIO'],$usuario, $nombre, $password,$ajax,null)){
            $ajax->setMensaje("El usuario fue modificado con exito.");
            $ajax->setResultado("Exito");
        }
    }else{
        $ajax->setError("El usuario ya existe.");
    }
    
}else{
    $ajax->setError("Las Contrasenas No son iguales.");
}


//retorno objeto ajax
$ajax->RetornarJSON();
//Fin
?>
