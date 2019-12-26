<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidores extends MY_Controller {

    private static $seccion = 'servidores';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
	}

	/*indice de servidores*/
	public function index()
	{
		$data = $this->model->index();
		$data['seccion'] = self::$seccion;
		$this->loadTemplate('indices/indice', $data);
	}

	// ------------------------------------------------------------------------

	public function crear()
	{
		$data['password_seguro'] = $this->load->view("usuarios/password_seguro", array(), true);
		$this->loadTemplate(self::$seccion.'/crear',$data);
	}


	public function almacenar()
	{	
		$datos = array(
			'con_smtp_auth' => $this->input->post('con_smtp_auth'), 
			'con_smtp_sec' => $this->input->post('con_smtp_sec'), 
			'con_smtp_host' => $this->input->post('con_smtp_host'), 
			'con_smtp_user' => $this->input->post('con_smtp_user'), 
			'con_smtp_pass' => $this->input->post('con_smtp_pass'), 
			'con_smtp_port' => $this->input->post('con_smtp_port'), 
			'con_smtp_from' => $this->input->post('con_smtp_from')
		);


		$this->model->almacenar_mdl($datos);
		redirect('admin/'.self::$seccion,'refresh');
	}

	// ------------------------------------------------------------------------

	public function modificar($id)
	{
		$data = $this->model->obtener_datos($id);
		$data['combo_auth'] = $this->model->combo_auth($id);
		$data['combo_sec'] = $this->model->combo_sec($id);
		$data['password_seguro'] = $this->load->view("usuarios/password_seguro", array(), true);
		
		$this->loadTemplate(self::$seccion.'/modificar', $data);
	}


	 public function actualizar() {

		$id = $this->input->post('id');

		$datos = array(
			'con_smtp_auth' => $this->input->post('con_smtp_auth'), 
			'con_smtp_sec' => $this->input->post('con_smtp_sec'), 
			'con_smtp_host' => $this->input->post('con_smtp_host'), 
			'con_smtp_user' => $this->input->post('con_smtp_user'), 
			'con_smtp_pass' => $this->input->post('con_smtp_pass'), 
			'con_smtp_port' => $this->input->post('con_smtp_port'), 
			'con_smtp_from' => $this->input->post('con_smtp_from')
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

