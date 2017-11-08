<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name General
 * @Date 07/11/2017
 *
 * Clase de control de servicios
 */
require_once('../Config/ConexionBD.php');

class General {
    
    /*
     * @Autor Hernan Dario Cardenas
     * @Mail  dropimax@gmail.com
     * @Name  fn_consulta_parametro
     * @Date  06/11/2017
     * Consulta parametros
     */
    function fn_consulta_parametro($bd = null, $ajax = null,$cod_parametro){
        
        $array = null;
        
        if($bd == null){
            $bd = new ConexionBD();
        }
        
        if($bd->iniciar()){
            /** Sentencia */
            $bd->setSentencia('select * from CT_PARAMETRO where COD_PARAMETRO=?');
            $bd->setParametro($cod_parametro);
            if($bd->Ejecutar()){
                $array = $bd->getResutados(false);
            }
        }
        /** En caso de errores */
        if($bd->Errores()){
            $bd->printErrores('Evento::fn_consulta_evento',$ajax);
        }
        
        $bd->Cerrar();
        return $array;
    }
    
  
}
?>