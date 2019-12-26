<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidores extends MY_Controller {

	private static $servidores_por_pagina = 5; //número de servidores por página
	private static $seccion = 'servidores';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
	}

	// ------------------------------------------------------------------------
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


    $limite = self::$servidores_por_pagina; //número de servidores por página
    $offset = ($pagina*$limite)-$limite;

        
    // si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los servidores
    $buscar = $this->input->get('buscar');

    if (isset($buscar) && strlen($buscar) > 3) {
      $servidores = $this->model->buscar_servidores_pag($buscar, $limite, $offset);
      $numero_servidores = $this->model->total_busqueda_servidores($buscar);
      $url = base_url().'admin/servidores/index'.'?buscar='.$buscar.'&page='; // url para   paginación
    } else {
      $servidores = $this->model->servidores_pagina($limite, $offset);
      $numero_servidores = $this->model->numero_servidores();
      $url = base_url().'admin/servidores/index/'; // url para paginación
    }


    // todos los servidores manda a un template 
    $servidores_html = '';

    foreach ($servidores as $servidor) {
    	if ($servidor['con_smtp_auth']) {
    		$servidor['con_smtp_auth'] = 'Si';
    	} else {
    		$servidor['con_smtp_auth'] = 'No';
    	}
      $servidores_html .= $this->parser->parse('servidores/servidores_tpl', $servidor, TRUE);
    }



    // crea los botones de paginacion
    $paginacion = paginador_bootstrap($url, $numero_servidores, $limite, $pagina);

    //breadcrumb

    $breadcrumb = breadcrumb_bootstrap('admin', self::$seccion);
    
    // si no hay servidores
    if ($numero_servidores == 0) {
      $data['paginacion'] = "";
      $data['servidores_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

    } else { //En caso de si haber servidores
      $data['paginacion'] = $paginacion;
      $data['servidores_html'] = $servidores_html;
    }

    // si hay servidores envía los mismos, los botones de paginación y el breadcrumb a la vista
    $data['breadcrumb'] = $breadcrumb;
    $this->loadTemplate('servidores', 'Servidores', $data);

  }

	// ------------------------------------------------------------------------

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
	}

	// ------------------------------------------------------------------------


	 public function actualizar()
	 {

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
  }

    // ------------------------------------------------------------------------

    public function eliminar($id)
    {
    	$this->model->eliminar_mdl($id);
    }

}

