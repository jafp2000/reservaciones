<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Rest extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('rest_model'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
	}

	/******** WEBSERVICES TIPO DE HABITACIONES ********/

	public function listaHab_post(){
		$data = $this->rest_model->readAll('room_types');
		if (count($data) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
			   'status' => FALSE,
				'message' => 'No se han encontrado datos',
				'data' => array(),
			], REST_Controller::HTTP_OK);
		}
	}

	public function sendHab_post(){
		$this->form_validation->set_rules('inputNombre', 'Nombre', 'required|trim|max_length[100]');
		if ($this->post('formType') == 'add') {
			$this->form_validation->set_rules('inputCodigo', 'Codigo', 'required|trim|max_length[10]|is_unique[room_types.short_name]');
		}
		$this->form_validation->set_rules('inputPrecio', 'Precio', 'required|trim|numeric|less_than[1000000]');
		$this->form_validation->set_rules('inputDisponibilidad', 'Disponibilidad', 'required|trim|integer|less_than[100000000000]');
		$this->form_validation->set_rules('inputMax', 'Max. Ocupantes', 'required|trim|integer|less_than[100000000000]');
		$this->form_validation->set_rules('inputDescripcion', 'Descripción', 'required|trim');
		$this->form_validation->set_rules('inputTerminos', 'Términos y Condiciones', 'required|trim');
		if ($this->post('formType') == 'add') {
		    $this->form_validation->set_rules('base64Imagen1', 'Imagen Principal', 'required|trim');
		}

		if($this->form_validation->run() == FALSE) {
			$this->response([
				'status' => FALSE,
				'message' => $this->form_validation->error_string()
			], REST_Controller::HTTP_OK);
		} else {

			$data = array(
				'name' => $this->post('inputNombre'),
				'short_name' => $this->post('inputCodigo'),
				'base_price' => $this->post('inputPrecio'),
				'base_availability' => $this->post('inputDisponibilidad'),
				'max_occupancy' => $this->post('inputMax'),
				'description' => $this->post('inputDescripcion'),
				'terms' => $this->post('inputTerminos'),
				'updated_at' => date('Y-m-d H:m:i'),
				);

            $carpeta_rooms = getcwd().'/assets/uploads/rooms/';

            if(!is_dir($carpeta_rooms))
                mkdir($carpeta_rooms,0777,true);

			$imagen = 1;
			for ($i=1; $i < 7 ; $i++) { 
				if ($this->post('formType') == 'add') { $inputImagen = 'base64Imagen'.$i;}
				else if ($this->post('formType') == 'edit') { $inputImagen = 'base64Imagen'.$i.'Edit';}

				if (!empty($this->post($inputImagen))){
	                $str_seteado = explode(',', $this->post($inputImagen));
	                $imagen_str = base64_decode($str_seteado[1]);
	                $targetFile = $carpeta_rooms . $this->post('inputCodigo') . '_' . $imagen . '.jpg' ;

	                file_put_contents($targetFile, $imagen_str);
	                if ($i == 1){
	                	$existe_main = 'S';
	                	$nombre_main = $this->post('inputCodigo') . '_' . $imagen . '.jpg';
	                }
	            	if ($this->post('formType') == 'add') { $imagen++; }
	            }

	            if ($this->post('formType') == 'edit') { $imagen++; }
			}

			if ($this->post('formType') == 'add') {
				$data += array(
					'created_at' => date('Y-m-d H:m:i'),
					'main_picture' => $nombre_main,
				);
				$query = $this->rest_model->insert('room_types', $data);
				$mensaje = 'Agregada';
			} else if ($this->post('formType') == 'edit') {
				if (isset($existe_main)) {
					$data += array(
						'main_picture' => $nombre_main,
					);
				}
				$query = $this->rest_model->update('room_types', $this->post('idHab'), $data);
				$mensaje = 'Actualizada';
			}

			if ($query) {
				$this->response([
					'status' => TRUE,
					'message' => 'Tipo de Habitación '.$mensaje.' Exitosamente!'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Error en el registro, intente de nuevo'
				], REST_Controller::HTTP_OK);
			}
		}
	}

	public function readHab_post() {
		$query = $this->rest_model->read('room_types', $this->post('id'));
		if (count($query) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'Habitación Encontrada!',
				'data' => $query
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'No se encontró ninguna Habitación'
			], REST_Controller::HTTP_OK);
		}
	}

	public function deleteHab_post() {
		$data = array(
			'deleted' => 1,
			'updated_at' => date('Y-m-d H:m:i'),
			);
		$query = $this->rest_model->update('room_types', $this->post('id'), $data);
		if ($query) {
			$this->response([
				'status' => TRUE,
				'message' => 'Habitación Eliminada!'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Error en el registro, intente de nuevo'
			], REST_Controller::HTTP_OK);
		}
	}

	public function buscarTarifasHab_post() {
		$query = $this->rest_model->searchCalendarMaster($this->post('id'));
		if (count($query) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'Datos Encontrados!',
				'data' => $query
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'No se Encontró Ningún Dato',
				'data' => array(),
			], REST_Controller::HTTP_OK);
		}
	}

	public function sendRate_post(){
		$this->form_validation->set_rules('inputType', 'Tipo de Habitación', 'required|trim');
		$this->form_validation->set_rules('inputFechaDesde', 'Fecha Desde', 'required|trim');
		$this->form_validation->set_rules('inputFechaHasta', 'Fecha Hasta', 'required|trim');
		$this->form_validation->set_rules('inputPrecio', 'Precio', 'required|trim|numeric|less_than[1000000]');

		if($this->form_validation->run() == FALSE) {
			$this->response([
				'status' => FALSE,
				'message' => $this->form_validation->error_string()
			], REST_Controller::HTTP_OK);
		} else if($this->post('formType') == 'add' && $this->rest_model->verifyDatesRate($this->post('inputType'), $this->post('inputFechaDesde'), $this->post('inputFechaHasta')) > 0) {
			$this->response([
				'status' => FALSE,
				'message' => 'Las Tarifas para Estas Fechas estan Creadas'
			], REST_Controller::HTTP_OK);
		} else {
			$data = array(
				'room_type_id' => $this->post('inputType'),
				'date_from' => $this->post('inputFechaDesde'),
				'date_to' => $this->post('inputFechaHasta'),
				'rate' => $this->post('inputPrecio'),
				'updated_at' => date('Y-m-d H:m:i'),
				);

			if ($this->post('formType') == 'add') {
				$data += array('created_at' => date('Y-m-d H:m:i'),);
				$query = $this->rest_model->insertRate($data);
				$mensaje = 'Agregada';
			} else if ($this->post('formType') == 'edit') {
				$query = $this->rest_model->updateRate($this->post('idRate'), $data);
				$mensaje = 'Actualizada';
			}

			if ($query > 0 || $query) {
				$this->response([
					'status' => TRUE,
					'message' => 'Tarifa '.$mensaje.' Exitosamente!'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Error en el registro, intente de nuevo'
				], REST_Controller::HTTP_OK);
			}
		}
	}

	public function readRate_post() {
		$query = $this->rest_model->read('room_calendars_master', $this->post('id'));
		if (count($query) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'Tarifa Encontrada!',
				'data' => $query
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'No se encontró ninguna Tarifa'
			], REST_Controller::HTTP_OK);
		}
	}

	public function deleteRate_post() {
		$data = array(
			'deleted' => 1,
			'updated_at' => date('Y-m-d H:m:i'),
			);
		$query = $this->rest_model->deleteRate($this->post('id'), $data);
		if ($query) {
			$this->response([
				'status' => TRUE,
				'message' => 'Tarifa Eliminada!'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Error en el registro, intente de nuevo'
			], REST_Controller::HTTP_OK);
		}
	}

	public function searchAvailability_post() {
		$start_dt = $this->post('fecha_ingreso_input');
		$end_dt = $this->post('fecha_salida_input');
		$min_occupancy = $this->post('personas');
		$room_types = $this->rest_model->selectAllRoomTypes($min_occupancy, $start_dt, $end_dt);

		if(count($room_types) != 0) {
			$data['room_list'] = $room_types;
			$this->load->view('pages/room_card.php', $data);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'No hay habitaciones disponibles.'
			], REST_Controller::HTTP_OK);
		}
	}

	public function makeReservation_post() {
		$room_id = $this->post('room_id');
		$room_types = $this->rest_model->selectRoomById($room_id);

		$data = array();
		$data['fecha_ingreso'] = $this->post('fecha_ingreso_input');
		$data['fecha_salida'] = $this->post('fecha_salida_input');
		$data['ocupantes'] = $this->post('personas');
		$data['nombre_habitacion'] = $room_types->name;
		$data['terms'] = $room_types->terms;
		$data['description'] = $room_types->description;
		$data['room_id'] = $room_types->id;

		$fecha_ingreso = new DateTime($this->post('fecha_ingreso_input'));
		$fecha_salida = new DateTime($this->post('fecha_salida_input'));
		$intervalo = $fecha_ingreso->diff($fecha_salida);
		$data['noches'] = $intervalo->days;

		$search_tarifa = $this->rest_model->searchTarifa($room_types->id, $this->post('fecha_ingreso_input'), $this->post('fecha_salida_input'));

		$fecha_inicial = $this->post('fecha_ingreso_input');
		$fecha_fin = date("Y-m-d", strtotime("-1 day", strtotime($this->post('fecha_salida_input'))));

		while (strtotime($fecha_inicial) <= strtotime($fecha_fin)){
			if (empty($search_tarifa[$fecha_inicial])){
				$search_tarifa[$fecha_inicial] = $room_types->base_price;
			}
			$fecha_inicial = date("Y-m-d", strtotime("+1 day", strtotime($fecha_inicial)));
		}

		$data['precio_total'] = array_sum($search_tarifa);
		$data['tarifas'] = $search_tarifa;
		$data['codigo'] = $room_types->short_name;
		
		$this->load->view('pages/summary.php', $data);
	}

	public function createReservation_post() {
		$fecha_ingreso = $this->post('fecha_ingreso');
		$fecha_salida = $this->post('fecha_salida');
		$personas = $this->post('personas');
		$room_id = $this->post('room_id');
		$precio_total = $this->post('precio_total');
		$nombre_cliente = $this->post('nombre_cliente');
		$apellido_cliente = $this->post('apellido_cliente');
		$correo_cliente = $this->post('correo_cliente');
		$tipo = $this->post('tipo');
		$tarifas = $this->post('tarifas');

		$cliente = array(
			'first_name' => $nombre_cliente,
			'last_name' => $apellido_cliente,
			'email' => $correo_cliente,
			'created_at' => date('Y-m-d H:m:i'),
			'updated_at' => date('Y-m-d H:m:i')
		);
		$check_customer = $this->rest_model->check_customer($correo_cliente)->num_rows();

		if($check_customer == 0) {
			$create_customer = $this->rest_model->insert('customers', $cliente);
			$customer_id = $this->db->insert_id();
		} else {
			$customer = $this->rest_model->check_customer($correo_cliente)->row();
			$customer_id = $customer->id;
		}

		$reservation = array(
			'total_price' => $precio_total,
			'occupancy' => $personas,
			'checkin' => $fecha_ingreso,
			'checkout' => $fecha_salida,
			'customer_id' => $customer_id,
			'payment_type' => $tipo,
			'created_at' => date('Y-m-d H:m:i'),
			'updated_at' => date('Y-m-d H:m:i')
		);
		$create_reservation = $this->rest_model->create_reservation('reservations', $reservation, $tarifas, $room_id);

		$config = Array(    
		      'protocol' => 'smtp',
		      'smtp_host' => 'ssl://srv12.mihosting.net',
		      'smtp_port' => 465,
		      'smtp_user' => 'info@misahualliamazonlodge.ec',
		      'smtp_pass' => 'P9u0qCnZCCSv',
		      'smtp_timeout' => '4',
		      'mailtype' => 'html',
		      'charset' => 'utf-8',
		      'wordwrap' =>	TRUE,
		    );

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

	    $this->email->from('info@misahualliamazonlodge.ec', 'Misahualli Amazon Lodge');

    	$data = array(
       		'nombre'=> $nombre_cliente,
       		'apellido' => $apellido_cliente,
       		'correo' => $correo_cliente,
       		'nombre_habitacion' => $this->post('nombre_habitacion'),
       		'fecha_entrada' => $fecha_ingreso,
       		'fecha_salida' => $fecha_salida,
       		'huespedes' => $personas,
       		'precio_total' => $precio_total,
       		'tarifas' => json_decode($tarifas, true),
       		'tipo_pago' => 'TRANSFERENCIA',
         );

    	$this->email->to($correo_cliente);
  		$this->email->subject('Información de Reserva - Misahualli Amazon Lodge');

		$body = $this->load->view('pages/email.php',$data,TRUE);
		$this->email->message($body); 
	    $this->email->send();

		if($create_reservation) {
			$this->response([
				'status' => TRUE,
				'message' => 'Reserva realizada con éxito!.',
				'correo' => $correo_cliente,
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Error al crear reservación.'
			], REST_Controller::HTTP_OK);
		}
	}

	public function createReservationPaypal_post() {
		$fecha_ingreso = $this->post('fecha_ingreso');
		$fecha_salida = $this->post('fecha_salida');
		$personas = $this->post('personas');
		$room_id = $this->post('room_id');
		$precio_total = $this->post('precio_total');
		$nombre_cliente = $this->post('nombre_cliente');
		$apellido_cliente = $this->post('apellido_cliente');
		$correo_cliente = $this->post('correo_cliente');
		$nombre_paypal = $this->post('nombre_paypal');
		$apellido_paypal = $this->post('apellido_paypal');
		$correo_paypal = $this->post('correo_paypal');
		$tipo = $this->post('tipo');
		$id_paypal = $this->post('id_paypal');
		$tarifas = $this->post('tarifas');

		if (empty($nombre_cliente)) {$nombre_cliente = $nombre_paypal;}
		if (empty($apellido_cliente)) {$apellido_cliente = $apellido_paypal;}
		if (empty($correo_cliente)) {$correo_cliente = $correo_paypal;}

		$cliente = array(
			'first_name' => $nombre_cliente,
			'last_name' => $apellido_cliente,
			'email' => $correo_cliente,
			'created_at' => date('Y-m-d H:m:i'),
			'updated_at' => date('Y-m-d H:m:i')
		);
		$check_customer = $this->rest_model->check_customer($correo_cliente)->num_rows();

		if($check_customer == 0) {
			$create_customer = $this->rest_model->insert('customers', $cliente);
			$customer_id = $this->db->insert_id();
		} else {
			$customer = $this->rest_model->check_customer($correo_cliente)->row();
			$customer_id = $customer->id;
		}

		$reservation = array(
			'total_price' => $precio_total,
			'occupancy' => $personas,
			'checkin' => $fecha_ingreso,
			'checkout' => $fecha_salida,
			'customer_id' => $customer_id,
			'payment_type' => $tipo,
			'payment_id' => $id_paypal,
			'status' => 1,
			'created_at' => date('Y-m-d H:m:i'),
			'updated_at' => date('Y-m-d H:m:i')
		);
		$create_reservation = $this->rest_model->create_reservation('reservations', $reservation, $tarifas, $room_id);

		$config = Array(    
		      'protocol' => 'smtp',
		      'smtp_host' => 'ssl://srv12.mihosting.net',
		      'smtp_port' => 465,
		      'smtp_user' => 'info@misahualliamazonlodge.ec',
		      'smtp_pass' => 'P9u0qCnZCCSv',
		      'smtp_timeout' => '4',
		      'mailtype' => 'html',
		      'charset' => 'utf-8',
		      'wordwrap' =>	TRUE,
		    );

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

	    $this->email->from('info@misahualliamazonlodge.ec', 'Misahualli Amazon Lodge');

    	$data = array(
       		'nombre'=> $nombre_cliente,
       		'apellido' => $apellido_cliente,
       		'correo' => $correo_cliente,
       		'nombre_habitacion' => $this->post('nombre_habitacion'),
       		'fecha_entrada' => $fecha_ingreso,
       		'fecha_salida' => $fecha_salida,
       		'huespedes' => $personas,
       		'precio_total' => $precio_total,
       		'tarifas' => json_decode($tarifas, true),
       		'tipo_pago' => 'PAYPAL',
       		'id_pago' => $id_paypal,
         );

    	$this->email->to($correo_cliente);
  		$this->email->subject('Información de Reserva - Misahualli Amazon Lodge');

		$body = $this->load->view('pages/email.php',$data,TRUE);
		$this->email->message($body); 
	    $this->email->send();

		if($create_reservation) {
			$this->response([
				'status' => TRUE,
				'message' => 'Reserva Creada con Exito!.'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Error al crear reservación.'
			], REST_Controller::HTTP_OK);
		}
	}

	public function bookedHab_post(){
		$data = $this->rest_model->bookedHab($this->post('fecha'));

		if (count($data) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
			   'status' => FALSE,
				'message' => 'No se han encontrado datos',
				'data' => array(),
			], REST_Controller::HTTP_OK);
		}
	}

	public function availableHab_post(){
		$data = $this->rest_model->availableHab($this->post('fecha'));

		if (count($data) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
			   'status' => FALSE,
				'message' => 'No se han encontrado datos',
				'data' => array(),
			], REST_Controller::HTTP_OK);
		}
	}

	public function costHab_post(){
		$data = $this->rest_model->costHab($this->post('inicio'), $this->post('fin'));

		if (count($data) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
			   'status' => FALSE,
				'message' => 'No se han encontrado datos',
				'data' => array(),
			], REST_Controller::HTTP_OK);
		}
	}
}
