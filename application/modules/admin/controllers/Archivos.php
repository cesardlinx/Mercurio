<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivos extends MY_Controller {

    private static $seccion = 'archivos';


	public function __construct()
	{
		parent::__construct();
		// modelo a usar
		$this->load->model(self::$seccion.'_model', 'model');
        $this->load->model('usuarios_model');

	}

	/*indice de archivos*/
	public function index()
	{
		$data = $this->model->index();
		$data['seccion'] = self::$seccion;
		$this->loadTemplate('indices/indice', $data);
	}

	// ------------------------------------------------------------------------

	public function crear()
	{
		$data['arc_combo'] = $this->model->combo_deque();
		$data["cmb_usuarios"] = $this->usuarios_model->combo_usuarios_mdl('','', 'usu_id');
		$this->loadTemplate(self::$seccion.'/crear', $data);
	}


	public function almacenar()
	{	
		// retorna el nombre del archivo
		$archivo_nombre = $this->model->almacenar_archivo('archivo');
		
		$datos = array(
			'usu_id' => $this->input->post('usu_id'), 
			'arc_nombre' => $archivo_nombre, 
			'arc_fecha' => $this->input->post('arc_fecha'), 
			'arc_deque' => $this->input->post('arc_deque')
		);


		$this->model->almacenar_mdl($datos);
		redirect('admin/'.self::$seccion,'refresh');
	}

	// ------------------------------------------------------------------------

	public function modificar($id)
	{
		$datos_archivo = $this->model->obtener_datos($id);
		$usu_id = $datos_archivo['usu_id'];

		$data['arc_combo'] = $this->model->combo_deque($id);
		$data["cmb_usuarios"] = $this->usuarios_model->combo_usuarios_mdl($usu_id,'', 'usu_id');
		$data['id'] = $id;

		$this->loadTemplate(self::$seccion.'/modificar', $data);
	}


	 public function actualizar() {

		$id = $this->input->post('id');

		$datos = array(
			'usu_id' => $this->input->post('usu_id'), 			
			'arc_fecha' => $this->input->post('arc_fecha'), 
			'arc_deque' => $this->input->post('arc_deque')
		);

		// actualizar archivo solo si el usuario ha subido uno nuevo
		if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
			$archivo_nombre = $this->model->actualizar_archivo($id, 'archivo');
			$datos['arc_nombre'] = $archivo_nombre;
		}


        $this->model->actualizar_mdl($id, $datos);
        redirect('admin/'.self::$seccion, 'refresh');
    }

    // ------------------------------------------------------------------------

    public function eliminar($id)
    {
    	$this->model->eliminar_archivo($id);
    	$this->model->eliminar_mdl($id);
    	redirect('admin/'.self::$seccion,'refresh');

    }

}

