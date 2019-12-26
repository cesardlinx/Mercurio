<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Usuarios extends MY_Controller {


  private static $usuarios_por_pagina = 5; //número de usuarios por página
  private static $seccion = 'usuarios';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin/usuarios_model', 'model');
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


    $limite = self::$usuarios_por_pagina; //número de usuarios por página
    $offset = ($pagina*$limite)-$limite;

        
    // si hay una busqueda realiza la query correspondiente, sino (else)tomo todos los usuarios
    $buscar = $this->input->get('buscar');

    if (isset($buscar) && strlen($buscar) > 3) {
      $usuarios = $this->model->buscar_usuarios_pag($buscar, $limite, $offset);
      $numero_usuarios = $this->model->total_busqueda_usuarios($buscar);
      $url = base_url().'admin/usuarios/index'.'?buscar='.$buscar.'&page='; // url para   paginación
    } else {
      $usuarios = $this->model->usuarios_pagina($limite, $offset);
      $numero_usuarios = $this->model->numero_usuarios();
      $url = base_url().'admin/usuarios/index/'; // url para paginación
    }


    // todos los usuarios manda a un template 
    $usuarios_html = '';

    foreach ($usuarios as $usuario) {
      switch ($usuario['usu_activo']) {
        case 's':
          $usuario['usu_activo'] = 'si';
          break;
        case 'n':
          $usuario['usu_activo'] = 'no';
          break;                
      }
      $usuarios_html .= $this->parser->parse('usuarios/usuarios_tpl', $usuario, TRUE);
    }



    // crea los botones de paginacion
    $paginacion = paginador_bootstrap($url, $numero_usuarios, $limite, $pagina);

    //breadcrumb

    $breadcrumb = breadcrumb_bootstrap('admin', self::$seccion);
    
    // si no hay usuarios
    if ($numero_usuarios == 0) {
      $data['paginacion'] = "";
      $data['usuarios_html'] = "<tr><td colspan='5'>No Hay Emails</tr></td>";

    } else { //En caso de si haber usuarios
      $data['paginacion'] = $paginacion;
      $data['usuarios_html'] = $usuarios_html;
    }

    // si hay usuarios envía los mismos, los botones de paginación y el breadcrumb a la vista
    $data['breadcrumb'] = $breadcrumb;
    $this->loadTemplate('usuarios', 'Usuarios', $data);

  }
    // ------------------------------------------------------------------------


  public function almacenar()
  {      

    $anos_validez = strtotime("+3 Years");
    $fecha_contrasena = date("Y-m-d", $anos_validez);

    /*recolectando los datos del usuario*/
    $datos_usuario = array(
      'usu_nombres' => $this->input->post('nombres'),
      'usu_apellidos' => $this->input->post('apellidos'),
      'usu_contrasena' => hash('sha256', $this->input->post('contrasena') . SALT),
      'usu_email' => $this->input->post('email'),
      'usu_hojavida' => $this->input->post('hojavida'),
      'usu_ingreso' => hoy('c'),
      'usu_adm' => 'n',
      'usu_activo' => 's',
      'usu_fecha_contrasena' => $fecha_contrasena
    );

    /*almacenamiento de datos*/
    $this->conexion->almacenar_mdl($datos_usuario);
  }

    // ------------------------------------------------------------------------

  public function actualizar()
  {
    /*OJO MODIFICAR*/
    $id = $this->input->post('id');

    $password = $this->input->post('usu_contrasena');
        if ($password != "") {
          $arreglo = array(
            "usu_nombres" => $this->input->post('usu_nombres'),
            "usu_apellidos" => $this->input->post('usu_apellidos'),
            "usu_hojavida" => $this->input->post('usu_hojavida'),
            "usu_email" => $this->input->post('usu_email'),
            "usu_contrasena" => hash('sha256', $this->input->post('usu_contrasena').SALT),
            "usu_adm" => $this->input->post('usu_adm'),
            "usu_activo" => $usu_activo,
          );
        } else {
          $arreglo = array(
            "usu_nombres" => $this->input->post('usu_nombres'),
            "usu_apellidos" => $this->input->post('usu_apellidos'),
            "usu_email" => $this->input->post('usu_email'),
            "usu_adm" => $this->input->post('usu_adm'),
            "usu_activo" => $usu_activo,
          );
        }

    $this->model->actualizar_mdl($id, $datos);
  }

    // ------------------------------------------------------------------------

  public function eliminar($id)
  {
    $this->model->eliminar_mdl($id);
  }

    // ------------------------------------------------------------------------

  public function datos_usuario()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    $datos_usuario = $this->model->obtener_datos($id);
          
    /*salida json*/
    $this->output->set_output(json_encode($datos_usuario));

  }



}
