<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conexion_model extends CI_Model {

    private static $table = 'admin_usuarios';

    public function __construct() {
        parent::__construct();
    }

    // ------------------------------------------------------------------------


    public function obtener_datos($data)
    {
        $query = $this->db->get_where(self::$table, $data);
        $resultado = $query->result_array();

        return $resultado;

    }

    // ------------------------------------------------------------------------

    public function almacenar($datos_usuario)
    {
        $this->db->insert(self::$table, $datos_usuario);
    }

    // ------------------------------------------------------------------------


    public function actualizar()
    {
        # code...
    }

    public function borrar()
    {
        # code...
    }

    // ------------------------------------------------------------------------

    /*POR PROBAR*/
    public function desactivar_usuario_mdl($email) {
        $data = array(
            'usu_activo' => 'n'
            );
        $this->db->where('usu_email', $email);
        $this->db->update("emp_usuarios", $data);
    }
}

?>


