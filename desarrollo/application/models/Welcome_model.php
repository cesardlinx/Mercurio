<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function portada() {
    	/*
    		Pagina principal
    		- Si no viene con texto en el url, genera dinamicamente la portada con los eventos por venir, mirar que estén aprobados
    		- Si viene con url, entonces mostrar la página de aterrizaje mas adecuada a las palabras claves
    		- Si no existe nada adecuado, generar la portada como si no hubiera llegado nada
    	*/

    	$buscar = $this->uri->segment(1);

    	if($buscar!="")
    		return $this->generarPortada($buscar);
    	else{

    		$html["html"] = "html $buscar";
        	return $html;
    	}
    }

    private function generarPortada($buscar){
    	$html["html"] = "generando portada ($buscar)";
    	return $html;
    }
}

?>