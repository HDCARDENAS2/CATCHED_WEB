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
	 * Consulta eventos
	 */
	function fn_consulta_evento($bd = null, $ajax = null){
		$array = null;
		
		if($bd == null){
			$bd = new ConexionBD();
		}
		
		if($bd->iniciar()){
			/** Sentencia */
			$bd->setSentencia('select * from CT_EVENTO ');
			if($bd->Ejecutar()){
				$array = $bd->getResutados();
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