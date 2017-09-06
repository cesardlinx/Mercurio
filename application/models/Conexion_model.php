<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conexion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->conectado === TRUE)
            return FALSE;
        $d = hoy('c');
        $l = md5($d);
        $arr["llave"] = $l;
        $arr["usuario"] = $this->input->post("usuario");
        $arr["contrasena"] = "";
        $arr["url_destino"] = $this->input->get("url_destino");
        $this->session->set_userdata($arr);
        return $arr;
    }

    public function verificar_contrasena() {
        /*$id = $this->session->userdata('log_usu_id');
        $usu_fecha_contrasena = datoDeTabla("emp_usuarios", "usu_fecha_contrasena", $id);
        if ($usu_fecha_contrasena > hoy())
            return true;
        else
        return false;*/
        return true;
    }

    public function verificar() {
        $u = $this->input->post("usuario");
        $p = trim($this->input->post("contrasena"));
        $l = trim($this->input->post("llave"));

        if ($this->session->llave != $l)
            return "Debe cerrar el navegador y volver a ingresar. Error en intercambio de llave.";
        return $this->verificar_usuario_bdd($u, $p);
    }

    private function verificar_usuario_bdd($u, $p) {
       $sql = "SELECT `id` FROM `admin_usuarios` WHERE `usu_email` like '$u'";
       $query = $this->db->query($sql);
       if ($query->num_rows() != 1)
        return "No existe nombre de usuario.";

    $pmd5 = md5($p);
    $sql = "SELECT * FROM `admin_usuarios` WHERE (`usu_email` like '$u') AND (`usu_contrasena` like '$pmd5') AND (`usu_activo` = 's')";
    $query2 = $this->db->query($sql);
    if ($query2->num_rows() != 1)
        return "Contraseña incorrecta";

    $r2 = $query2->row();
    $this->creaSesion($r2);
        // con un false le decimos que está todo bien :)
    return false;
}

/*
public function numero_intentos($correo) {
    $m = "";
    if (!$this->session->has_userdata('usuario')) {
        $data2 = array(
            'usuario' => $correo
            );
        $this->session->set_userdata($data2);
    }
    if ($this->session->has_userdata('contador') && $this->session->userdata('usuario') == $correo) {
        $c = $this->session->userdata('contador');
        $c = $c + 1;
        $newdata = array(
            'contador' => $c
            );
        $this->session->set_userdata($newdata);
        if ($this->session->userdata('contador') >= 3) {
                //$this->conexion->desactivar_usuario_dml($correo);
            $this->conexion->cambiar_contrasena_dml($correo);
            $m = "Ha sobrepasado el número de intentos para ingresar al sistema, por favor revise su cuenta de correo.";
            $this->session->sess_destroy();
        }
    } else {
        $data = array(
            'contador' => 1,
            );
        $this->session->set_userdata($data);
    }
    return $m;
}
*/
public function desactivar_usuario_dml($email) {
    $data = array(
        'usu_activo' => 'n'
        );
    $this->db->where('usu_email', $email);
    $this->db->update("emp_usuarios", $data);
}
/*
public function cambiar_contrasena_dml($email) {
    $this->load->model('admin/usuarios_model');

    $usu_id = datoDeTablaCampo("emp_usuarios", "usu_email", "id", $email);
    $arr_usu = array();

    $contrasena = $this->crear_contrasena_mdl();
    $this->usuarios_model->nuevo_password($usu_id, $contrasena);
    $arr_usu[] = $usu_id;
    $arr_usu[] = datoDeTablaCampo("emp_usuarios", "usu_email", "id", "juancarlos@correovirtual.com");
    $this->email_model->enviar_email($arr_usu, "Clave AVAL", "Estimado usuario ($email), esta es su nueva clave para acceder al sistema MAI ".base_url()."<br> <strong>$contrasena</strong><br>", 's');
}
*/
public function crear_contrasena_mdl() {
    $cadena = "abcdefghijklmnopqrstuvwxyz123456789";
    $longCad = strlen($cadena);
    $contrasena = "";
    for ($i = 1; $i <= 5; $i++) {
        $pos = rand(0, $longCad - 1);
        $contrasena .= substr($cadena, $pos, 1);
    }
    return $contrasena;
}

private function creaSesion($r2) {
        // juancarlos@correovirtual.com
    $arr["conectado"] = TRUE;
    $arr['log_usu_id'] = $r2->id;
    /*
    $arr['log_usu_nombres'] = $r2->usu_nombres;
    $arr['log_usu_apellidos'] = $r2->usu_apellidos;
    $arr['log_usu_email'] = $r2->usu_email;
    $arr['log_usu_adm'] = $r2->usu_adm;*/
        // como pasó las pruebas, creo la sesion
    $this->session->set_userdata($arr);
}


}

?>