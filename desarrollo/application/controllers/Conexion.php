<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conexion extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conexion_model', 'conexion');
    }

    public function index() {
        $this->force_ssl();
        $datos = $this->conexion->index();
        if ($datos == FALSE) {
            if ($this->conexion->verificar_contrasena())
                redirect("/admin", 'refresh');
            else
                redirect("general/avisocad", 'refresh');
        } else {
            $this->load->view('conexion/index',$datos);
        }
    }

    function force_ssl() {
        if(ENVIRONMENT=="production"){
            if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
                $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                redirect($url, "refresh");
                exit;
            } /* Si es https entonces que siga nomás */
        }/* Si no es produccion, que siga nomas */
    }

    public function conectar() {
        echo $this->conexion->verificar();
    }

    public function salir() {
        $this->session->sess_destroy();
        $url_salir = $this->config->item('con_emp_al_salir');
        if ($url_salir == '')
            redirect("/");
        else
            redirect($url_salir, "refresh");
    }

}
