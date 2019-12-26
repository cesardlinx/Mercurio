<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

  public function __construct() {
    parent::__construct();
  }


  public function loadTemplate($view, $titulo, $data = array(), $menu='on')
  {
    if (isset($_SESSION['conectado'])) {
          
      $nombres = $_SESSION['log_usu_nombres'];
      $nombres_exp = explode(' ', $nombres);
      $log_nombre = $nombres_exp[0];
      
      $datos_cabecera['titulo'] = $titulo;
      $datos_cabecera['log_nombre'] = $log_nombre;
      
      $this->load->view("general/cabecera", $datos_cabecera);
      if ($menu=='on') {
        $this->load->view("general/menu");           
      }
      $this->load->view($view, $data);
          
    } else {
      redirect(base_url(),'refresh');
    } 
       
  }



}
