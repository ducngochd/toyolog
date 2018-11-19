<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Welcome extends REST_Controller {


	public function test_get()
	{
		$this->load->view('welcome_message');
		$this->response('dkfjkd');
	}
}
