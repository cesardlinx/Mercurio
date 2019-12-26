<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temas_model extends CI_Model {

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
            $sql = "SELECT * FROM `temas` WHERE `tem_nombre` LIKE '$buscar' ORDER BY `tem_nombre`";
        } else {
            $sql = "SELECT * FROM `temas` ORDER BY `tem_nombre`";
        }

        $paginado = paginador_multiple($sql, $cuantos, $desde);
        $desde*=$cuantos;
        $sql_limit = $sql . " limit $desde,$cuantos";
        $query = $this->db->query($sql_limit);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $html .= $this->parser->parse('temas/index_tpl', $fila, TRUE);
            }
        } else {
            $html.= "<tr><td colspan='3'>No hay temas(<strong>$w_buscar</strong>)</td></tr>";
        }
        $arreglo["html"] = $html;
        $arreglo["w_buscar"] = $w_buscar;
        $arreglo["paginado"] = $paginado;
        return $arreglo;
        ;
    }

    public function almacenar_mdl() {
        $arreglo = array(
            "tem_nombre" => $this->input->post('tem_nombre'),
            "tem_descripcion" => $this->input->post('tem_descripcion'),
            
        );
        $this->db->insert('temas', $arreglo);
    }

    public function datos_tema() {
        $id = $this->uri->segment(4);
        $this->db->where("id", $id);
        $query = $this->db->get('temas');
        if ($query->num_rows() > 0){
            return $query->row_array();
        }else
            return "Sin datos ($id)";
        
    }

    public function actualizar_mdl() {
        $id = $this->input->post('id');
        $arreglo = array(
            "tem_nombre" => $this->input->post('tem_nombre'),
            "tem_descripcion" => $this->input->post('tem_descripcion'),
        );
        $this->db->where('id', $id);
        $this->db->update('temas', $arreglo);
    }

    public function eliminar_mdl() {
        $id = $this->uri->segment(4);
        $this->db->where('id', $id);
        $this->db->delete("temas");
        return true;
    }

    public function combo_temas($id = '') {
        $html = "<select id='tem_id' name='tem_id'><option value=''>Seleccione</option>";
        $this->db->order_by("tem_nombre");
        $query = $this->db->get('temas');
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

}
