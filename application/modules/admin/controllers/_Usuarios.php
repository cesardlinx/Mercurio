<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //conectado();
        $this->load->model('usuarios_model', 'model');
    }

    public function index() {
        $data = $this->model->index_mdl();
        $this->loadTemplate("usuarios/index", $data);
    }

    public function buscar_password() {
        echo $this->model->buscar_password_mdl();
    }

    public function crear() {
        $data['password_seguro'] = $this->load->view("usuarios/password_seguro", array(), true);
        $this->loadTemplate("usuarios/crear", $data);
    }

    public function almacenar() {
        $usu_id = $this->model->almacenar_mdl();
        redirect('admin/usuarios', 'refresh');
    }

    public function modificar($id) {
        $data = $this->model->datos_usuario($id);
        $data['password_seguro'] = $this->load->view("usuarios/password_seguro", array(), true);
        //$superadmin = $this->model->usuario_superadmin($this->session->userdata('log_usu_id'));
        $superadmin = false;
        if ($superadmin == true)
            $contrasena = $this->model->ultimo_password_mdl($this->uri->segment(4));
        else
            $contrasena = "";
        $data['usu_contrasena'] = $contrasena;
        $data['ver_pass'] = $superadmin;
        $this->loadTemplate('usuarios/modificar', $data);
    }

    public function actualizar() {
        $this->model->actualizar_mdl();
        redirect('admin/usuarios', 'refresh');
    }

    public function actualizar_password() {
        $this->model->actualizar_password_mdl();
        redirect(base_url() . 'conexion/salir', 'refresh');
    }

    public function eliminar() {
        $this->model->eliminar_mdl();
        redirect('admin/usuarios', 'refresh');
    }

    //???
    public function usuario_areas() {
        $id = $this->uri->segment(4);
        $data['id'] = $id;
        $data['combo'] = $this->model->rel_usu_areas_mdl($id);
        $data['usuario'] = datoDeTabla("admin_usuarios", "usu_nombres", $id) . " " . datoDeTabla("admin_usuarios", "usu_apellidos", $id);
        $this->loadTemplate('usuarios/rel_usu_areas', $data);
    }

    public function alm_rel_usu_areas() {
        $this->model->alm_rel_usu_areas_mdl();
        redirect('admin/usuarios', 'refresh');
    }

    public function combo_usuarios() {
        $usu_id = $this->input->post('usu_id');
        $are_id = $this->input->post('are_id');
        $name = $this->input->post('name');
        echo $this->model->cmb_usuarios_mdl($usu_id, $are_id, $name);
    }

    public function buscar_usuario() {
        $deque = $this->input->post('deque');
        if ($deque == 'c')
            echo $this->model->buscar_usuario();
        else
            echo $this->model->buscar_usuario2();
    }

    public function buscar() {
        $w_buscar = $this->input->get("keyword", true);
        $data = $this->model->nuevo_combo_mdl('', trim($w_buscar));
        echo json_encode($data);
    }



}
