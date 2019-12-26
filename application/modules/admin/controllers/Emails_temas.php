<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_temas extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model('admin/emails_temas_model', 'model');

	}

	// ------------------------------------------------------------------------

	public function almacenar()
	{	

		// traduce el email del suscriptor en id
		$this->load->model('admin/suscriptores_model', 'suscriptores');

		$sus_email = $this->input->post('sus_email');

    $suscriptor = $this->suscriptores->obtener_datos(array(
        'sus_email' => $sus_email 
    ));


		//convierte la fecha ingresada en una 'fecha' propiamente
		$fecha_programada_input = $this->input->post('eml_fecha_programada');
		$stamp = strtotime($fecha_programada_input);
		$eml_fecha_programada = date('Y-m-d H:i:s', $stamp);


		$datos = array(
			'tem_id' => $this->input->post('tem_id'),
			'eml_asunto' => $this->input->post('eml_asunto'),
			'eml_contenido' => $this->input->post('eml_contenido'),
			'eml_fecha_ingreso' => $this->input->post('eml_fecha_ingreso'),
			'eml_fecha_programada' => $eml_fecha_programada,
			'eml_estado' => $this->input->post('eml_estado'),
			'eml_smtp_id' => $this->input->post('ser_id')
		);

    $datos['sus_id'] = $suscriptor[0]['id'];


		$this->model->almacenar_mdl($datos);
	}

	// ------------------------------------------------------------------------



	 public function actualizar() {

		$id = $this->input->post('id');

		$this->load->model('admin/suscriptores_model', 'suscriptores');

		$sus_email = $this->input->post('sus_email');

    $suscriptor = $this->suscriptores->obtener_datos(array(
        'sus_email' => $sus_email 
    ));

    //convierte la fecha ingresada en una 'fecha' propiamente
		$fecha_programada_input = $this->input->post('eml_fecha_programada');
		$stamp = strtotime($fecha_programada_input);
		$eml_fecha_programada = date('Y-m-d H:i:s', $stamp);


		$datos = array(
			'tem_id' => $this->input->post('tem_id'),
			'eml_asunto' => $this->input->post('eml_asunto'),
			'eml_contenido' => $this->input->post('eml_contenido'),
			'eml_fecha_ingreso' => $this->input->post('eml_fecha_ingreso'),
			'eml_fecha_programada' => $eml_fecha_programada,
			'eml_estado' => $this->input->post('eml_estado'),
			'eml_smtp_id' => $this->input->post('ser_id')
		);

		$datos['sus_id'] = $suscriptor[0]['id'];

	  $this->model->actualizar_mdl($id, $datos);

    }

    // ------------------------------------------------------------------------

    public function eliminar($id)
    {
    	$this->model->eliminar_mdl($id);

    }

    // ------------------------------------------------------------------------

  	public function datos_email()
    {
      $this->output->set_content_type('application/json');

      $this->load->model('admin/suscriptores_model', 'suscriptores');

			$id = $this->input->post('id'); //id del email
			$email = $this->model->obtener_datos($id); //datos del email
			$sus_id = $email['sus_id'];
			$suscriptor = $this->suscriptores->datos_suscriptor($sus_id); //datos del suscriptor
			//el cual es el destinatario del email

			//email del suscriptor destinatario de acuerdo al id dado
			$email['sus_email'] = $suscriptor['sus_email'];
			
			/*salida json*/
      // $this->output->set_output(json_encode($email));
      $this->output->set_output(json_encode($email));

    }

}
