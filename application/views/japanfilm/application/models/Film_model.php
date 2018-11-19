<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/models/MY_Model.php';

/**
 * 
 */
class Film_model extends MY_Model
{
	
	// protected $_table = 'film';
	// protected $primary_key = 'id';
 //    protected $return_type = 'array'; 
        private $film_part = 'film_part';

    public function get_film($id)
    {

    	if (empty($id)) {
    		$query = $this->_database->query('select * from film');
    		return $query->result_array();
    	}else {
	        $query = $this->_database->query("select * from film_part where id_film = ?",$id);
	        $results = $query->result_array();
			return  $results;
    	}

    }

    public function put_count_viewed($part_id)
    {
        $query = $this->_database->query('select viewed from film_part where id = ?',$part_id);
        $count_view = $query->result_array(); 
        $count_view[0]['viewed'] = $count_view[0]['viewed'] + 1;
        $this->_database->where('id',$part_id);
        $this->_database->update('film_part',$count_view[0]);

    }



}

?>