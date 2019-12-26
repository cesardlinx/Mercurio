<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_temas extends MY_Controller {

    private static $seccion = 'emails_temas';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
		$this->load->model('temas_model');
		$this->load->model('suscriptores_model');
		$this->load->model('servidores_model');

	}

	/*indice de emails*/
	public function index()
	{
		$data = $this->model->index();
		$this->loadTemplate(self::$seccion.'/index', $data);
	}

	// ------------------------------------------------------------------------

	public function crear()
	{

		$data['combo_estado'] = $this->model->combo_estado();
		$data['combo_temas'] = $this->temas_model->combo_temas();
		$data['combo_suscriptores'] = $this->suscriptores_model->combo_suscriptores();
		$data['combo_servidores'] = $this->servidores_model->combo_servidores();

		$this->loadTemplate(self::$seccion.'/crear', $data);
	}


	public function almacenar()
	{	

		$eml_fecha_envio = $this->input->post('eml_fecha_envio');
		$eml_hora_envio = $this->input->post('eml_hora_envio');
		$stamp = strtotime($eml_fecha_envio.' '.$eml_hora_envio);
		$eml_envio = date('Y/m/d H:ia', $stamp);


		$datos = array(
			'sus_id' => $this->input->post('sus_id'),
			'tem_id' => $this->input->post('tem_id'),
			'eml_asunto' => $this->input->post('eml_asunto'),
			'eml_contenido' => $this->input->post('eml_contenido'),
			'eml_fecha' => $this->input->post('eml_fecha'),
			'eml_fecha_envio' => $eml_envio,
			'eml_estado' => $this->input->post('eml_estado'),
			'eml_smtp_id' => $this->input->post('ser_id'),
			'eml_error' => $this->input->post('eml_error')
		);


		$this->model->almacenar_mdl($datos);
		redirect('admin/'.self::$seccion,'refresh');
	}

	// ------------------------------------------------------------------------

	public function modificar($id)
	{

		$data = $this->model->obtener_datos($id);

		$sus_id = $data['sus_id'];
		$tem_id = $data['tem_id'];
		$eml_smtp_id = $data['eml_smtp_id'];

		$data['combo_estado'] = $this->model->combo_estado($id);
		$data['combo_temas'] = $this->temas_model->combo_temas($tem_id);
		$data['combo_suscriptores'] = $this->suscriptores_model->combo_suscriptores($sus_id);
		$data['combo_servidores'] = $this->servidores_model->combo_servidores($eml_smtp_id);
		
		$eml_envio = $data['eml_fecha_envio'];
		$fecha_exploded = explode(' ', $eml_envio);
		$data['eml_fecha_envio'] = $fecha_exploded[0];
		$data['eml_hora_envio'] = $fecha_exploded[1];


		$this->loadTemplate(self::$seccion.'/modificar', $data);
	}


	 public function actualizar() {

		$id = $this->input->post('id');

		$eml_fecha_envio = $this->input->post('eml_fecha_envio');
		$eml_hora_envio = $this->input->post('eml_hora_envio');
		$stamp = strtotime($eml_fecha_envio.' '.$eml_hora_envio);
		$eml_envio = date('Y/m/d H:ia', $stamp);

		$datos = array(
			'sus_id' => $this->input->post('sus_id'),
			'tem_id' => $this->input->post('tem_id'),
			'eml_asunto' => $this->input->post('eml_asunto'),
			'eml_contenido' => $this->input->post('eml_contenido'),
			'eml_fecha' => $this->input->post('eml_fecha'),
			'eml_fecha_envio' => $eml_envio,
			'eml_estado' => $this->input->post('eml_estado'),
			'eml_smtp_id' => $this->input->post('ser_id'),
			'eml_error' => $this->input->post('eml_error')
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

    // ------------------------------------------------------------------------

  

}

