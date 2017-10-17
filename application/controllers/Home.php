<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('rest_model');
	}

	public function index(){

	}

	public function room_type(){
		$this->load->view('pages/room_type.php');
	}

	public function room_price(){
		$rooms = $this->rest_model->readAllOrder('room_types', 'name');
		$data = array('rooms' => $rooms);
		$this->load->view('pages/room_price.php', $data);
	}

	public function reservation(){
		$max_ocup = $this->rest_model->maxOcuppancy();
		$data = array('maximo' => $max_ocup);
		$this->load->view('pages/reservation.php', $data);
	}

	public function booked(){
		$this->load->view('pages/booked.php');
	}

	public function available(){
		$this->load->view('pages/available.php');
	}

	public function cost(){
		$this->load->view('pages/cost.php');
	}

	public function email(){
		$this->load->view('pages/email.php');
	}
}