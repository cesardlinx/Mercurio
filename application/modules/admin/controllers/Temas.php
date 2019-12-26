<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temas extends MY_Controller {

	private static $tem_por_pagina = 5; //número de temas por página
	private static $emails_por_pagina = 5; //número de emails por página

	private static $seccion = 'temas';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin/temas_model', 'model');
  }

  //------------------------------------------------------------------------

	public function index($page="")
	{


		$page_input = $this->input->get('page');

		// si la pagina viene por get, la toma, sino por el segmento de la uri
		if (isset($page_input)) {
			$pagina = $page_input;
		} else {
			$pagina = $page;			
		}

		// si no se indica, entonces la página es la primera
		$pagina = ($pagina == "") ? 1 : $pagina;


		$limite = self::$tem_por_pagina; //número de temas por página
		$offset = ($pagina*$limite)-$limite;

		
		// si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los temas
		$buscar = $this->input->get('buscar');

		if (isset($buscar) && strlen($buscar) > 3) {
			$temas = $this->model->buscar_temas_pag($buscar, $limite, $offset);
			$numero_temas = $this->model->total_busqueda_temas($buscar);
			$url = base_url().'admin/temas/index'.'?buscar='.$buscar.'&page='; // url para paginación
		} else {
			$temas = $this->model->temas_pagina($limite, $offset);
			$numero_temas = $this->model->numero_temas();
			$url = base_url().'admin/temas/index/'; // url para paginación
		}


		// todos los temas manda a un template 
		$temas_html = '';

		foreach ($temas as $tema) {
			$temas_html .= $this->parser->parse('temas/temas_tpl', $tema, TRUE);
		}



		// crea los botones de paginacion
		$paginacion = paginador_bootstrap($url, $numero_temas, $limite, $pagina);

		//breadcrumb

		$breadcrumb = breadcrumb_bootstrap('admin', self::$seccion);
	
		// si no hay temas
		if ($numero_temas == 0) {
			$data['paginacion'] = "";
			$data['temas_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

		} else { //En caso de si haber temas
			$data['paginacion'] = $paginacion;
			$data['temas_html'] = $temas_html;
		}

		// si hay temas envía los mismos, los botones de paginación y el breadcrumb a la vista
		$data['breadcrumb'] = $breadcrumb;


		$this->load->view('test');
		// $this->loadTemplate('temas', 'Temas', $data);

	}
	// ------------------------------------------------------------------------


	public function almacenar()
	{	
		$datos = array(
			'tem_nombre' => $this->input->post('tem_nombre'), 
			'tem_descripcion' => $this->input->post('tem_descripcion') 
		);


		$this->model->almacenar_mdl($datos);
	}

	// ------------------------------------------------------------------------

	 public function actualizar()
	 {

		$id = $this->input->post('id');

		$datos = array(
			'tem_nombre' => $this->input->post('tem_nombre'), 
			'tem_descripcion' => $this->input->post('tem_descripcion')
		);

      $this->model->actualizar_mdl($id, $datos);
    }

    // ------------------------------------------------------------------------

    public function eliminar($id)
    {
    	$this->model->eliminar_mdl($id);
    }

    // ------------------------------------------------------------------------

    public function datos_tema()
    {
      $this->output->set_content_type('application/json');

			$id = $this->input->post('id');
			$datos_tema = $this->model->obtener_datos($id);
			
			/*salida json*/
      $this->output->set_output(json_encode($datos_tema));

    }

    // ------------------------------------------------------------------------
    // ------------------------------------------------------------------------

    public function emails($tem_id)
    {
    	// model para la tabla emails de temas
	    $this->load->model('admin/emails_temas_model', 'emails');


    	$page_input = $this->input->get('page');

    	$page = $this->uri->segment(5);

			// si la pagina viene por get, la toma, sino por el segmento de la uri
			if (isset($page_input)) {
				$pagina = $page_input;
			} else {
				$pagina = $page;			
			}

			// si no se indica, entonces la página es la primera
			$pagina = ($pagina == "") ? 1 : $pagina;


			$limite = self::$emails_por_pagina; //número de emails por página
			$offset = ($pagina*$limite)-$limite;

			
			// si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los emails
			$buscar = $this->input->get('buscar');
			$estado = $this->input->get('estado');

			/*busqueda normal y busqueda por estado*/
			if (isset($buscar) && strlen($buscar) > 3 && !isset($estado)) {
				$emails = $this->emails->buscar_emails_pag($buscar, $limite, $offset, $tem_id);
				$numero_emails = $this->emails->total_busqueda_emails($buscar, $tem_id);
				$url = base_url().'admin/temas/emails/'.$tem_id.'?buscar='.$buscar.'&page='; // url para paginación
			} elseif (isset($buscar) && strlen($buscar) > 3 && isset($estado)) {
				$emails = $this->emails->buscar_emails_pag($buscar, $limite, $offset, $tem_id, $estado);
				$numero_emails = $this->emails->total_busqueda_emails($buscar, $tem_id, $estado);
				$url = base_url().'admin/temas/emails/'.$tem_id.'?buscar='.$buscar.'&estado='.$estado.'&page='; // url 
			}	elseif ((!isset($buscar) || strlen($buscar) <= 3) && isset($estado)) {

				$emails = $this->emails->buscar_emails_pag($buscar, $limite, $offset, $tem_id, $estado);
				$numero_emails = $this->emails->total_busqueda_emails($buscar, $tem_id, $estado);
				$url = base_url().'admin/temas/emails/'.$tem_id.'?estado='.$estado.'&page='; // url 
			}

			else {
				$emails = $this->emails->emails_pagina($limite, $offset, $tem_id);
				$numero_emails = $this->emails->numero_emails($tem_id);
				$url = base_url().'admin/temas/emails/'.$tem_id.'/'; // url para paginación
			}

			// traduce la e y la p a enviado y pendiente
			$emails_html = '';

			foreach ($emails as $email) {
				switch ($email['eml_estado']) {
					case 'e':
						$email['eml_estado'] = 'enviado';
						break;
					case 'p':
						$email['eml_estado'] = 'pendiente';
						break;								
				}

			// todos los emails envía a un template 
				$emails_html .= $this->parser->parse('temas/emails_tpl', $email, TRUE);
			}
				

			// crea los botones de paginacion
			$paginacion = paginador_bootstrap($url, $numero_emails, $limite, $pagina);

			//breadcrumb
			$breadcrumb = breadcrumb_bootstrap('admin', self::$seccion, 'emails');

			// combo box de servidores para los formularios
			$this->load->model('admin/servidores_model', 'servidores');
			$data['combo_servidores'] = $this->servidores->combo_servidores();
		
			// si no hay emails
			if ($numero_emails == 0) {
				$data['paginacion'] = "";
				$data['emails_html'] = "<tr><td colspan='6'>No Hay Emails</tr></td>";

			} else { //En caso de si haber emails
				$data['paginacion'] = $paginacion;
				$data['emails_html'] = $emails_html;
			}

			$data['tem_id'] = $tem_id;

			// si hay emails envía los mismos, los botones de paginación y el breadcrumb a la vista
			$data['breadcrumb'] = $breadcrumb;
			$this->loadTemplate('temas/emails', 'Emails de Temas', $data);
    }


}