<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('rest_model');
	}

	public function email(){
		$this->load->view('pages/email.php');
	}
}