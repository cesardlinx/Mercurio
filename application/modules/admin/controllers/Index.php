<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
		  $data['breadcrumb'] = breadcrumb_bootstrap('admin');
      $this->loadTemplate('administracion/index', 'Administración', $data, 'off');
    }
    
}
