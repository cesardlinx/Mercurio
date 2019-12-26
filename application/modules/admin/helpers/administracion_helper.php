<?php 

function generar_indice($tabla, $desde, $w_buscar, $seccion, $campo_principal) {

		$ci =& get_instance();

		// datos para paginación y búsqueda
        $desde = $ci->input->post('desde');
        $w_buscar = $ci->input->post('w_buscar');

        $buscar = $w_buscar . '%';

        if ($desde == "")
            $desde = 0;
        $paginado = $html = "";
        $cuantos = cuantosResultados();

        // consulta
        // buscar solo si hay más de 3 caracteres
        if (strlen($w_buscar) > 3) {

            $sql = "SELECT * FROM `$tabla` WHERE `$campo_principal` LIKE '$buscar' ORDER BY `$campo_principal`";
        } else {
            $sql = "SELECT * FROM `$tabla` ORDER BY `$campo_principal`";
        }

        // paginado
        $paginado = paginador_multiple($sql, $cuantos, $desde);
        $desde*=$cuantos;
        $sql_limit = $sql . " limit $desde,$cuantos";

        // ejecución de la consulta
        $query = $ci->db->query($sql_limit);
        if ($query->num_rows() > 0) {
        	// creación de las filas con el template
            foreach ($query->result() as $fila) {

            	$data = array(
            		'id' => $fila->id,
            		'nombre' => $fila->{$campo_principal},
                    'seccion' => rtrim($seccion, 's')
            	);

                $html .= $ci->parser->parse('indices/indice_tpl', $data, TRUE);
            }
        } else {
            $html.= "<tr><td colspan='3'>No hay ".$seccion."(<strong>$w_buscar</strong>)</td></tr>";
        }

        // datos para la vista
        $arreglo["html"] = $html;
        $arreglo["w_buscar"] = $w_buscar;
        $arreglo["paginado"] = $paginado;
        return $arreglo;

}




 ?>