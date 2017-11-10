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
			$bd->setSentencia('select COD_USUARIO, NOMBRES, USUARIO, FECHA_CREACION, COD_ROLL, IND_ESTADO  from ct_usuario where usuario=? and contrasena=? ');
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
	        $bd->setSentencia('select COD_USUARIO, NOMBRES, USUARIO, FECHA_CREACION, COD_ROLL, IND_ESTADO from ct_usuario where cod_roll=?');
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
	
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail dropimax@gmail.com
	 * @Name fn_consulta_usuarios
	 * @Date 06/11/2017
	 * Consulta usuarios registrados
	 */
	function fn_consulta_usuario_id( $bd = null , $ajax = null, $usuario ){
	    $array = null;
	    
	    if($bd == null){
	        $bd = new ConexionBD();
	    }
	    
	    if($bd->iniciar()){
	        /** Sentencia */
	        $bd->setSentencia('select COD_USUARIO, NOMBRES, USUARIO,  FECHA_CREACION, COD_ROLL, IND_ESTADO  from ct_usuario where usuario=? ');
	        $bd->setParametro($usuario);
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
	 * @Name fn_update_area_laboral
	 * @Date 06/11/2017
	 * Inserta un usuario
	 */
	
	function fn_insert_usuario(  $usuario
	                            ,$nombre
	                            ,$password
	                            ,$ajax = null 
	                            ,$bd = null 
	    
	                            ){
	    
	    $repuesta = false;
	    
	    if($bd == null){
	        $bd = new ConexionBD();
	    }
	    
	    if($bd->iniciar()){
	        /** Sentecia */
	        $bd->setSentencia('INSERT INTO ct_usuario (USUARIO,NOMBRES,CONTRASENA) VALUES(?,?,?);');
	        /** Parametros */
	        $bd->setParametro($usuario);
	        $bd->setParametro($nombre);
	        $bd->setParametro($password);
	        /** Ejecutamos */
	        if($bd->Ejecutar()){
	            $bd->Commit();
	            $repuesta = true;
	        }else{
	            $bd->RollBack();
	        }
	    }
	    /** Errores */
	    if($bd->Errores()){
	        $bd->printErrores('Usuario::fn_insert_usuario', $ajax);
	    }
	    /** Cierre de la conexion */
	    $bd->Cerrar();
	    
	    return $repuesta;
	}
	
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail dropimax@gmail.com
	 * @Name fn_update_area_laboral
	 * @Date 06/11/2017
	 * Inserta un usuario
	 */
	
	function fn_modificar_usuario(  
	     $codigo
	    ,$usuario
	    ,$nombre
	    ,$password
	    ,$ajax = null
	    ,$bd = null
	    
	    ){
	        
	        $repuesta = false;
	        
	        if($bd == null){
	            $bd = new ConexionBD();
	        }
	        
	        if($bd->iniciar()){
	            /** Sentecia */
	            $bd->setSentencia('UPDATE ct_usuario SET NOMBRES = IFNULL(?,NOMBRES),  USUARIO= IFNULL(?,USUARIO),  CONTRASENA=  IFNULL(?,CONTRASENA) WHERE COD_USUARIO= ?');
	            /** Parametros */
	            $bd->setParametro($nombre);
	            $bd->setParametro($usuario);
	            $bd->setParametro($password);
	            $bd->setParametro($codigo);
	            /** Ejecutamos */
	            if($bd->Ejecutar()){
	                $bd->Commit();
	                $repuesta = true;
	            }else{
	                $bd->RollBack();
	            }
	        }
	        /** Errores */
	        if($bd->Errores()){
	            $bd->printErrores('Usuario::fn_insert_usuario', $ajax);
	        }
	        /** Cierre de la conexion */
	        $bd->Cerrar();
	        
	        return $repuesta;
	}
	
	
	
	
	
}
?>