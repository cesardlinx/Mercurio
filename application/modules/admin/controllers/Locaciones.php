<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locaciones extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('locaciones_model', 'model');
    }

    public function index() {
        $data = $this->model->index();
        $this->loadTemplate('locaciones/index', $data);
    }

    public function crear() {
        $this->loadTemplate('locaciones/crear');
    }

    public function almacenar() {
        $this->model->almacenar_mdl();
        redirect('admin/locaciones', 'refresh');
    }

    public function modificar() {
        $data = $this->model->datos_locacion();
        $this->loadTemplate('locaciones/modificar', $data);
    }

    public function actualizar() {
        $this->model->actualizar_mdl();
        redirect('admin/locaciones', 'refresh');
    }

    public function eliminar() {
        echo $this->model->eliminar_mdl();
    }

}
