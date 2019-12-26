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

    // ------------------------------------------------------------------------

    public function crear() {
        $this->loadTemplate("suscriptores/crear");
    }

    public function almacenar() {
        $hoy = hoy('c');
        $data = array(
            "sus_nombres" => $this->input->post('sus_nombres'),
            "sus_apellidos" => $this->input->post('sus_apellidos'),
            "sus_email" => $this->input->post('sus_email'),
            "sus_celular" => $this->input->post('sus_celular'),
            "sus_fecha" => $hoy,
        );
        $usu_id = $this->model->almacenar_mdl($data);
        redirect('admin/suscriptores', 'refresh');
    }

    // ------------------------------------------------------------------------

    public function modificar($id) {
        $data = $this->model->datos_suscriptor($id);
        $this->loadTemplate('suscriptores/modificar', $data);
    }

    public function actualizar() {
        $this->model->actualizar_mdl();
        redirect('admin/suscriptores', 'refresh');
    }

    // ------------------------------------------------------------------------

    public function eliminar($id) {
        $this->model->eliminar_mdl($id);
        redirect('admin/suscriptores', 'refresh');
    }

    // ------------------------------------------------------------------------

    // verifica la existencia del correo en la base de datos
    public function validar_correo()
    {
        // tipo de salida json
        $this->output->set_content_type('application/json');

        $sus_email = $this->input->post('sus_email');

        $respuesta = $this->model->existe_suscriptor($sus_email);
        $validacion = $respuesta['validacion'];

        /*salida json*/
        if ($validacion) {
            $this->output->set_output(json_encode(true));
        } else {
            $this->output->set_output(json_encode(false));
        }

    }

    // ------------------------------------------------------------------------



}
