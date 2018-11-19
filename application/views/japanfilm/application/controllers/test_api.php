    <?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Test_api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/
        $this->load->model('restaurant_model');

    }
    public function restaurant_get(){
        $restaurant = $this->restaurant_model->get_all();

        if (!is_null($restaurant)){
            $this->response([
                'status' => TRUE,
                'message' => $restaurant
                ],REST_Controller::HTTP_OK);
        }
    }
    public function find_get()
    {
        $key = $this->get('key');
        $restaurant = $this->restaurant_model->get_many($key);
        $this->response([
            'status' => TRUE,
            'message' => $restaurant
        ],REST_Controller::HTTP_OK);
    }
    public function menu_get(){
        $key = $this->get('restaurant_id');
        $restaurant = $this->restaurant_model->get_menu($key);
        $this->response([
            'status' => TRUE,
            'message' =>$restaurant

        ],REST_Controller::HTTP_OK);
    }



    public function transaction_post(){

        $data = array(
            'status'    => $this->input->post('status'),
            'user_id'   => $this->input->post('user_id'),
            'user_email' => $this->input->post('user_email'),
            'user_name' => $this->input->post('user_name'),
            'user_phone' => $this->input->post('user_phone'),
            'date_ship' => $this->input->post('date_ship'),
            'time_ship' => $this->input->post('time_ship'),
            'amount'    => $this->input->post('amount'),
            'payment'   => $this->input->post('payment'),
            'payment_info'=> $this->input->post('payment_info'),
            'message'   => $this->input->post('message'),
            'created'   => $this->input->post('created')
            );
        $insert_id = $this->restaurant_model->insert_transaction($data);
        $this->response([
                'status' => TRUE,
                'message' => $insert_id
            ],REST_Controller::HTTP_OK);
    }


    public function cart_post(){
        $data = array(
            'restaurantID'      =>  $this->input->post('restaurantID'),
            'transaction_id'    =>  $this->input->post('transaction_id'),
            'ml_id'             =>  $this->input->post('ml_id'),
            'md_id'             =>  $this->input->post('md_id'),
            'numberCount'       =>  $this->input->post('numberCount'),
            'totalPrice'        =>  $this->input->post('totalPrice'),
            'note'              =>  $this->input->post('note'),
            );
        $insert_id = $this->restaurant_model->insert_cart($data);
        $this->response([
            'status' => TRUE,
            'message' => $insert_id
            ],REST_Controller::HTTP_OK);
    }

    public function restaurant_put(){

    }
    public function restaurant_delete(){

    }
    public function users_get()
    {
        // Users from a data store e.g. database
//        $users = [
//            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
//            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
//            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
//        ];


        $id = $this->get('id');
        $restaurant = $this->restaurant_model->get();

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retreival.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $user = $value;
                }
            }
        }

        if (!empty($user))
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
