<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

/**
 * 
 */
class Film extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Film_model');
	}

	public function film_get($value='')
	{
		$key = $this->get('film_id');
		$data = $this->Film_model->get_film($key);
		foreach ($data as $key => $value) {
			$count = $this->Film_model->get_film($data[$key]['id']);
			$temp = array('count' => count($count));
			$value = $value + $temp;
			$data[$key] = $value;
		}

		if (!is_null($data)) {
			$this->response([
				'status'  => TRUE,
				'message' => 'Tìm thấy film',
				'data'	  => $data
			],REST_Controller::HTTP_OK);
		}else {
			$this->response([
				'status' 	=> FALSE,
				'message' 	=> 'Không tìm thấy film',
				'data'		=> '' 
			],REST_Controller::HTTP_OK);
		}
	}

	public function count_view_put($value='')
	{
		$key = $this->put('part_id');
		$viewed = $this->Film_model->put_count_viewed($key);
		$this->response([
			'status'	=> FALSE,
			'message'	=> 'OK',
			'data'		=> $viewed
		],REST_Controller::HTTP_OK);
	}
}

?>