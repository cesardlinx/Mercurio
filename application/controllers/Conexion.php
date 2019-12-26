<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conexion extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/usuarios_model', 'conexion'); //carga el modelo
    }

    // ------------------------------------------------------------------------


    /*destino del submit*/
    public function conectar()
    {
        $this->output->set_content_type('application/json');

        /*recepcion de datos del formulario*/
        $email = trim($this->input->post('usuario'));
        $contrasena = trim($this->input->post('contrasena'));

        $url_base = base_url();

        /*comprobación de datos*/
        $datos_comprobacion = $this->conexion->obtener_datos([
            'usu_email' => $email,
            'usu_contrasena' => hash('sha256', $contrasena.SALT)
        ]);

        /*resultado positivo*/
        if ($datos_comprobacion) {
            $this->_crear_sesion($datos_comprobacion[0]);
        }
        
        /*salida json*/
        $this->output->set_output(json_encode([
            'conexion' => $this->session->conectado,            
            'urlBase' => $url_base
        ]));


    }
    // ------------------------------------------------------------------------
    


    public function registrarusuario()
    {
        $this->output->set_content_type('application/json');

        /*reglas de validación*/
        $this->form_validation->set_rules(
            'nombres',
            'Nombres',
            'trim|stripslashes|required|min_length[5]|max_length[16]'
        );

        $this->form_validation->set_rules(
            'apellidos',
            'Apellidos',
            'trim|stripslashes|required|min_length[5]|max_length[16]'
        );

        $this->form_validation->set_rules(
            'contrasena',
            'Contraseña',
            'trim|stripslashes|required|min_length[6]|max_length[16]'
        );

        $this->form_validation->set_rules(
            'confirmar_contrasena',
            'Confirmar Contraseña',
            'trim|stripslashes|required|min_length[6]|max_length[16]|matches[contrasena]'
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|stripslashes|required|min_length[6]|max_length[40]|valid_email|is_unique[admin_usuarios.usu_email]'
        );

        $this->form_validation->set_rules(
            'hojavida',
            'Hoja de Vida',
            'trim|required'
        );

        

        // seteado de mensajes de error
        $this->form_validation->set_message('required', 'El campo {field} es requerido.');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden.');
        $this->form_validation->set_message('valid_email', 'El campo {field} debe contener un correo válido');
        $this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres de longitud.');
        $this->form_validation->set_message('max_length', 'El campo {field} no puede exceder los {param} caracteres de longitud.');
        $this->form_validation->set_message('is_unique', 'La dirección de correo electrónico ya existe.');


        /*en caso de validación exitosa*/
        if ($this->form_validation->run() == TRUE) {

            $anos_validez = strtotime("+3 Years");
            $fecha_contrasena = date("Y-m-d", $anos_validez);

            /*recolectando los datos del usuario*/
            $datos_usuario = array(
                'usu_nombres' => $this->input->post('nombres'),
                'usu_apellidos' => $this->input->post('apellidos'),
                'usu_contrasena' => hash('sha256', $this->input->post('contrasena') . SALT),
                'usu_email' => $this->input->post('email'),
                'usu_hojavida' => $this->input->post('hojavida'),
                'usu_ingreso' => hoy('c'),
                'usu_adm' => 'n',
                'usu_activo' => 's',
                'usu_fecha_contrasena' => $fecha_contrasena
            );

            /*almacenamiento de datos y creación de sesión*/
            $this->conexion->almacenar_mdl($datos_usuario);
            $datos_usuario_alm = $this->conexion->obtener_datos($datos_usuario);
            $this->_crear_sesion($datos_usuario_alm[0]);
           
        } 

        /*salida json*/
        $this->output->set_output(json_encode([
            'conexion' => $this->session->conectado,            
            'errores' => $this->form_validation->error_array(),
            'urlBase' => base_url()
        ]));



    }
    // ------------------------------------------------------------------------

    private function _crear_sesion($datos)
    {
        $datos_sesion = array(
            'conectado' => TRUE,
            'log_usu_id' => $datos['id'],
            'log_usu_apellidos' => $datos['usu_apellidos'],
            'log_usu_nombres' => $datos['usu_nombres'],
            'log_usu_email' => $datos['usu_email'],
            'log_usu_adm' => $datos['usu_adm'],
            'log_usu_activo' => $datos['usu_activo'],
            'log_usu_fecha_contrasena' => $datos['usu_fecha_contrasena']
        );

        $this->session->set_userdata($datos_sesion);

    }

    // ------------------------------------------------------------------------

    // logout
    public function salir() {
        $this->session->sess_destroy();
        $url_salir = $this->config->item('con_emp_al_salir');
        if ($url_salir == '')
            redirect("/");
        else
            redirect($url_salir, "refresh");
    }

}
