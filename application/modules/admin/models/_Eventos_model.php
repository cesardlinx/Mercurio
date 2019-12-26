<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Eventos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $desde = $this->input->post('desde');
        $w_buscar = $this->input->post('w_buscar');

        $buscar = $w_buscar . '%';

        // Cabecera con carga de librerias, modelos o helpers
        //$this->load->library('parser');
        // Carga de variables e iniciar variables en blanco
        if ($desde == "")
            $desde = 0;
        $paginado = $html = "";
        $cuantos = cuantosResultados();
        if (strlen($w_buscar) > 3) {
            $sql = "SELECT * FROM `eventos` WHERE `eve_titulo` LIKE '$buscar' ORDER BY `eve_titulo`";
        } else {
            $sql = "SELECT * FROM `eventos` ORDER BY `eve_titulo`";
        }

        $paginado = paginador_multiple($sql, $cuantos, $desde);
        $desde*=$cuantos;
        $sql_limit = $sql . " limit $desde,$cuantos";
        $query = $this->db->query($sql_limit);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $html .= $this->parser->parse('eventos/index_tpl', $fila, TRUE);
            }
        } else {
            $html.= "<tr><td colspan='3'>No hay eventos(<strong>$w_buscar</strong>)</td></tr>";
        }
        $arreglo["html"] = $html;
        $arreglo["w_buscar"] = $w_buscar;
        $arreglo["paginado"] = $paginado;
        return $arreglo;
        ;
    }

    public function almacenar_mdl() {
        $hoy = hoy('c');
        $arreglo = array(
            "loc_id" => $this->input->post('loc_id'),
            "tem_id" => $this->input->post('tem_id'),
            "eve_activodesde" => $hoy,
            "usu_id_conferencista" => $this->input->post('usu_id_conferencista'),
            "eve_titulo" => $this->input->post('eve_titulo'),
            "eve_subtitulo" => $this->input->post('eve_subtitulo'),
            "eve_descripcion" => $this->input->post('eve_descripcion'),
            "eve_contenido" => $this->input->post('eve_contenido'),
            "eve_objetivos" => $this->input->post('eve_objetivos'),
            "eve_dirigido" => $this->input->post('eve_dirigido'),
            "eve_duracion" => $this->input->post('eve_duracion'),
            "eve_lugar" => $this->input->post('eve_lugar'),
            "eve_fechasHorarios" => $this->input->post('eve_fechasHorarios'),
            "eve_costo" => $this->input->post('eve_costo'),
            "eve_fecha_hora" => $hoy,
            "eve_observaciones" => $this->input->post('eve_observaciones'),
        );
        $this->db->insert('eventos', $arreglo);
    }


    public function datos_evento($id) {
        $this->db->where("id", $id);
        $query = $this->db->get('eventos');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else
            return "Sin datos ($id)";
    }

    public function actualizar_mdl() {
        $id = $this->input->post('id');
        $arreglo = array(
            "loc_id" => $this->input->post('loc_id'),
            "tem_id" => $this->input->post('tem_id'),
            "usu_id_conferencista" => $this->input->post('usu_id_conferencista'),
            "eve_titulo" => $this->input->post('eve_titulo'),
            "eve_subtitulo" => $this->input->post('eve_subtitulo'),
            "eve_descripcion" => $this->input->post('eve_descripcion'),
            "eve_contenido" => $this->input->post('eve_contenido'),
            "eve_objetivos" => $this->input->post('eve_objetivos'),
            "eve_dirigido" => $this->input->post('eve_dirigido'),
            "eve_duracion" => $this->input->post('eve_duracion'),
            "eve_lugar" => $this->input->post('eve_lugar'),
            "eve_fechasHorarios" => $this->input->post('eve_fechasHorarios'),
            "eve_costo" => $this->input->post('eve_costo'),
            "eve_observaciones" => $this->input->post('eve_observaciones'),
        );
        $this->db->where('id', $id);
        $this->db->update('eventos', $arreglo);
    }


    public function eliminar_mdl() {
        $id = $this->uri->segment(4);
        $this->db->where('id', $id);
        $this->db->delete("eventos");
        return true;
    }

    public function combo_temas($id = '') {
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
            return "No hay temas ingresados";

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
