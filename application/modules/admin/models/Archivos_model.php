<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivos_model extends CI_Model {

	// tabla a usar de la base de datos
    private static $tabla = 'admin_archivos';
    private static $seccion = 'archivos';
    private static $campo_principal = 'arc_nombre';


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin/administracion');

	}

	// ------------------------------------------------------------------------

	public function index() {


		// datos para paginación y búsqueda
        $desde = $this->input->post('desde');
        $w_buscar = $this->input->post('w_buscar');

        // utilizo funcion para generar indice del helper administracion
        $arreglo = generar_indice(
        	self::$tabla, 
        	$desde, $w_buscar, 
        	self::$seccion, 
        	self::$campo_principal
        );

        return $arreglo;
        ;
    }

    // ------------------------------------------------------------------------

    public function almacenar_mdl($datos) {

        $this->db->insert(self::$tabla, $datos);
    }

    // ------------------------------------------------------------------------

    public function obtener_datos($id) {
        $this->db->where("id", $id);
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else
            return "Sin datos ($id)";
    }

    // ------------------------------------------------------------------------

    public function actualizar_mdl($id, $datos) {
        
        $this->db->where('id', $id);
        $this->db->update(self::$tabla, $datos);
    }

    // ------------------------------------------------------------------------

    public function eliminar_mdl($id) {
        $this->db->where('id', $id);
        $this->db->delete(self::$tabla);
        return true;
    }

    // ------------------------------------------------------------------------

    /*combo box usado en modificar*/
    public function combo_deque($id='')
    {
    	$selected_e = '';
    	$selected_m = '';

        $query = $this->db->get_where(self::$tabla, ['id' => $id]);

        $fila = $query->row_array();

    	switch ($fila['arc_deque']) {
    		case 'e':
    			$selected_e = "selected";
    			break;
    		case 'm':
    			$selected_m = "selected";
    			break;

    	}

	    $html = "
			<select id='arc_deque' name='arc_deque'>
				<option value=''>Seleccione</option>
				<option value='e' $selected_e>Email</option>
				<option value='m' $selected_m>Mensaje</option>
			</select>
		";

        return $html;
	}

	// ------------------------------------------------------------------------

    /*operaciones con archivos*/
	public function almacenar_archivo($campo)
	{
    	$archivo = $_FILES[$campo];
		$archivo_nombre = $_FILES[$campo]['name'];
		$archivo_tmp_name = $_FILES[$campo]['tmp_name'];
		$archivo_tamano = $_FILES[$campo]['size'];
		$archivo_error = $_FILES[$campo]['error'];

		$archivo_explode = explode('.', $archivo_nombre);
		$extension = strtolower(end($archivo_explode));

		$archivo_servidor = uniqid('', TRUE) . '.' . $extension;

		$archivo_destino = 'files/'.$archivo_servidor;

		$archivos_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf', 'ppt', 'pptx');

		if (in_array($extension, $archivos_permitidos) && $archivo_tamano < 10000000 && !$archivo_error) {
			move_uploaded_file($archivo_tmp_name, $archivo_destino);
			chmod($archivo_destino, 0775);
		}

		return $archivo_servidor;
    }

    // ------------------------------------------------------------------------

    public function eliminar_archivo($id)
    {
    	$datos_archivo = $this->obtener_datos($id);
    	$nombre_archivo_antiguo = $datos_archivo['arc_nombre'];
    	// echo $nombre_archivo_antiguo;
    	// die;

    	unlink('files/'.$nombre_archivo_antiguo);

    }

    // ------------------------------------------------------------------------

    public function actualizar_archivo($id, $campo)
    {
    	$this->eliminar_archivo($id);

    	$nombre_archivo_actual = $this->almacenar_archivo($campo);

    	return $nombre_archivo_actual;
    }


}
