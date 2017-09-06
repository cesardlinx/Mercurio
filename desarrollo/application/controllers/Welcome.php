<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('welcome_model', 'welcome');
    }

	public function index(){
		$html = $this->welcome->portada();
		$this->load->view('welcome_message',$html);
	}
}
