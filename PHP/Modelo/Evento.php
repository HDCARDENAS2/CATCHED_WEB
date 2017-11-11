<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name Evento
 * @Date 05/11/2017
 *
 * Clase de control de servicios
 */
require_once('../Config/ConexionBD.php');

class Evento {
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name  fn_consulta_evento
	 * @Date  05/11/2017
	 * Consulta el evento a notificar
	 */
	function fn_consulta_evento_notifica($bd = null, $ajax = null,$fecha){
		$array = null;
		
		if($bd == null){
			$bd = new ConexionBD();
		}
		
		if($bd->iniciar()){

			/** Sentencia */
		    $bd->setSentencia("select COD_EVENTO, RUTA, NOMBRE_IMG, FECHA_CREACION from ct_evento WHERE FECHA_CREACION > ".$fecha."  ORDER BY COD_EVENTO DESC LIMIT 1 ");
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
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name  fn_consulta_evento
	 * @Date  05/11/2017
	 * Ultima fecha
	 */
	function fn_consulta_ultimo_evento_notifica($bd = null, $ajax = null){
	    $array = null;
	    
	    if($bd == null){
	        $bd = new ConexionBD();
	    }
	    
	    if($bd->iniciar()){
	        /** Sentencia */
	        $bd->setSentencia('select FECHA_CREACION from ct_evento  ORDER BY COD_EVENTO DESC LIMIT 1 ');	        
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
	
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name  fn_consulta_eventos
	 * @Date  05/11/2017
	 * Consulta los eventos
	 */
	function fn_consulta_eventos($bd = null, $ajax = null){
	    $array = null;
	    
	    if($bd == null){
	        $bd = new ConexionBD();
	    }
	    
	    if($bd->iniciar()){
	        /** Sentencia */
	        $bd->setSentencia('select * from ct_evento ORDER BY FECHA_CREACION DESC');
	        if($bd->Ejecutar()){
	            $array = $bd->getResutados();
	        }
	    }
	    /** En caso de errores */
	    if($bd->Errores()){
	        $bd->printErrores('Evento::fn_consulta_eventos',$ajax);
	    }
	    
	    $bd->Cerrar();
	    return $array;
	}
	
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name  fn_consulta_eventos
	 * @Date  05/11/2017
	 * Consulta los eventos
	 */
	function fn_consulta_imagen($bd = null, $ajax = null, $cod_evento){
	    $array = null;
	    
	    if($bd == null){
	        $bd = new ConexionBD();
	    }
	    
	    if($bd->iniciar()){
	        /** Sentencia */
	        $bd->setSentencia('select * from ct_evento where cod_evento = ?');
	        $bd->setParametro($cod_evento);
	        if($bd->Ejecutar()){
	            $array = $bd->getResutados(false);
	        }
	    }
	    /** En caso de errores */
	    if($bd->Errores()){
	        $bd->printErrores('Evento::fn_consulta_eventos',$ajax);
	    }
	    
	    $bd->Cerrar();
	    return $array;
	}
	
		
}
?>