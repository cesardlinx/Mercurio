<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locaciones extends MY_Controller {

  private static $locaciones_por_pagina = 5; //número de locaciones por página	
  private static $seccion = 'locaciones';


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


    $limite = self::$locaciones_por_pagina; //número de locaciones por página
    $offset = ($pagina*$limite)-$limite;

        
    // si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los locaciones
    $buscar = $this->input->get('buscar');

    if (isset($buscar) && strlen($buscar) > 3) {
      $locaciones = $this->model->buscar_locaciones_pag($buscar, $limite, $offset);
      $numero_locaciones = $this->model->total_busqueda_locaciones($buscar);
      $url = base_url().'admin/locaciones/index'.'?buscar='.$buscar.'&page='; // url para   paginación
    } else {
      $locaciones = $this->model->locaciones_pagina($limite, $offset);
      $numero_locaciones = $this->model->numero_locaciones();
      $url = base_url().'admin/locaciones/index/'; // url para paginación
    }


    // todos los locaciones manda a un template 
    $locaciones_html = '';

    foreach ($locaciones as $locacion) {
        $locaciones_html .= $this->parser->parse('locaciones/locaciones_tpl', $locacion, TRUE);
    }



    // crea los botones de paginacion
    $paginacion = paginador_bootstrap($url, $numero_locaciones, $limite, $pagina);

    //breadcrumb

    $breadcrumb = breadcrumb_bootstrap('admin', self::$seccion);
    
    // si no hay locaciones
    if ($numero_locaciones == 0) {
      $data['paginacion'] = "";
      $data['locaciones_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

    } else { //En caso de si haber locaciones
      $data['paginacion'] = $paginacion;
      $data['locaciones_html'] = $locaciones_html;
    }

    // si hay locaciones envía los mismos, los botones de paginación y el breadcrumb a la vista
    $data['breadcrumb'] = $breadcrumb;
    $this->loadTemplate('locaciones', 'Locaciones', $data);

  }

	// ------------------------------------------------------------------------


	public function almacenar()
	{	
		$datos = array(
			'loc_nombre' => $this->input->post('loc_nombre'), 
			'loc_direccion' => $this->input->post('loc_direccion'), 
			'loc_telefonos' => $this->input->post('loc_telefonos'), 
			'loc_coordenadas' => $this->input->post('loc_coordenadas'), 
		);


		$this->model->almacenar_mdl($datos);
	}

	// ------------------------------------------------------------------------


	 public function actualizar() {

		$id = $this->input->post('id');

    $datos = array(
      'loc_nombre' => $this->input->post('loc_nombre'), 
      'loc_direccion' => $this->input->post('loc_direccion'), 
      'loc_telefonos' => $this->input->post('loc_telefonos'), 
      'loc_coordenadas' => $this->input->post('loc_coordenadas'), 
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

