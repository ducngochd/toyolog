<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
/**
* 
*/
class Api extends REST_Controller
{
	
	function __construct()
	{

		parent::__construct();
	}
	public function test_get()
	{
		$this->response([
			'status'  => TRUE,
			'message' => 'Test push api'

		],REST_Controller::HTTP_OK);
	}
}