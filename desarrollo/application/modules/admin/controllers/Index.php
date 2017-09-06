<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MY_Controller {
    public function __construct() {
        parent::__construct();
        //conectado();
    }
    public function index() {
        $this->loadTemplate("administracion/index");
    }
    
}
