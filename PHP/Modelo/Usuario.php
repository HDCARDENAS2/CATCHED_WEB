<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name Usuario
 * @Date 05/11/2017
 *
 * Clase de consultas de usuario
 */
require_once('../Config/ConexionBD.php');

class Usuario {
	
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail dropimax@gmail.com
	 * @Name fn_consulta_usuario
	 * @Date 05/11/2017
	 * Consulta un usuario mediante un usuario y contrasena
	 */
	function fn_consulta_usuario( $bd = null , $ajax = null ,$usuario,$contrasena){
		$array = null;
		
		if($bd == null){
			$bd = new ConexionBD();
		}
		
		if($bd->iniciar()){
			/** Sentencia */
			$bd->setSentencia('select COD_USUARIO, NOMBRES, FECHA_CREACION, COD_ROLL, IND_ESTADO  from CT_USUARIO where usuario=? and contrasena=? ');
			$bd->setParametro($usuario);
			$bd->setParametro($contrasena);
			
			if($bd->Ejecutar()){
				$array = $bd->getResutados(false);
			}
		}
		/** En caso de errores */
		if($bd->Errores()){
			$bd->printErrores('Usuario::fn_consulta_usuario',$ajax);
		}
		
		$bd->Cerrar();
		return $array;
		
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail dropimax@gmail.com
	 * @Name fn_consulta_usuarios
	 * @Date 06/11/2017
	 * Consulta usuarios registrados
	 */
	function fn_consulta_usuarios( $bd = null , $ajax = null ){
	    $array = null;
	    
	    if($bd == null){
	        $bd = new ConexionBD();
	    }
	    
	    if($bd->iniciar()){
	        /** Sentencia */
	        $bd->setSentencia('select COD_USUARIO, NOMBRES, FECHA_CREACION, COD_ROLL, IND_ESTADO from CT_USUARIO where cod_roll=?');
	        $bd->setParametro('2');

	        if($bd->Ejecutar()){
	            $array = $bd->getResutados();
	        }
	    }
	    /** En caso de errores */
	    if($bd->Errores()){
	        $bd->printErrores('Usuario::fn_consulta_usuario',$ajax);
	    }
	    
	    $bd->Cerrar();
	    return $array;
	    
	}
	
	
}
?>