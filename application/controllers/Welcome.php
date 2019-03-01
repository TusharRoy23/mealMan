<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('meal_template');
		$this->load->view('common/footer');
	}

}
