<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth {

    protected $ci;

    //creamos una instancia del super objeto de codeigniter
    //en el constructor para poder tenerlo disponible las veces
    //que necesitemos sin repetir la misma línea
    public function __construct() {
        $this->ci = &get_instance();
    }

    //creamos una token para nuestros formularios
    public function token() {
        $token = md5(uniqid(rand(), true));
        $this->ci->session->set_userdata('token', $token);
        return $token;
    }

    //función para comprobar si el usuario está logueado
    public function is_logged() {
        return $this->ci->session->userdata('email') !== FALSE ? TRUE : FALSE;
    }

    //creamos un array con los campos del formulario
    public function campos_formulario() {

        $campos = array('input_email' =>
            array('name' => 'email',
                'id' => 'email',
                'type' => 'email',
                'required' => 'true',
                'placeholder' => 'Ingresa tu email',
                'maxlength' => '100',
                'size' => '50',
                'class' => 'ingreso',
                'value' => set_value('email')),
            'input_password' =>
            array('name' => 'password',
                'id' => 'password',
                'placeholder' => 'Ingresa tu contraseña',
                'maxlength' => '100',
                'size' => '50',
                'class' => 'ingreso',
                'value' => set_value('password')
            )
        );

        return $campos;
    }

    //función para validar los formularios
    public function validate() {
        //si es el formulario de registro validamos el captcha
        if ($this->ci->input->post('recaptcha_challenge_field')) {
            $this->ci->form_validation->set_rules('recaptcha_response_field', 'codigo captcha', 'callback_verifica_captcha|xss_clean');
        }

        $this->ci->form_validation->set_rules('email', 'email', 'required|trim|min_length[2]|valid_email|max_length[100]|xss_clean');
        $this->ci->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[100]|xss_clean');

        $this->ci->form_validation->set_message('required', 'El %s es requerido');
        $this->ci->form_validation->set_message('valid_email', 'El %s no es correcto');
        $this->ci->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->ci->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');

        if ($this->ci->form_validation->run() == FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    //función para loguear a los usuarios
    public function login_user($email, $password) {
        $this->ci->db->where('usu_email', $email);
        $query = $this->ci->db->get('admin_usuarios');

        //si el nombre de usuario coincide y sólo existe uno procedemos
        if ($query->num_rows() == 1) {
            $user = $query->row();
            //en pass guardamos el hash del usuario que tenemos en la base
            //de datos para comprobarlo con el método check_password de Bcrypt
            $pass = $user->usu_contrasena;

            //esta es la forma de comprobar si el password del
            //formulario coincide con el codificado de la base de datos
           // if ($this->ci->bcrypt->check_password($password, $pass)) {
                $query = $this->ci->db->get_where('usuarios', array('usu_email' => $email, 'usu_contrasena' => $password));
                if ($query->num_rows() == 0) {
                    return FALSE;
                } else {
                    return TRUE;
                }
     //       }
        }
    }

    //función para crear sesiones
    public function crear_sesiones($email, $password) {
        $A = $M = "";
        $pass = $this->ci->bcrypt->hash_password($password);
        $query = $this->ci->db->get_where('admin_usuarios', array('usu_email' => $email));
        $user = $query->row();
        $id = $user->id;
        $n = $user->usu_nombres;
        $a = $user->usu_apellidos;
        $adm = $user->usu_adm;
        $med = $user->usu_mdc;
        if ($adm == 's')
            $A = 'A';
        else
            $A = '';
        if ($med == 's')
            $M = 'M';
        else
            $M = '';

//        die("$A $M");

        if ($A == 'A' or $M == 'M')
            $tipo = "($A $M)";
        else
            $tipo = "";
        

        //$sql_debug = $this->ci->db->last_query(); die("$sql_debug");
        $data = array(
            'log_usu_id' => $id,
            'email' => $email,
            'ses_nombres' => "$n $a",
            'ses_tipo' => $tipo,
            'ses_medico' => $med,
            'password' => $this->ci->bcrypt->hash_password($password)
        );

        $this->ci->session->set_userdata($data);
    }

    //función para enviar emails al registrarse
    public function send_mail($email, $password) {

        $config['useragent'] = "CodeIgniter";
        $config['mailpath'] = "/usr/sbin/sendmail"; // Sendmail path
        $config['protocol'] = "smtp"; // mail/sendmail/smtp
        $config['smtp_host'] = "ssl://smtp.gmail.com";  // SMTP Server.  Example: mail.earthlink.net
        $config['smtp_user'] = "israelparraconejero1981@gmail.com";  // SMTP Username
        $config['smtp_pass'] = "carlamelissa12";  // SMTP Password
        $config['smtp_port'] = "465";  // SMTP Port
        $config['mailtype'] = "html"; // text/html  Defines email formatting
        $config['charset'] = "utf-8"; // Default char set: iso-8859-1 or us-ascii			

        $this->ci->load->library('email', $config);
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->from('Codeigniter', 'Librería de login');
        $this->ci->email->to($email);
        $this->ci->email->subject('Se ha registrado correctamente.');
        $this->ci->email->message('Sus datos de acceso:<br /><br />Email: ' . $email . '<br />Password: ' . $password);
        $this->ci->email->send();
    }

    //función para cerrar sesión
    public function logout() {

        $this->ci->session->unset_userdata(array('email', 'password'));
        $this->ci->session->sess_destroy();
        $this->ci->session->sess_create();
        $this->ci->session->set_flashdata('cerrada', 'La sessión se ha cerrado correctamente.');
        redirect(base_url('conexion', 'refresh'));
    }

}

/*
 * end libraries/auth.php
 */
