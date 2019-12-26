<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Eventos extends MY_Controller {


  private static $eventos_por_pagina = 5; //número de eventos por página
  private static $suscriptores_por_pagina = 5; //número de eventos por página
  private static $emails_por_pagina = 5; //número de emails por página
  private static $seccion = 'eventos';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin/eventos_model', 'model');
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


    $limite = self::$eventos_por_pagina; //número de eventos por página
    $offset = ($pagina*$limite)-$limite;

        
    // si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los eventos
    $buscar = $this->input->get('buscar');

    if (isset($buscar) && strlen($buscar) > 3) {
      $eventos = $this->model->buscar_eventos_pag($buscar, $limite, $offset);
      $numero_eventos = $this->model->total_busqueda_eventos($buscar);
      $url = base_url().'admin/eventos/index'.'?buscar='.$buscar.'&page='; // url para   paginación
    } else {
      $eventos = $this->model->eventos_pagina($limite, $offset);
      $numero_eventos = $this->model->numero_eventos();
      $url = base_url().'admin/eventos/index/'; // url para paginación
    }


    // todos los eventos manda a un template 
    $eventos_html = '';

    foreach ($eventos as $evento) {
        $eventos_html .= $this->parser->parse('eventos/eventos_tpl', $evento, TRUE);
    }



    // crea los botones de paginacion
    $paginacion = paginador_bootstrap($url, $numero_eventos, $limite, $pagina);

    //breadcrumb

    $breadcrumb = breadcrumb_bootstrap('admin', self::$seccion);
    
    // si no hay eventos
    if ($numero_eventos == 0) {
      $data['paginacion'] = "";
      $data['eventos_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

    } else { //En caso de si haber eventos
      $data['paginacion'] = $paginacion;
      $data['eventos_html'] = $eventos_html;
    }

    // si hay eventos envía los mismos, los botones de paginación y el breadcrumb a la vista
    $data['breadcrumb'] = $breadcrumb;
    $this->loadTemplate('eventos', 'Eventos', $data);

  }
    // ------------------------------------------------------------------------


  public function almacenar()
  {   
    $hoy = hoy('c');
    $arreglo = array(
      "loc_id" => $this->input->post('loc_id'),
      "tem_id" => $this->input->post('tem_id'),
      "eve_activodesde" => $hoy,
      "usu_id_conferencista" => $this->input->post('usu_id_conferencista'),
      "eve_titulo" => $this->input->post('eve_titulo'),
      "eve_subtitulo" => $this->input->post('eve_subtitulo'),
      "eve_descripcion" => $this->input->post('eve_descripcion'),
      "eve_contenido" => $this->input->post('eve_contenido'),
      "eve_objetivos" => $this->input->post('eve_objetivos'),
      "eve_dirigido" => $this->input->post('eve_dirigido'),
      "eve_duracion" => $this->input->post('eve_duracion'),
      "eve_lugar" => $this->input->post('eve_lugar'),
      "eve_fechasHorarios" => $this->input->post('eve_fechasHorarios'),
      "eve_costo" => $this->input->post('eve_costo'),
      "eve_fecha_hora" => $hoy,
      "eve_observaciones" => $this->input->post('eve_observaciones'),
    );


    $this->model->almacenar_mdl($datos);
  }

    // ------------------------------------------------------------------------

  public function actualizar()
  {

    $id = $this->input->post('id');

    $arreglo = array(
      "loc_id" => $this->input->post('loc_id'),
      "tem_id" => $this->input->post('tem_id'),
      "usu_id_conferencista" => $this->input->post('usu_id_conferencista'),
      "eve_titulo" => $this->input->post('eve_titulo'),
      "eve_subtitulo" => $this->input->post('eve_subtitulo'),
      "eve_descripcion" => $this->input->post('eve_descripcion'),
      "eve_contenido" => $this->input->post('eve_contenido'),
      "eve_objetivos" => $this->input->post('eve_objetivos'),
      "eve_dirigido" => $this->input->post('eve_dirigido'),
      "eve_duracion" => $this->input->post('eve_duracion'),
      "eve_lugar" => $this->input->post('eve_lugar'),
      "eve_fechasHorarios" => $this->input->post('eve_fechasHorarios'),
      "eve_costo" => $this->input->post('eve_costo'),
      "eve_observaciones" => $this->input->post('eve_observaciones'),
    );

    $this->model->actualizar_mdl($id, $datos);
  }

    // ------------------------------------------------------------------------

  public function eliminar($id)
  {
    $this->model->eliminar_mdl($id);
  }

    // ------------------------------------------------------------------------

  public function datos_evento()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    $datos_evento = $this->model->obtener_datos($id);
          
          /*salida json*/
    $this->output->set_output(json_encode($datos_evento));

  }

    // ------------------------------------------------------------------------

    
    // $this->load->model('admin/locaciones_model','locaciones');
    // $this->load->model('admin/temas_model', 'temas');
    // $this->load->model('admin/usuarios_model', 'usuarios');
    // $data["cmb_locaciones"] = $this->locaciones->combo_locaciones();
    // $data["cmb_temas"] = $this->temas->combo_temas();
    // $data["cmb_usuarios"] = $this->usuarios->combo_usuarios_mdl('','', 'usu_id_conferencista');
        

}
