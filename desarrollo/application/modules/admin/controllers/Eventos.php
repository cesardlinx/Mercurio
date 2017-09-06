<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Eventos extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('eventos_model', 'model');
    }

    public function index() {
        $data = $this->model->index();
        $this->loadTemplate('eventos/index', $data);
    }

    public function crear() {
        $this->load->model('locaciones_model');
        $this->load->model('temas_model');
        $this->load->model('usuarios_model');
        $data["cmb_locaciones"] = $this->locaciones_model->combo_locaciones();
        $data["cmb_temas"] = $this->temas_model->combo_temas();
        $data["cmb_usuarios"] = $this->usuarios_model->combo_usuarios_mdl('','', 'usu_id_conferencista');
        $this->loadTemplate('eventos/crear',$data);
    }

    public function almacenar() {
        $this->model->almacenar_mdl();
        redirect('admin/eventos', 'refresh');
    }

    public function modificar() {
        $this->load->model('locaciones_model');
        $this->load->model('temas_model');
        $this->load->model('usuarios_model');
        $data = $this->model->datos_evento();
        $data["cmb_locaciones"] = $this->locaciones_model->combo_locaciones($data["loc_id"]);
        $data["cmb_temas"] = $this->temas_model->combo_temas($data["tem_id"]);
        $data["cmb_usuarios"] = $this->usuarios_model->combo_usuarios_mdl($data["usu_id_conferencista"],'', 'usu_id_conferencista');

        $this->loadTemplate('eventos/modificar', $data);
    }

    public function actualizar() {
        $this->model->actualizar_mdl();
        redirect('admin/eventos', 'refresh');
    }

    public function eliminar() {
        echo $this->model->eliminar_mdl();
    }

}
