<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portada extends MY_Controller {

	private static $eve_por_pagina = 2; //número de eventos por página

  public function __construct() {
    parent::__construct();
    // cargo el modelo de la tabla eventos en el modulo admin
    $this->load->model('admin/eventos_model', 'eventos');
  }

  // ------------------------------------------------------------------------

	public function index()
	{

		$page = $this->input->get('page');

		// si la pagina viene por get, la tomo, sino por el segmento de la uri
		if (isset($page)) {
			$pagina = $page;
		} else {
			$pagina = $this->uri->segment(1);			
		}

		// si no se indica, entonces la página es la primera
		$pagina = ($pagina == "") ? 1 : $pagina;


		$limite = self::$eve_por_pagina; //número de eventos por página
		$offset = ($pagina*$limite)-$limite;

		
		// si hay una busqueda realizo la query correspondiente, sino (else)tomo todos los eventos
		$buscar = $this->input->get('buscar');

		if (isset($buscar) && strlen($buscar) > 3) {
			$eventos = $this->eventos->buscar_eventos_pag($buscar, $limite, $offset);
			$numero_eventos = $this->eventos->total_busqueda_eventos($buscar);
			$url = base_url().'?buscar='.$buscar.'&page='; // url para paginación
		} else {
			$eventos = $this->eventos->eventos_pagina($limite, $offset);
			$numero_eventos = $this->eventos->numero_eventos();
			$url = base_url(); // url para paginación
		}


		// todos los eventos mando a un template 
		$eventos_html = '';

		foreach ($eventos as $evento) {
			$eventos_html .= $this->parser->parse('templates/evento_tpl', $evento, TRUE);
		}


		// si no hay eventos
		if ($numero_eventos == 0) {
			$data['eventos_html'] = "No hay eventos";
			$data['paginacion'] = "";
			$this->load->view('portada', $data);
			die;
		}

		// creo los botones de paginacion
		$paginacion = paginador_bootstrap($url, $numero_eventos, $limite, $pagina);
	
		// envío los eventos y los botones de paginación a la vista
		$data['eventos_html'] = $eventos_html;
		$data['paginacion'] = $paginacion;
		$this->load->view('portada', $data);

	}
}

