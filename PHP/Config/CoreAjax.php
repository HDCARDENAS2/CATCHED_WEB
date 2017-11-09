<?php

class CoreAjax {
	

var $array_errors;	
var $array_mensajes;
var $js_object_encoded;



public function __construct(){
	$this->array_errors                  = array();
	$this->array_mensajes                = array();
	$this->js_object_encode              = array();
	$this->js_object_encode['errors']    = null;
	$this->js_object_encode['messages']  = null;
	$this->js_object_encode['resultado'] = null;
}

/**
 * Esta adiciona un errror
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2016
 * @access public
 */

function setError($msn){
    $this->array_errors[ count( $this->array_errors)]['msn'] = $msn ;

}

/**
 * Esta adiciona un mensaje
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2016
 * @access public
 */

function setMensaje($msn){
	$this->array_mensajes[count( $this->array_mensajes)]['msn']= $msn ;
}


/**
 * Esta funcion adiciona un nuevo msn al json
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2016
 * @access public
 */

function setmsn($llave,$valor){
	$this->js_object_encode[$llave] = $valor;
}



/**
 * Esta funcion adiciona un nuevo msn al json
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2017
 * @access public
 */

function setResultado($valor){
	$this->js_object_encode['resultado'] = $valor;
}



/**
 * Esta funcion adiciona un nuevo msn al json
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2017
 * @access public
 */

function setDato($llave,$valor){
    $this->js_object_encode[$llave] = $valor;
}


/**
 * Esta funcion valida si hay errores de mensajes en la forma
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2016
 * @access public
 */

function RetornarJSON($UTF8_ENCODE = true){

	if (count($this->array_errors) > 0) {
		$this->js_object_encode['errors'] = ($UTF8_ENCODE == true) ?
		CoreAjax::ConvertArrayUTF8($this->array_errors)
		:
		$this->array_errors;
	}
	
	if (count($this->array_mensajes) > 0) {
		$this->js_object_encode['messages'] = ($UTF8_ENCODE == true) ?
		CoreAjax::ConvertArrayUTF8($this->array_mensajes)
		:
		$this->array_mensajes;
	}
	echo json_encode($this->js_object_encode);
}

/**
 * Esta funcion valida si hay errores de mensajes en la forma
 *
 * @author Hernan Dario Cardenas
 *         @email dropimax@gmail.com
 *         @date 05/11/2016
 * @access public
 */

function ConvertArrayUTF8($arraycv){
	for ($i = 0; $i < count($arraycv); $i++) {
	    $arraycv[$i]['msn']=utf8_encode($arraycv[$i]['msn']);
	}
	return $arraycv;
}

}
?>