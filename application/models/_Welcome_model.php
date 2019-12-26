<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function portada() {


    	$buscar = $this->uri->segment(1);

    	if($buscar!="") {
            
            redirect(url_base(),'refresh')
        }

    }

}

?>