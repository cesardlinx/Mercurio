<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //$this->constantes_model->cargar_datos();
        //registroAcciones();
      /* if($this->input->is_ajax_request()) {
        $this->output->enable_profiler(false);
    } else {
        $this->output->enable_profiler(true);
    }*/
}

public function loadTemplate($view, $data = array()) {
    $this->load->view("general/cabecera");
    $this->load->view($view, $data);
    $this->load->view("general/pie");
}

public function cargarPlantilla($view, $data = array()) {
    $this->load->view("general/encabezado");
    $this->load->view($view, $data);
    $this->load->view("comun/firma");
}

}
