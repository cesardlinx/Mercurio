<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Eventos_model extends CI_Model {

// tabla a usar de la base de datos
  private static $tabla = 'eventos';


  public function __construct()
  {
      parent::__construct();
  }


  // ------------------------------------------------------------------------

  public function almacenar_mdl($datos) {
    $this->db->insert(self::$tabla, $datos);
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

  public function datos_evento($id) {
    $this->db->where("id", $id);
    $query = $this->db->get(self::$tabla);
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else
      return "Sin datos ($id)";
  }


  // ------------------------------------------------------------------------

  public function combo_eventos($id = '')
  {
    $html = "<select id='eve_id' name='eve_id'><option value=''>Seleccione</option>";
    $this->db->order_by("eve_titulo");
    $query = $this->db->get('eventos');
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $fila) {
        $id_d = $fila->id;
        $eve_titulo = $fila->eve_titulo;
        if ($id_d == $id)
          $selected = "selected";
        else
          $selected = "";
        $html.="<option value='$id_d' $selected>$eve_titulo</option>";
      }
      return $html . "</select>";
    } else
      return "No hay eventos ingresados";
    return $html;
  }

  // ------------------------------------------------------------------------

  /*eventos por página para la paginación*/
  public function eventos_pagina($limit, $offset, $tem_id='')
  {
    $this->db->limit($limit, $offset);
  
    if ($tem_id) {
      $this->db->where('tem_id', $tem_id);            
    }
      
    $query = $this->db->get('eventos');
  
    return $query->result_array();
      
  }

  /*numero total de eventos*/
  public function numero_eventos($tem_id='')
  {
    if ($tem_id) {
      $this->db->where('tem_id', $tem_id);            
    }
  
    $query = $this->db->get('eventos');
    return $query->num_rows();
  }
    
  /*busqueda de eventos*/
  public function total_busqueda_eventos ($busqueda, $tem_id='')
  {
  
    $this->db->like('eve_titulo', $busqueda);
    $this->db->or_like('eve_subtitulo', $busqueda);
    $this->db->or_like('eve_descripcion', $busqueda);
    $this->db->or_like('eve_contenido', $busqueda);
  
    if ($tem_id) {
      $this->db->where('tem_id', $tem_id);            
    }
  
    $query = $this->db->get('eventos');
  
    return $query->num_rows();
      
  }
    
  /*busqueda de eventos*/
  public function buscar_eventos_pag($busqueda, $limit, $offset, $tem_id='')
  {
  
    $this->db->limit($limit, $offset);
    $this->db->like('eve_titulo', $busqueda);
    $this->db->or_like('eve_subtitulo', $busqueda);
    $this->db->or_like('eve_descripcion', $busqueda);
    $this->db->or_like('eve_contenido', $busqueda);
  
    if ($tem_id) {
      $this->db->where('tem_id', $tem_id);            
    }
  
    $query = $this->db->get('eventos');
  
    return $query->result_array();
      
  }

  // ------------------------------------------------------------------------



}

