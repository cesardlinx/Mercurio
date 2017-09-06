<?php

function registroAcciones() {
    $ci = &get_instance();
    $usu_id = $ci->session->log_usu_id;
    $eve_fecha = hoy('c');
    $eve_controller = current_url();
    $eve_ip = $ci->input->ip_address();
    $eve_post_arr = array();

    $findme = 'email_pendientes';
    $pos = strpos($eve_controller, $findme);
    if ($pos !== false) {
        //log_message('info', 'Omitiendo almacenar log de email_pendientes '.$eve_controller);
        return true;
    }

    if (count($_POST) > 0) {
        foreach ($_POST as $key => $value) {
            if (!is_array($value))
                $eve_post_arr[] = $key . ":" . $value;
        }
        $eve_post = implode(",", $eve_post_arr);
        $eve_post = "p[" . $eve_post . "]";
    } elseif (count($_GET) > 0) {
        foreach ($_GET as $key => $value) {
            if (!is_array($value))
                $eve_post_arr[] = $key . ":" . $value;
        }
        $eve_post = implode(",", $eve_post_arr);
        $eve_post = "g[" . $eve_post . "]";
    } else
    $eve_post = "-";

    $arreglo = array(
        'usu_id' => $usu_id,
        'eve_fecha' => $eve_fecha,
        'eve_controller' => $eve_controller,
        'eve_post' => $eve_post,
        'eve_ip' => $eve_ip
        );
    $ci->db->insert('admin_eventos', $arreglo);
}

function conectado() {
    $ci = &get_instance();
    if (!($ci->session->conectado === TRUE)) {
        $url_destino = uri_string();
        $url = base_url() . "?url_destino=" . $url_destino;
        redirect($url, 'refresh');
    } else {
        if (!accesos()) {
            $url = base_url() . "general";
            redirect($url, 'refresh');
        }
    }
}

function accesos($modulo = '') {
    $ci = &get_instance();
    $acceso = true;
    if ($modulo == '')
        $modulo = $ci->uri->segment(1);
    if ($ci->session->log_usu_adm == 'n') {
        switch ($modulo) {
            case 'sdi':
            case 'documentos':
            if ($ci->session->log_usu_adm_doc == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_doc == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            case 'smc':
            case 'mejora':
            if ($ci->session->log_usu_adm_rd == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_rd == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            case 'sgi':
            case 'indicadores':
            if ($ci->session->log_usu_adm_sgi == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_sgi == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            case 'sgp':
            case 'procesos':
            if ($ci->session->log_usu_adm_sgp == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_sgp == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            case 'pi':
            case 'partesint':
            if ($ci->session->log_usu_adm_pi == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_pi == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            case 'planificador':
            if ($ci->session->log_usu_adm_plan == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_plan == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            case 'sso':
            if ($ci->session->log_usu_adm_sso == 's') {
                $acceso = true;
            } elseif ($ci->session->log_usu_acc_sso == 's') {
                $acceso = true;
            } else
            $acceso = false;
            break;
            default:$acceso = true;
            break;
        }
    }
    return $acceso;
}

// calcular el numero de resultados en funcion del tamaño de la pantalla
function cuantosResultados() {
    $ci = &get_instance();
    // para 700 esta bien 20 resultados
    // cada resultado mide 20, entonces seria el  c = t/35
    //$tamano = $ci->session->userdata('ses_ven_alto');
    $tamano = 700;
    $tamano = $tamano - 200 - 110; // esto es tamaño de la cabecera + pie
    $cuantos = $tamano / 19; // mientras mas pequeño, mas resultados
    $cuantos = floor($cuantos);
    if ($cuantos < 1)
        $cuantos = 10;
    return $cuantos;
}

// aumentar una cantidad de dias
function diamas($fecha, $cuantos) {
    $partes = explode("-", $fecha);
    $ano = $partes[0] + 0;
    $mes = $partes[1] + 0;
    $dia = $partes[2] + 0;
    $diamas = mktime(date(0), date(0), date(0), date($mes), date($dia) + $cuantos, date($ano));
    $partes2 = explode(" ", $fecha);
    if (count($partes2) > 1) {
        $partes = explode(":", $partes2[1]);
        $hor = $partes[0] + 0;
        $min = $partes[1] + 0;
        $seg = $partes[2] + 0;
        return date("Y-m-d $hor:$min:$seg", $diamas);
    } else
    return date("Y-m-d", $diamas);
}

function mes_anterior($fecha) {
    $partes = explode("-", $fecha);
    $ano = $partes[0] + 0;
    $mes = $partes[1] + 0;
    return date("Y-m-d", (mktime(0, 0, 0, $mes - 1, 1, $ano)));
}

function hoy($tipo = '') {
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    switch ($tipo) {
        case "c":
        return "$fecha $hora";
        break;
        case "h":
        return $hora;
        break;
        default:
        return $fecha;
        break;
    }
}

function paginador_multiple($sql, $cuantos, $desde) {
    $paginado = "";
    $ci = &get_instance();

    $query = $ci->db->query($sql);

    $total_registros = $query->num_rows();
    $cantidad_paginas = floor($total_registros / $cuantos);
    if ($total_registros % $cuantos > 0)
        $cantidad_paginas++;

    if ($cantidad_paginas >= 12)
        $salto = floor($cantidad_paginas / 12);
    else
        $salto = 1;

    $vecinos = 4;
    $primos = floor($salto / $vecinos);
    $tios = $primos - floor($primos / 2);
    $arr_incluidas[0] = 0;
    /* die("paginas: $cantidad_paginas vecinos $vecinos salto $salto"); */

    for ($i = 0; $i < $cantidad_paginas; $i++) {
        $j = $i + 1;

        /* hermanos */
        if (($i > $desde - $vecinos) and ( $i < $desde + $vecinos) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado.="<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* primos */
        if ((($i == $desde - $primos) or ( $i == $desde + $primos)) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado.="<a  class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* tios */
        if ((($i == $desde - $tios) or ( $i == $desde + $tios)) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado.="<a  class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* extremos 1 y cantidad de paginas */
        if (($i == 0 or $i + 1 == $cantidad_paginas) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado.="<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* identificar si es salto e imprimirlo */
        if ((($i % $salto) == 0) and ! (array_key_exists($j, $arr_incluidas)))
            if ($i == $desde)
                $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado.="<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }
        return $paginado;
    }

    function paginador_multiple_arr($arr, $cuantos, $desde) {
        $paginado = "";
        $ci = &get_instance();
        $total_registros = count($arr);
        $cantidad_paginas = floor($total_registros / $cuantos);
        if ($total_registros % $cuantos > 0)
            $cantidad_paginas++;

        if ($cantidad_paginas >= 12)
            $salto = floor($cantidad_paginas / 12);
        else
            $salto = 1;

        $vecinos = 4;
        $primos = floor($salto / $vecinos);
        $tios = $primos - floor($primos / 2);
        $arr_incluidas[0] = 0;
        /* die("paginas: $cantidad_paginas vecinos $vecinos salto $salto"); */

        for ($i = 0; $i < $cantidad_paginas; $i++) {
            $j = $i + 1;

            /* hermanos */
            if (($i > $desde - $vecinos) and ( $i < $desde + $vecinos) and ! array_key_exists($j, $arr_incluidas)) {
                if ($i == $desde)
                    $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
                else
                    $paginado.="<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
                $arr_incluidas[$j] = $j;
            }

            /* primos */
            if ((($i == $desde - $primos) or ( $i == $desde + $primos)) and ! array_key_exists($j, $arr_incluidas)) {
                if ($i == $desde)
                    $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
                else
                    $paginado.="<a  class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
                $arr_incluidas[$j] = $j;
            }

            /* tios */
            if ((($i == $desde - $tios) or ( $i == $desde + $tios)) and ! array_key_exists($j, $arr_incluidas)) {
                if ($i == $desde)
                    $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
                else
                    $paginado.="<a  class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
                $arr_incluidas[$j] = $j;
            }

            /* extremos 1 y cantidad de paginas */
            if (($i == 0 or $i + 1 == $cantidad_paginas) and ! array_key_exists($j, $arr_incluidas)) {
                if ($i == $desde)
                    $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
                else
                    $paginado.="<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
                $arr_incluidas[$j] = $j;
            }

            /* identificar si es salto e imprimirlo */
            if ((($i % $salto) == 0) and ! (array_key_exists($j, $arr_incluidas)))
                if ($i == $desde)
                    $paginado.="<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
                else
                    $paginado.="<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
                $arr_incluidas[$j] = $j;
            }
            return $paginado;
        }

        function datoDeTabla($tabla, $regresa, $id) {
            $ci = &get_instance();
            $ci->db->select($regresa);
            $ci->db->where('id', $id);
            $query = $ci->db->get($tabla);
            if ($query->num_rows() > 0)
                return $query->row()->$regresa;
            else
                return false;
        }

        function datoDeTablaCampo($tabla, $campo, $regresa, $id) {
            $ci = &get_instance();
            $ci->db->select($regresa);
            $ci->db->where($campo, $id);
            $query = $ci->db->get($tabla);
            if ($query->num_rows() > 0)
                return $query->row()->$regresa;
            else
                return false;
        }

        /* uso en HCO */

        function datoDeTabla2($tabla, $regresa, $campo, $id) {
            $ci = &get_instance();
            $ci->db->select($regresa);
            $ci->db->where($campo, $id);
            $query = $ci->db->get($tabla);
            if ($query->num_rows() > 0)
                return $query->row()->$regresa;
            else
                return false;
        }

        function nomApeUsuario($usu_id) {
            $ci = &get_instance();
            $usu_apellidos = datoDeTabla("admin_usuarios", "usu_apellidos", $usu_id);
            $usu_nombres = datoDeTabla("admin_usuarios", "usu_nombres", $usu_id);
            if ($usu_nombres != false)
                return $usu_nombres . " " . $usu_apellidos;
            else
                return false;
        }

        function infoUsuario() {
            $ci = &get_instance();
            $ci->load->model('infouser_model');
            $info = $ci->infouser_model->datos_usuario();
            echo $info;
        }

        function formatear_fecha($fecha) {
            $arr = explode(" ", $fecha);
            if (count($arr) > 0)
                return $arr[0];
        }

        function fecha_texto($fecha, $tipo = 'f') {
            $lenguage = 'es_ES.UTF-8';
            setlocale(LC_ALL, $lenguage);
            if ($fecha == '0000-00-00' || $fecha == '0000-00-00 00:00:00')
                return "";
            else if ($fecha != '0000-00-00' || $fecha != '0000-00-00 00:00:00') {
                if ($tipo == 'f')
                    return addslashes(strftime("%d de %B de %Y", strtotime($fecha)));
                if ($tipo == 'c')
                    return addslashes(strftime("%d de %B de %Y %X", strtotime($fecha)));
            }
        }

        function cortar_texto($texto, $n = 75) {
            if (strlen($texto) > $n)
                return mb_substr($texto, 0, $n, 'UTF-8') . "...";
            else
                return $texto;
        }

        function limpiar_texto($texto) {
            $cadena = preg_replace("/[^A-Za-z0-9 -\.\n]/", " ", $texto);
            return $cadena;
        }

        /* funcion para comprobar existencia de dato en excel */

        function existe_datox($dato = FALSE) {
            if ($dato == FALSE || $dato == '')
                return $dato = "-";
            else
                return $dato;
        }

        function dic_dato($id = '0', $tipo = '') {
        
            if ($id == '0')
                return "Falta id ($id) para traducir." . $tipo;

            $ci = &get_instance();

            switch ($tipo) {
                case 'd':
                $regresa = "dic_cliente";
                break;
                case 'p':
                $regresa = "ayu_placeHolder";
                break;
                case 'a':
                $regresa = "ayu_descripcion";
                break;
                default:
                return "Falta tipo ($tipo) para traducir";
            }
            $ci->db->where('id', $id);
            $query = $ci->db->get("admin_ayudas");
            if ($query->num_rows() > 0) {
                $txt = $query->row()->$regresa;
                if (trim($txt) != "")
                    return $txt;
                else
                    return $query->row()->campo;
            } else
            return "ND";
        }

        /* para hco */

        function calculaedad($fecha_nacimiento) {
            if ($fecha_nacimiento == "0000-00-00")
                return "0";

            $fecha_actual = date("Y-m-d");
            $array_nacimiento = explode("-", $fecha_nacimiento);
            $array_actual = explode("-", $fecha_actual);
            $anos = $array_actual[0] - $array_nacimiento[0];
            $meses = $array_actual[1] - $array_nacimiento[1];
            $dias = $array_actual[2] - $array_nacimiento[2];
            if ($dias < 0) {
                --$meses;
                switch ($array_actual[1]) {
                    case 1: $dias_mes_anterior = 31;
                    break;
                    case 2: $dias_mes_anterior = 31;
                    break;
                    case 3:
                    if (bisiesto($array_actual[0])) {
                        $dias_mes_anterior = 29;
                        break;
                    } else {
                        $dias_mes_anterior = 28;
                        break;
                    }
                    case 4: $dias_mes_anterior = 31;
                    break;
                    case 5: $dias_mes_anterior = 30;
                    break;
                    case 6: $dias_mes_anterior = 31;
                    break;
                    case 7: $dias_mes_anterior = 30;
                    break;
                    case 8: $dias_mes_anterior = 31;
                    break;
                    case 9: $dias_mes_anterior = 31;
                    break;
                    case 10: $dias_mes_anterior = 30;
                    break;
                    case 11: $dias_mes_anterior = 31;
                    break;
                    case 12: $dias_mes_anterior = 30;
                    break;
                }
                $dias = $dias + $dias_mes_anterior;
            }

            if ($meses < 0) {
                --$anos;
                $meses = $meses + 12;
            }


            return " $anos años con $meses meses y $dias días";
        }

        function bisiesto($anio_actual) {
            $bisiesto = false;
    //probamos si el mes de febrero del año actual tiene 29 días
            if (checkdate(2, 29, $anio_actual)) {
                $bisiesto = true;
            }
            return $bisiesto;
        }

        function tipos_catologo($tipo = '') {
            $tf = $tp = $ts = $ti = $tl = $tr = $tc = $tz = $ta = "";
            switch ($tipo) {
                case 'p' : $tp = "selected";
                break;
                case 's' : $ts = "selected";
                break;
                case 'i' : $ti = "selected";
                break;
                case 'l' : $tl = "selected";
                break;
                case 'r' : $tr = "selected";
                break;
                case 'c' : $tc = "selected";
                break;
                case 'z' : $tz = "selected";
                break;
                case 'a' : $ta = "selected";
                break;
            }
            $combo = "<select name='cat_tipos' id='cat_tipos'><option value='t'>Todos los tipos de cátalogo</option>";
            $combo.= "<option value='p' $tp>Patologías</option>";
           // $combo.= "<option value='s' $ts>Sistema</option>";
            //$combo.= "<option value='i' $ti>Fisico</option>";
            $combo.= "<option value='l' $tl>Laboratorio</option>";
            $combo.= "<option value='r' $tr>Radiológico</option>";
            $combo.= "<option value='c' $tc>Complementaria</option>";
            $combo.= "<option value='z' $tz>Inmunización</option>";
            $combo.= "<option value='a' $ta>Actividad Extralaboral</option>";
            $combo.= "</select>";
            return $combo;
        }

        function tipos_catologo_inc($tipo = '') {
            $s = $l = $a = "";
            switch ($tipo) {
                case 's' : $s = "selected";
                break;
                case 'l' : $l = "selected";
                break;
                case 'a' : $a = "selected";
                break;
            }
            $combo = "<select name='cat_tipos' id='cat_tipos'><option value='t'>Todos los tipos de cátalogo</option>";
            $combo.= "<option value='s' $s>Síntomas</option>";
            $combo.= "<option value='l' $l>Naturaleza de la lesión</option>";
            $combo.= "<option value='a' $a>Parte del cuerpo afectada</option>";
            $combo.= "</select>";
            return $combo;
        }


        function formatear_hora($date) {
            $hora_n = "";
            if ($date == "")
                return $hora_n;
            $hora_1 = explode(" ", $date);
            if (count($hora_1) > 0) {
                $h = explode(":", $hora_1[1]);
                if (count($h) > 0) {
                    $hora_n = $h[0] . ":" . $h[1];
                }
            }
            return $hora_n;
        }

        function obtener_dia($fecha) {
            $array_dias['Sunday'] = "Domingo";
            $array_dias['Monday'] = "Lunes";
            $array_dias['Tuesday'] = "Martes";
            $array_dias['Wednesday'] = "Miercoles";
            $array_dias['Thursday'] = "Jueves";
            $array_dias['Friday'] = "Viernes";
            $array_dias['Saturday'] = "Sabado";

            return $array_dias[date('l', strtotime($fecha))];
        }

        /*para diagnostico*/

        function diag_evaluado_pixel_hlp($dia_cumplimiento) {
            if ($dia_cumplimiento >= 100)
                $pixel = "<img src='" . base_url() . "css/img/azul.gif' width='7' style='margin:3px' />";
            else
                $pixel = "<img src='" . base_url() . "css/img/rojo.gif' width='7' style='margin:3px' />";
            return $pixel;
        }
        ?>