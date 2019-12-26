<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_page extends MY_Controller {

  public function __construct()
	{
    parent::__construct();
  }

  public function index($id)
	{
  	// cargo modelos
    $this->load->model('admin/eventos_model');
    $this->load->model('admin/usuarios_model');

    // cargo datos del evento
    $data = $this->eventos_model->datos_evento($id);

    // busco conferencista entre los usuarios
    $id_usuario = $data['usu_id_conferencista'];
    $datos_usuario = $this->usuarios_model->datos_usuario($id_usuario);
    $data['usu_conferencista'] = $datos_usuario['usu_nombres'].' '.$datos_usuario['usu_apellidos'] ;

    // cargo la vista
    $this->load->view('index', $data);
  }

  // ------------------------------------------------------------------------

  // se ejecuta la dar submit en el formulario
  public function suscripcion()
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
      'email',
      'Email',
      'trim|stripslashes|required|min_length[6]|max_length[40]|valid_email|is_unique[suscriptores.sus_email]'
    );

    $this->form_validation->set_rules(
      'celular',
      'Celular',
      'trim|stripslashes|required|numeric|min_length[10]|max_length[16]'
    );


    // seteado de mensajes de error
    $this->form_validation->set_message('required', 'El campo {field} es requerido.');
    $this->form_validation->set_message('matches', 'Las contraseñas no coinciden.');
    $this->form_validation->set_message('valid_email', 'El campo {field} debe contener un correo válido');
    $this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres de longitud.');
    $this->form_validation->set_message('max_length', 'El campo {field} no puede exceder los {param} caracteres de longitud.');
    $this->form_validation->set_message('is_unique', 'La dirección de correo electrónico ya existe.');
    $this->form_validation->set_message('numeric', 'El número de celular no contiene caracteres válidos');

    /*en caso de validación exitosa*/
    if ($this->form_validation->run() == TRUE) {

      /*recolectando los datos del usuario*/
      $datos_suscriptor =
      array(
        'sus_nombres' => $this->input->post('nombres'),
        'sus_apellidos' => $this->input->post('apellidos'),
        'sus_email' => $this->input->post('email'),
        'sus_celular' => $this->input->post('celular'),
        'sus_fecha' => hoy('c')
      );

      /*almacenamiento de datos del suscriptor*/
    	$this->load->model('admin/suscriptores_model');

      $this->suscriptores_model->almacenar_mdl($datos_suscriptor);

      $datos_suscriptor_alm = $this->suscriptores_model->obtener_datos($datos_suscriptor);
      $datos_sus = $datos_suscriptor_alm[0];
      $sus_id = $datos_sus['id'];

      /*almacenamiento en tabla rel_sus_evento*/

    	$this->load->model('admin/sus_eventos_model');

    	if (null !== $this->input->post('colabora')) {
    		$rse_colabora = 's';
    	} else {
    		$rse_colabora = 'n';
    	}

    	$data_eve = array(
    		'sus_id' => $sus_id,
    		'eve_id' => $this->input->post('eve_id'),
    		'rse_fecha' => hoy('c'),
    		'rse_colabora' => $rse_colabora
    	);

    	if (null !== $this->input->post('confirmado')) {
    		$data_eve['rse_confirmado'] = $this->input->post('confirmado');
    	}

      $this->sus_eventos_model->almacenar_mdl($data_eve);

      /*almacenamiento en tabla rel_sus_tema*/

    	$this->load->model('admin/sus_temas_model');

    	$data_tem = array(
    		'sus_id' => $sus_id,
    		'tem_id' => $this->input->post('tem_id')
    	);

      $this->sus_temas_model->almacenar_mdl($data_tem);

      /*envío del correo*/
      // $this->enviaremail($data_eve['eve_id'], $datos_sus);

      /*salida json*/
      $this->output->set_output(json_encode([
        'success' => 1,
        'errores' => $this->form_validation->error_array(),
        'urlBase' => base_url()
      ]));


    } else {
      /*salida json fallida*/
      $this->output->set_output(json_encode([
      	'success' => 0,
        'errores' => $this->form_validation->error_array(),
        'urlBase' => base_url()
      ]));
    }
  }

  // ------------------------------------------------------------------------

	public function enviaremail($eve_id, $datos_sus)
	{
    // cargo los modelos eventos, suscriptores servidores
    $this->load->model('admin/servidores_model', 'servidores');
    $this->load->model('admin/eventos_model', 'eventos');

    // datos del evento
    $datos_evento = $this->eventos->datos_evento($eve_id);

    // datos del servidor smtp
    $servidor_smtp = $this->servidores->obtener_datos(10);

    /*cargo la librería PHPMailer*/
    $this->load->library('My_PHPMailer');

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isMail();

    //Habilita depuración SMTP
    // 0 = off (producción)
    // 1 = mensajes cliente
    // 2 = mensajes servidor y cliente
    $mail->SMTPDebug = 2;

    //Set the hostname of the mail server
    $mail->Host = $servidor_smtp['con_smtp_host'];

    //puerto SMTP puede ser 25, 465 o 587
    $mail->Port = $servidor_smtp['con_smtp_port'];

    //si se usa autenticación SMTP
    $mail->SMTPAuth = $servidor_smtp['con_smtp_auth'];

    //usuario para autenticación SMTP
    $mail->Username = $servidor_smtp['con_smtp_user'];

    //contraseña para autenticación SMTP
    $mail->Password = $servidor_smtp['con_smtp_pass'];

    //remitente
    $mail->setFrom($servidor_smtp['con_smtp_from'], 'Mercurio 2.0');

    //destinatario
    $mail->addAddress($datos_sus['sus_email'], $datos_sus['sus_nombres']);

    //subject
    $mail->Subject = 'Información '.$datos_evento['eve_titulo'];

    $nombres_exploded = explode(' ', $datos_sus['sus_nombres']);
    $nombre = $nombres_exploded[0];

    /*construcción del body del email*/
    $data = array(
      'titulo' => $datos_evento['eve_titulo'], 
      'nombre' => $nombre, 
      'horarios' => $datos_evento['eve_fechasHorarios'], 
      'costo' => $datos_evento['eve_costo']
    );
    $correo = $this->load->view('correo', $data, TRUE);
    $mail->msgHTML($correo);
    $mail->isHTML(true);

    // Attachment de hoja de reserva de cupo
    $mail->addAttachment('files/HOJA DE RESERVA DE CUPO.xlsx');
    $mail->SMTPSecure = $servidor_smtp['con_smtp_sec'];

    $mail->send();

	}

}
