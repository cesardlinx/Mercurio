<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suscriptores extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //conectado();
        $this->load->model('suscriptores_model', 'model');
    }

    public function index() {
        $data = $this->model->index_mdl();
        $this->loadTemplate("suscriptores/index", $data);
    }

    public function crear() {
        $this->loadTemplate("suscriptores/crear");
    }

    public function almacenar() {
        $usu_id = $this->model->almacenar_mdl();
        redirect('admin/suscriptores', 'refresh');
    }

    public function modificar() {
        $id = $this->uri->segment(4);
        $data = $this->model->datos_suscriptor();
        $this->loadTemplate('suscriptores/modificar', $data);
    }

    public function actualizar() {
        $this->model->actualizar_mdl();
        redirect('admin/suscriptores', 'refresh');
    }

    public function eliminar() {
        $this->model->eliminar_mdl();
        redirect('admin/suscriptores', 'refresh');
    }

}
