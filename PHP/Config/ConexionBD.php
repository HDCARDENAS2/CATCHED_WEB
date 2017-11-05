<?php
/*
 * @Autor Hernan Dario Cardenas
 * @Mail  dropimax@gmail.com
 * @Name ConexionBD
 * @Date 29/10/2016
 *
 * Clase de conexion base de datos mysql
 */
class ConexionBD {
	
    //Variables
	var $o_db;
	var $o_resultArray;
	var $array_erros;
	var $sql_exct;
	var $parametro;

	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name __construct
	 * @Date 29/10/2016
	 */
	
    public function __construct(){
    	$this->o_db = null;
    	$this->o_resultArray = array();
    	$this->array_erros     = array();
    	$this->sql_exct      = null;
    	$this->parametro     = array();
    }
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name iniciar
	 * @Date 29/10/2016
	 * Esta funcion inicia la conexion
	 */

	function iniciar($autocoomit = false){

			$this->Limpiar();
            //Se lee el archivo de configuracion
			$archivo = parse_ini_file('../../bd.ini');
			
			$db = mysqli_connect($archivo['host'],
					$archivo['username'],
					$archivo['password'],
					$archivo['dbname'],
					$archivo['port']);
			
			if (!$db) {
				$this->set_Error("Error: No se pudo conectar a MySQL. " . mysqli_connect_error());
				$this->o_db = null;
				return false;
			}else{
				mysqli_autocommit ($db,$autocoomit );
				$this->o_db = $db;
				return true;
			}
	
	}
		
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name setSentencia
	 * @Date 29/10/2016
	 * Esta funcion cambia la sentecia sql a ejecutar
	 */
	
	function setSentencia($sql){
		$this->sql_exct   = $sql;
		$this->parametro  = null;
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name setParametro
	 * @Date 29/10/2016
	 * Esta funcion adiciona un parametro para consultar en el query
	 */
	
	function setParametro($dato){
		$this->parametro[count($this->parametro)+1] = $dato;
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name Ejecutar
	 * @Date 29/10/2016
	 * Esta funcion ejecuta la sentencia sql con sus parametros
	 */
	
	function Ejecutar(){	
		$query    = $this->sql_exct;
		$link   = $this->o_db;
		
		if($query != "" && $link != null){
			
			$params  = $this->parametro;		
			$typeDef = FALSE;
			$bindParams = array();

			for($i = 0; $i < count($params); $i++){
				$typeDef.="s";
			}	
			
			if($stmt = mysqli_prepare($link,$query)){
				
				$params = array($params);
			
				if($typeDef){

					$bindParamsReferences = array();
					$bindParams = $params[0];
					
					foreach($bindParams as $key => $value){
						$bindParamsReferences[$key] = &$bindParams[$key];
					}
					array_unshift($bindParamsReferences,$typeDef);
					$bindParamsMethod = new ReflectionMethod('mysqli_stmt', 'bind_param');
					$bindParamsMethod->invokeArgs($stmt,$bindParamsReferences);
				}
			
				$result = null;
				
				foreach($params as $queryKey => $query){
					foreach($bindParams as $paramKey => $value){
						$bindParams[$paramKey] = $query[$paramKey];
					}
					$queryResult = array();
					if(mysqli_stmt_execute($stmt)){
						$resultMetaData = mysqli_stmt_result_metadata($stmt);
						if($resultMetaData){
							$stmtRow = array();
							$rowReferences = array();
							while ($field = mysqli_fetch_field($resultMetaData)) {
								$rowReferences[] = &$stmtRow[$field->name];
							}
							mysqli_free_result($resultMetaData);
							$bindResultMethod = new ReflectionMethod('mysqli_stmt', 'bind_result');
							$bindResultMethod->invokeArgs($stmt, $rowReferences);
							while(mysqli_stmt_fetch($stmt)){
								$row = array();
								foreach($stmtRow as $key => $value){
									$row[$key] = $value;
								}
								$queryResult[] = $row;
							}
							mysqli_stmt_free_result($stmt);
						} else {
							$queryResult[] = mysqli_stmt_affected_rows($stmt);
						}
					} else {
						$this->set_Error($this->o_db->error);
						return false;
					}
					$result[$queryKey] = $queryResult;
				}
				mysqli_stmt_close($stmt);
			} else {
				$this->set_Error($this->o_db->error);
				return false;
			}
			
			$this->o_resultArray = $queryResult;
			
			return true;
		}
	    return false;
	}

	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name getResutados
	 * @Date 29/10/2016
	 * @Parametro $multiple
	 * @return Array
	 * Esta funcion retorna los resultados;
	 */
	
	function getResutados($multiple = true){
		if($multiple){
			return count($this->o_resultArray) > 0 ? $this->o_resultArray : null ;
		}else{
			//Solo el primero
			$array = null;
			foreach ($this->o_resultArray as $key => $value) {
				$array = $value;
				break;
			}
			return $array;
		}		
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name Cerrar
	 * @Date 29/10/2016
	 *
	 * Esta funcion Cierra la conexion de la base de datos
	 */
	
    function Cerrar(){
      if($this->Validador()){
          mysqli_close($this->o_db);
      }	
	}

	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name Validador
	 * @Date 29/10/2016
	 * Esta funcion valida el estado del objeto de conexion
	 */
	
    function Validador(){
		if($this->o_db != null){
			return true;
		}else{
			return false;
		}
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name Limpiar
	 * @Date 29/10/2016
	 * Esta funcion reinicia el array de errores
	 */
	
	function Limpiar(){
		$this->o_resultArray = array();
		$this->array_erros   = array();
		$this->sql_exct      = null;
		$this->parametro     = array();
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name set_Error
	 * @Date 29/10/2016
	 * Esta funcion adiciona los errores
	 */
	
    function set_Error($mensaje){
    	$this->array_erros[count($this->array_erros)+1] = $mensaje;
    	$this->o_resultArray = null;
    	$this->sql_exct      = null;
    	$this->parametro     = null;
	}
		
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name Errores
	 * @Date 29/10/2016
	 * @return boolean
	 * Esta funcion validad si hubo errores
	 */
	
	function Errores(){
      if(count($this->array_erros) > 0){
       	 return true;
      }else{
      	 return false;
      }
	}
	
	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name printErrores
	 * @Date 29/10/2016
	 * Esta fucion que imprime los errores 
	 */
	
	function printErrores($clase,$ajax = null){
		
		$mensaje_final = "";
		
		if($ajax != null){
			
			$mensaje_final = $clase;
			$ajax->setError($mensaje_final);
			foreach ($this->array_erros as $clave => $valor){
				$ajax->setError($this->array_erros[$clave]);
			}
			
		}else{
			$mensaje_final = $clase.'<br>';
			foreach ($this->array_erros as $clave => $valor){
				$mensaje_final.= $this->array_erros[$clave].'<br>';
			}
			echo $mensaje_final;
		}
		
	}
	

	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name Commit
	 * @Date 06/11/2016
	 *  Esta fucion hace commit a la transacion
	 */
	
	function Commit(){
		mysqli_commit($this->o_db);
	}
	

	/*
	 * @Autor Hernan Dario Cardenas
	 * @Mail  dropimax@gmail.com
	 * @Name RollBack
	 * @Date 06/11/2016
	 * Esta fucion hace rollback a la transacion
	 */
	
	function RollBack(){
		mysqli_rollback($this->o_db);
	}
	
}

?>