<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sus_eventos_model extends CI_Model {

	// tabla a usar de la base de datos
    private static $tabla = 'rel_sus_eventos';


	public function __construct()
	{
		parent::__construct();
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


}

