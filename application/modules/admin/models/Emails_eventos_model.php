<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_eventos_model extends CI_Model {

	// tabla a usar de la base de datos
    private static $tabla = 'emails_eventos';
    private static $campo_principal = 'eml_asunto';


	public function __construct()
	{
		parent::__construct();

	}

	// ------------------------------------------------------------------------

	public function index() {


		// datos para paginación y búsqueda
        $desde = $this->input->post('desde');
        $w_buscar = $this->input->post('w_buscar');

        $buscar = $w_buscar . '%';

        $campo_principal = 'eml_asunto';
        $tabla = self::$tabla;


        if ($desde == "")
            $desde = 0;
        $paginado = $html = "";
        $cuantos = cuantosResultados();

        // consulta
        // buscar solo si hay más de 3 caracteres
        if (strlen($w_buscar) > 3) {

            $sql = "SELECT * FROM `$tabla` WHERE '$campo_principal' LIKE `$buscar` ORDER BY '$campo_principal'";
        } else {
            $sql = "SELECT * FROM `$tabla` ORDER BY `$campo_principal`";
        }

        // paginado
        $paginado = paginador_multiple($sql, $cuantos, $desde);
        $desde*=$cuantos;
        $sql_limit = $sql . " limit $desde,$cuantos";

        // ejecución de la consulta
        $query = $this->db->query($sql_limit);
        if ($query->num_rows() > 0) {
            // creación de las filas con el template
            foreach ($query->result() as $fila) {

                $data = array(
                    'id' => $fila->id,
                    'nombre' => $fila->{$campo_principal},
                );

                $html .= $this->parser->parse('emails_eventos/index_tpl', $data, TRUE);
            }
        } else {
            $html.= "<tr><td colspan='3'>No hay emails(<strong>$w_buscar</strong>)</td></tr>";
        }

        // datos para la vista
        $arreglo["html"] = $html;
        $arreglo["w_buscar"] = $w_buscar;
        $arreglo["paginado"] = $paginado;
        return $arreglo;
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


}

