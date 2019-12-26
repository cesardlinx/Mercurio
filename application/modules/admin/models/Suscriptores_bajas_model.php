<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suscriptores_bajas_model extends CI_Model {

  // tabla a usar de la base de datos
  private static $tabla = 'suscriptores_bajas';


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

  /*bajas de suscriptores por página para la paginación*/
  public function suscriptores_pagina($limit, $offset)
  {
    $this->db->order_by('id', 'asc');
    $this->db->limit($limit, $offset);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
      
  }

  /*numero total de bajas de suscriptores*/
  public function numero_suscriptores()
  {
    $query = $this->db->get(self::$tabla);
    return $query->num_rows();
  }

  /*total de la busqueda de bajas de suscriptores*/
  public function total_busqueda_suscriptores ($busqueda)
  {

    $this->db->like('sus_nombres', $busqueda);
    $this->db->or_like('sus_apellidos', $busqueda);

    $query = $this->db->get(self::$tabla);

    return $query->num_rows();
      
  }

  /*busqueda de bajas de suscriptores por página*/
  public function buscar_suscriptores_pag($busqueda, $limit, $offset)
  {
    $this->db->order_by('id', 'asc');        
    $this->db->limit($limit, $offset);
    $this->db->like('sus_nombres', $busqueda);
    $this->db->or_like('sus_apellidos', $busqueda);

    $query = $this->db->get(self::$tabla);

    return $query->result_array();
    
  }





}

