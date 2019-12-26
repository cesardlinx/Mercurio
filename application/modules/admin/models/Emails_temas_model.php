<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_temas_model extends CI_Model {

	// tabla a usar de la base de datos
    private static $tabla = 'emails_temas';
    private static $campo_principal = 'eml_asunto';


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

    // ------------------------------------------------------------------------

    public function combo_estado($id='')
    {
        $selected_e = '';
        $selected_p = '';

        $query = $this->db->get_where(self::$tabla, ['id' => $id]);

        $fila = $query->row_array();

        switch ($fila['eml_estado']) {
            case 'e':
                $selected_e = "selected";
                break;
            case 'p':
                $selected_p = "selected";
                break;
        }

        $html = "
            <select id='eml_estado' name='eml_estado'>
                <option value=''>Seleccione</option>
                <option value='e' $selected_e>Enviado</option>
                <option value='p' $selected_p>Pendiente</option>
            </select>
        ";

        return $html;
    }

    // ------------------------------------------------------------------------

    /*emails por página para la paginación*/
    public function emails_pagina($limit, $offset, $tem_id='')
    {
        $this->db->order_by('id', 'asc');

        $this->db->limit($limit, $offset);

        if ($tem_id) {
            $this->db->where('tem_id', $tem_id);            
        }
                
        $query = $this->db->get(self::$tabla);

        return $query->result_array();
        
    }

    /*numero total de emails*/
    public function numero_emails($tem_id='')
    {
        if ($tem_id) {
            $this->db->where('tem_id', $tem_id);            
        }

        $query = $this->db->get(self::$tabla);
        return $query->num_rows();
    }

    /*busqueda de emails*/
    public function total_busqueda_emails ($busqueda, $tem_id, $eml_estado='')
    {

        if ($eml_estado) {
            $query = $this->db->query("SELECT * FROM `emails_temas` WHERE (`eml_estado` = '$eml_estado' AND `tem_id` = '$tem_id') AND (`eml_asunto` LIKE '%$busqueda%' OR `eml_contenido` LIKE '%$busqueda%')");

        } else {
            $query = $this->db->query("SELECT * FROM `emails_temas` WHERE (`tem_id` = '$tem_id') AND (`eml_asunto` LIKE '%$busqueda%' OR `eml_contenido` LIKE '%$busqueda%')");

        }


        return $query->num_rows();
        
    }

    /*busqueda de emails*/
    public function buscar_emails_pag($busqueda, $limit, $offset, $tem_id, $eml_estado='')
    {

        if ($eml_estado) {
            $query = $this->db->query("SELECT * FROM `emails_temas` WHERE (`eml_estado` = '$eml_estado' AND `tem_id` = '$tem_id') AND (`eml_asunto` LIKE '%$busqueda%' OR `eml_contenido` LIKE '%$busqueda%') ORDER BY `ID` ASC LIMIT $offset,$limit");
        } else {
            $query = $this->db->query("SELECT * FROM `emails_temas` WHERE (`tem_id` = '$tem_id') AND (`eml_asunto` LIKE '%$busqueda%' OR `eml_contenido` LIKE '%$busqueda%') ORDER BY `ID` ASC LIMIT $offset,$limit");

        }

        return $query->result_array();
        
    }


}

