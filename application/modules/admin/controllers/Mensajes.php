<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes extends MY_Controller {

    private static $seccion = 'mensajes';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
	}

	/*indice de mensajes*/
	public function index()
	{
		$data = $this->model->index();
		$data['seccion'] = self::$seccion;
		$this->loadTemplate('indices/indice', $data);
	}

	// ------------------------------------------------------------------------

	public function crear()
	{
		$this->load->model('temas_model');
		$data['combo_temas'] = $this->temas_model->combo_temas();
		$this->loadTemplate(self::$seccion.'/crear', $data);
	}


	public function almacenar()
	{	
		$datos = array(
			'tem_id' => $this->input->post('tem_id'), 
			'msj_titulo' => $this->input->post('msj_titulo'), 
			'msj_descripcion' => $this->input->post('msj_descripcion'), 
			'msj_estado' => $this->input->post('msj_estado'), 
		);


		$this->model->almacenar_mdl($datos);
		redirect('admin/'.self::$seccion,'refresh');
	}

	// ------------------------------------------------------------------------

	public function modificar($id)
	{
		$this->load->model('temas_model');

		$data = $this->model->obtener_datos($id);
		$tem_id = $data['tem_id'];
		$data['combo_temas'] = $this->temas_model->combo_temas($tem_id);
		$data['combo_estado'] = $this->model->combo_estado($id);

		$this->loadTemplate(self::$seccion.'/modificar', $data);
	}


	 public function actualizar() {

		$id = $this->input->post('id');

		$datos = array(
			'tem_id' => $this->input->post('tem_id'), 
			'msj_titulo' => $this->input->post('msj_titulo'), 
			'msj_descripcion' => $this->input->post('msj_descripcion'), 
			'msj_estado' => $this->input->post('msj_estado'), 
		);

	    $this->model->actualizar_mdl($id, $datos);
        redirect('admin/'.self::$seccion, 'refresh');
    }

    // ------------------------------------------------------------------------

    public function eliminar($id)
    {
    	$this->model->eliminar_mdl($id);
    	redirect('admin/'.self::$seccion,'refresh');

    }
}

