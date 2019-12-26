<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suscriptores_bajas extends MY_Controller {

	private static $suscriptores_por_pagina = 5; //número de bajas de suscriptores por página
  private static $seccion = 'suscriptores_bajas';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
		$this->load->model('suscriptores_model', 'suscriptores');

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


    $limite = self::$suscriptores_por_pagina; //número de suscriptores por página
    $offset = ($pagina*$limite)-$limite;

        
    // si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los suscriptores
    $buscar = $this->input->get('buscar');

    if (isset($buscar) && strlen($buscar) > 3) {
      $suscriptores = $this->model->buscar_suscriptores_pag($buscar, $limite, $offset);
      $numero_suscriptores = $this->model->total_busqueda_suscriptores($buscar);
      $url = base_url().'admin/suscriptores_bajas/index'.'?buscar='.$buscar.'&page='; // url para   paginación
    } else {
      $suscriptores = $this->model->suscriptores_pagina($limite, $offset);
      $numero_suscriptores = $this->model->numero_suscriptores();
      $url = base_url().'admin/suscriptores_bajas/index/'; // url para paginación
    }


    // todos los suscriptores manda a un template 
    $suscriptores_html = '';

    foreach ($suscriptores as $suscriptor) {
      $suscriptores_html .= $this->parser->parse('suscriptores_bajas/suscriptores_bajas_tpl', $suscriptor, TRUE);
    }



    // crea los botones de paginacion
    $paginacion = paginador_bootstrap($url, $numero_suscriptores, $limite, $pagina);

    //breadcrumb

    $breadcrumb = breadcrumb_bootstrap('admin', 'bajas de suscriptores');
    
    // si no hay suscriptores
    if ($numero_suscriptores == 0) {
      $data['paginacion'] = "";
      $data['suscriptores_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

    } else { //En caso de si haber suscriptores
      $data['paginacion'] = $paginacion;
      $data['suscriptores_html'] = $suscriptores_html;
    }

    // si hay suscriptores envía los mismos, los botones de paginación y el breadcrumb a la vista
    $data['breadcrumb'] = $breadcrumb;
    $this->loadTemplate('suscriptores_bajas', 'Bajas de Suscriptores', $data);

  }

	// ------------------------------------------------------------------------

  // REVISAR???
	public function almacenar()
	{
		$id = $this->input->post('sus_id');

		$datos_suscriptor = $this->suscriptores->datos_suscriptor($id);

		$datos = array(
			'sus_nombres' => $datos_suscriptor['sus_nombres'],
			'sus_apellidos' => $datos_suscriptor['sus_apellidos'],
			'sus_email' => $datos_suscriptor['sus_email'],
			'sus_celular' => $datos_suscriptor['sus_celular'],
			'sus_fecha' => $datos_suscriptor['sus_fecha'],
			'sus_fecha_baja' => $this->input->post('sus_fecha_baja'),
			'sus_razon_baja' => $this->input->post('sus_razon_baja')
		);

		$this->suscriptores->eliminar_mdl($id);
		$this->model->almacenar_mdl($datos);
	}

	// ------------------------------------------------------------------------


	public function actualizar() {

		$id = $this->input->post('id');

		$datos = array(
			'sus_nombres' => $this->input->post('sus_nombres'),
			'sus_apellidos' => $this->input->post('sus_apellidos'),
			'sus_email' => $this->input->post('sus_email'),
			'sus_celular' => $this->input->post('sus_celular'),
			'sus_razon_baja' => $this->input->post('sus_razon_baja')
		);

	  $this->model->actualizar_mdl($id, $datos);
  }

    // ------------------------------------------------------------------------


}

