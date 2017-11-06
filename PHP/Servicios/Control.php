<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name Control
 * @Date 05/11/2017
 *
 * Clase de control de servicios
 */
require_once('../Modelo/Usuario.php');

class Control {
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name  fn_validar_usuario
	 * @Date  05/11/2017
	 * Organiza informacion a validar
	 */
	function fn_validar_usuario( $cadena, $ajax){

		$datos        = null;
		$v_usuario    = null;
		$v_contrasena = null;
		$usuario      = new Usuario();
		
		try {
			
			$array = explode("::",$cadena);
			
			if(count($array) > 1 ){
			
				$str          =  substr(trim($array[0]),5);
			    $v_usuario    =  base64_decode($str);
				$v_contrasena =  substr(trim($array[1]),4);		
				$datos        =  $usuario->fn_consulta_usuario(null,$ajax,$v_usuario,$v_contrasena);	
			}
	
		} catch (Exception $e) {
			$ajax->setError($e);
		}
		return $datos;	
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name  fn_get_dato
	 * @Date  05/11/2017
	 * Valida si una variable no fue mandada
	 */
	function fn_get_dato($forma,$llave){
		return !empty($forma[$llave]) ? $forma[$llave] : null ;
	}
	
	
}
?>