<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Welcome extends REST_Controller {

	    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php

        $this->response([
            'status' => TRUE,
            'message' => APPPATH,
            'url' => $_SERVER['SERVER_NAME'],
            'request' => $_SERVER['REQUEST_URI'],
            'address' => $_SERVER['SERVER_ADDR']

            ],REST_Controller::HTTP_OK);

    }

	public function index_get()
	{
		$this->response('data',200);
	}
}
