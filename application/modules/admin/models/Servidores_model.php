<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidores_model extends CI_Model {

	// tabla a usar de la base de datos
  private static $tabla = 'admin_smtp';
  private static $seccion = 'servidores';
  private static $campo_principal = 'con_smtp_user';
  


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
  /*combo para las tablas hija*/
  public function combo_servidores($id='')
  {
  	$combo = generar_combo($id, self::$tabla, self::$seccion, self::$campo_principal);
   	return $combo;
   }

  // ------------------------------------------------------------------------

  /*combo boxes usados en modificar*/
  public function combo_auth($id='')
  {
    $selected_deshabilitada = '';
    $selected_habilitada = '';

    $query = $this->db->get_where(self::$tabla, ['id' => $id]);

    $fila = $query->row_array();

    switch ($fila['con_smtp_auth']) {
      case '0':
        $selected_deshabilitada = "selected";
        break;
      case '1':
        $selected_habilitada = "selected";
        break;
    }

    $html = "
      <select id='con_smpt_auth' name='con_smpt_auth'>
        <option value='e' $selected_deshabilitada>Deshabilitada</option>
        <option value='m' $selected_habilitada>Habilitada</option>
      </select>
    ";

    return $html;
  }

  public function combo_sec($id='')
  {
    $selected_ssl = '';
    $selected_tls = '';

    $query = $this->db->get_where(self::$tabla, ['id' => $id]);

    $fila = $query->row_array();

    switch ($fila['con_smtp_sec']) {
      case 'ssl':
        $selected_ssl = "selected";
        break;
      case 'tls':
        $selected_tls = "selected";
        break;
    }

    $html = "
      <select id='con_smtp_sec' name='con_smtp_sec'>
        <option value='ssl' $selected_ssl>SSL</option>
        <option value='tls' $selected_tls>TLS</option>
      </select>
    ";

    return $html;
  }

  // ------------------------------------------------------------------------

  /*servidores por página para la paginación*/
  public function servidores_pagina($limit, $offset)
  {
    $this->db->order_by('id', 'asc');
    $this->db->limit($limit, $offset);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
      
  }

  /*numero total de servidores*/
  public function numero_servidores()
  {
    $query = $this->db->get(self::$tabla);
    return $query->num_rows();
  }

  /*total de la busqueda de servidores*/
  public function total_busqueda_servidores ($busqueda)
  {

    $this->db->like('con_smtp_user', $busqueda);
    $this->db->or_like('con_smtp_host', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->num_rows();
      
  }

  /*busqueda de servidores por página*/
  public function buscar_servidores_pag($busqueda, $limit, $offset)
  {
    $this->db->order_by('id', 'asc');        
    $this->db->limit($limit, $offset);
    $this->db->like('con_smtp_user', $busqueda);
    $this->db->or_like('con_smtp_host', $busqueda);

    $query = $this->db->get(self::$tabla);

    return $query->result_array();
    
  }

}

