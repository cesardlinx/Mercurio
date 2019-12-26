<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fechas extends MY_Controller {

  private static $fechas_por_pagina = 5; //número de fechas por página	
  private static $seccion = 'fechas';


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


    $limite = self::$fechas_por_pagina; //número de fechas por página
    $offset = ($pagina*$limite)-$limite;

        
    // si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los fechas
    $buscar = $this->input->get('buscar');

    if (isset($buscar) && strlen($buscar) > 3) {
      $fechas = $this->model->buscar_fechas_pag($buscar, $limite, $offset);
      $numero_fechas = $this->model->total_busqueda_fechas($buscar);
      $url = base_url().'admin/fechas/index'.'?buscar='.$buscar.'&page='; // url para   paginación
    } else {
      $fechas = $this->model->fechas_pagina($limite, $offset);
      $numero_fechas = $this->model->numero_fechas();
      $url = base_url().'admin/fechas/index/'; // url para paginación
    }


    // todos los fechas manda a un template 
    $fechas_html = '';

    foreach ($fechas as $fechas) {
        $fechas_html .= $this->parser->parse('fechas/fechas_tpl', $fechas, TRUE);
    }



    // crea los botones de paginacion
    $paginacion = paginador_bootstrap($url, $numero_fechas, $limite, $pagina);

    //breadcrumb

    $breadcrumb = breadcrumb_bootstrap('admin', self::$seccion);
    
    // si no hay fechas
    if ($numero_fechas == 0) {
      $data['paginacion'] = "";
      $data['fechas_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

    } else { //En caso de si haber fechas
      $data['paginacion'] = $paginacion;
      $data['fechas_html'] = $fechas_html;
    }

    // si hay fechas envía los mismos, los botones de paginación y el breadcrumb a la vista
    $data['breadcrumb'] = $breadcrumb;
    $this->loadTemplate('fechas', 'Fechas', $data);

  }

	// ------------------------------------------------------------------------


	public function almacenar()
	{	
		$datos = array(
			'eve_id' => $this->input->post('eve_id'), 
			'eve_fecha' => $this->input->post('eve_fecha'), 
			'eve_inicia' => $this->input->post('eve_inicia'), 
			'eve_termina' => $this->input->post('eve_termina'), 
		);


		$this->model->almacenar_mdl($datos);
	}

	// ------------------------------------------------------------------------


	 public function actualizar() {

		$id = $this->input->post('id');

		$datos = array(
			'eve_id' => $this->input->post('eve_id'), 
			'eve_fecha' => $this->input->post('eve_fecha'), 
			'eve_inicia' => $this->input->post('eve_inicia'), 
			'eve_termina' => $this->input->post('eve_termina'), 
		);

        $this->model->actualizar_mdl($id, $datos);
    }

    // ------------------------------------------------------------------------

    public function eliminar($id)
    {
    	$this->model->eliminar_mdl($id);

    }

    // ------------------------------------------------------------------------
}

