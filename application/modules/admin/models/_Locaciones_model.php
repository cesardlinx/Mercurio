<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locaciones_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //listar locaciones
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
            $sql = "SELECT * FROM `admin_locaciones` WHERE `loc_nombre` LIKE '$buscar' ORDER BY `loc_nombre`";
        } else {
            $sql = "SELECT * FROM `admin_locaciones` ORDER BY `loc_nombre`";
        }

        $paginado = paginador_multiple($sql, $cuantos, $desde);
        $desde*=$cuantos;
        $sql_limit = $sql . " limit $desde,$cuantos";
        $query = $this->db->query($sql_limit);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $html .= $this->parser->parse('locaciones/index_tpl', $fila, TRUE);
            }
        } else {
            $html.= "<tr><td colspan='3'>No hay locaciones(<strong>$w_buscar</strong>)</td></tr>";
        }
        $arreglo["html"] = $html;
        $arreglo["w_buscar"] = $w_buscar;
        $arreglo["paginado"] = $paginado;
        return $arreglo;
        ;
    }

    public function almacenar_mdl() {
        $arreglo = array(
            "loc_nombre" => $this->input->post('loc_nombre'),
            "loc_direccion" => $this->input->post('loc_direccion'),
            "loc_telefonos" => $this->input->post('loc_telefonos'),
            "loc_coordenadas	" => $this->input->post('loc_coordenadas'),
        );
        $this->db->insert('admin_locaciones', $arreglo);
    }

    public function datos_locacion() {
        $id = $this->uri->segment(4);
        $this->db->where("id", $id);
        $query = $this->db->get('admin_locaciones');
        if ($query->num_rows() > 0){
            return $query->row_array();
        }else
            return "Sin datos ($id)";
        
    }

    public function actualizar_mdl() {
        $id = $this->input->post('id');
        $arreglo = array(
            "loc_nombre" => $this->input->post('loc_nombre'),
            "loc_direccion" => $this->input->post('loc_direccion'),
            "loc_telefonos" => $this->input->post('loc_telefonos'),
            "loc_coordenadas	" => $this->input->post('loc_coordenadas'),
        );
        $this->db->where('id', $id);
        $this->db->update('admin_locaciones', $arreglo);
    }

    public function eliminar_mdl() {
        $id = $this->uri->segment(4);
        $this->db->where('id', $id);
        $this->db->delete("admin_locaciones");
        return true;
    }

    public function combo_locaciones($id = '') {
        $html = "<select id='loc_id' name='loc_id'><option value=''>Seleccione</option>";
        $this->db->order_by("loc_nombre");
        $query = $this->db->get('admin_locaciones');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $id_d = $fila->id;
                $loc_nombre = $fila->loc_nombre;
                if ($id_d == $id)
                    $selected = "selected";
                else
                    $selected = "";
                $html.="<option value='$id_d' $selected>$loc_nombre</option>";
            }
            return $html . "</select>";
        } else
            return "No hay locaciones ingresados";

        return $html;
    }

}
