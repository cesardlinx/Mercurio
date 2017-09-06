<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('archivos_model', 'model');
	}

	public function index($id)
	{
		$this->model->datos_archivos($id);
	}

}

