<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //conectado();
    }

    public function index() {
        $this->loadTemplate("general/index");
    }

    public function alm_alto_ventana() {
        $h = $this->uri->segment(3);
        $arreglo = array(
            'ses_ven_alto' => $h
        );
        $this->session->set_userdata($arreglo);
    }

    
    public function avisocad() {
        $this->load->view("general/aviso_caducidad");
        $this->load->view("general/pie");
    }

    public function modificar_pass() {
        $this->loadTemplate("general/modificar_pass");
    }

    public function caotizar_pass() {
        $this->load->model("general_model");
        $this->general_model->crearCaosFechasPass();
    }

    

}
