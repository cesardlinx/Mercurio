<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temas_model extends CI_Model {

	// tabla a usar de la base de datos
    private static $tabla = 'temas';


	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('admin/administracion');

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

    /*combo box de fechas que pertenecen a un tema*/
    public function combo_temas($id = '') {
        $html = "<select id='tem_id' name='tem_id'><option value=''>Seleccione</option>";
        $this->db->order_by("tem_nombre");
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $id_d = $fila->id;
                $tem_nombre = $fila->tem_nombre;
                if ($id_d == $id)
                    $selected = "selected";
                else
                    $selected = "";
                $html.="<option value='$id_d' $selected>$tem_nombre</option>";
            }
            return $html . "</select>";
        } else
            return "No hay temas ingresados";

        return $html;
    }

    // ------------------------------------------------------------------------

    /*temas por página para la paginación*/
    public function temas_pagina($limit, $offset)
    {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get(self::$tabla);

        return $query->result_array();
        
    }

    /*numero total de temas*/
    public function numero_temas()
    {
        $query = $this->db->get(self::$tabla);
        return $query->num_rows();
    }

    /*total de la busqueda de temas*/
    public function total_busqueda_temas ($busqueda)
    {

        $this->db->like('tem_nombre', $busqueda);
        $this->db->or_like('tem_descripcion', $busqueda);
        $query = $this->db->get(self::$tabla);

        return $query->num_rows();
        
    }

    /*busqueda de temas por página*/
    public function buscar_temas_pag($busqueda, $limit, $offset)
    {
        $this->db->order_by('id', 'asc');        
        $this->db->limit($limit, $offset);
        $this->db->like('tem_nombre', $busqueda);
        $this->db->or_like('tem_descripcion', $busqueda);
        $query = $this->db->get(self::$tabla);

        return $query->result_array();
        
    }

}

