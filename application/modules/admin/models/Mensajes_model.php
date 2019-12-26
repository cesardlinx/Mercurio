<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes_model extends CI_Model {

	// tabla a usar de la base de datos
    private static $tabla = 'mensajes';
    private static $seccion = 'mensajes';
    private static $campo_principal = 'msj_titulo';


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

    /*combo boxes usados en modificar*/
    public function combo_estado($id='')
    {
        $selected_p = '';
        $selected_a = '';

        $query = $this->db->get_where(self::$tabla, ['id' => $id]);

        $fila = $query->row_array();

        switch ($fila['msj_estado']) {
            case 'p':
                $selected_p = "selected";
                break;
            case 'a':
                $selected_a = "selected";
                break;
        }

        $html = "
            <select id='msj_estado' name='msj_estado'>
                <option value=''>Seleccione</option>
                <option value='p' $selected_p>Pendiente</option>
                <option value='a' $selected_a>Aprobado</option>
            </select>
        ";

        return $html;
    }


}

