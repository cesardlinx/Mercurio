<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temas extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('temas_model', 'model');
    }

    public function index() {
        $data = $this->model->index();
        $this->loadTemplate('temas/index', $data);
    }

    public function crear() {
        $this->loadTemplate('temas/crear');
    }

    public function almacenar() {
        $this->model->almacenar_mdl();
        redirect('admin/temas', 'refresh');
    }

    public function modificar() {
        $data = $this->model->datos_tema();
        $this->loadTemplate('temas/modificar', $data);
    }

    public function actualizar() {
        $this->model->actualizar_mdl();
        redirect('admin/temas', 'refresh');
    }

    public function eliminar() {
        echo $this->model->eliminar_mdl();
    }

}
