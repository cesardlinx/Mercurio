<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fechas extends MY_Controller {

    private static $seccion = 'fechas';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
	}

	/*indice de fechas*/
	public function index()
	{
		$data = $this->model->index();
		$data['seccion'] = self::$seccion;
		$this->loadTemplate('indices/indice', $data);
	}

	// ------------------------------------------------------------------------

	public function crear()
	{
		$this->load->model('eventos_model');
		$data['combo_eventos'] = $this->eventos_model->combo_temas();
		$this->loadTemplate(self::$seccion.'/crear', $data);
	}


	public function almacenar()
	{	
		$datos = array(
			'eve_id' => $this->input->post('eve_id'), 
			'eve_fecha' => $this->input->post('eve_fecha'), 
			'eve_inicia' => $this->input->post('eve_inicia'), 
			'eve_termina' => $this->input->post('eve_termina'), 
		);


		$this->model->almacenar_mdl($datos);
		redirect('admin/'.self::$seccion,'refresh');
	}

	// ------------------------------------------------------------------------

	public function modificar($id)
	{
		$this->load->model('eventos_model');

		$data = $this->model->obtener_datos($id);
		$data['combo_eventos'] = $this->eventos_model->combo_temas($id);
		
		$this->loadTemplate(self::$seccion.'/modificar', $data);
	}


	 public function actualizar() {

		$id = $this->input->post('id');

		$datos = array(
			'eve_id' => $this->input->post('eve_id'), 
			'eve_fecha' => $this->input->post('eve_fecha'), 
			'eve_inicia' => $this->input->post('eve_inicia'), 
			'eve_termina' => $this->input->post('eve_termina'), 
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

