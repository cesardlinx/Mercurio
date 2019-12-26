<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fechas_model extends CI_Model {

	// tabla a usar de la base de datos
  private static $tabla = 'eve_fechas';
  private static $seccion = 'fechas';


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

  /*combo box de fechas que pertenecen a un evento(eve_id)*/
  public function combo_fechas($eve_id, $id='')
  {
    $html = "<select id='eve_fecha_programada' name='eve_fecha_programada'><option value=''>Seleccione</option>";
    $this->db->order_by('id');
    $query = $this->db->get_where('eve_fechas', ['eve_id' => $eve_id]);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $fila) {
        $id_d = $fila->id;
        $hora = $fila->eve_inicia;
        $fecha = $fila->eve_fecha;
        $marca_tiempo = strtotime($fecha.' '.$hora);
        $fecha_completa = date('Y/m/d H:ia', $marca_tiempo);
        if ($id_d == $id)
          $selected = "selected";
        else
          $selected = "";
        $html.="<option value='$id_d' $selected>".$fecha_completa."</option>";
                
      }
      return $html . "</select>";
    } else
      return "No hay fechas ingresadas";
    return $html;
  }

  // ------------------------------------------------------------------------

  /*fechas por página para la paginación*/
  public function fechas_pagina($limit, $offset)
  {
    $this->db->order_by('id', 'asc');
    $this->db->limit($limit, $offset);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
      
  }

  /*numero total de fechas*/
  public function numero_fechas()
  {
    $query = $this->db->get(self::$tabla);
    return $query->num_rows();
  }

  /*total de la busqueda de fechas*/
  public function total_busqueda_fechas ($busqueda)
  {

    $this->db->like('eve_fecha', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->num_rows();
      
  }

  /*busqueda de fechas por página*/
  public function buscar_fechas_pag($busqueda, $limit, $offset)
  {
    $this->db->order_by('id', 'asc');        
    $this->db->limit($limit, $offset);
    $this->db->like('eve_fecha', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
    
  }


}

