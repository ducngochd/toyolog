<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Restaurant extends BaseController
{   
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('restaurant_model');
        $config['encrypt_name'] = TRUE;
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG|HEIC';
                $config['max_size']  = '10240000000';
                $config['quality'] = 50;
                $config['max_width']  = '10240000';
                $config['max_height']  = '7680000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
        $this->isLoggedIn();  
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function addRestaurant() {

        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role','Role','trim|required|numeric');
                $this->form_validation->set_rules('price','Price','trim|required|numeric');

        $this->form_validation->set_rules('type','Type','trim|required|numeric');



        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else {
            $this->global['pageTitle'] = 'CodeInsect : Add New User';
            // $data['city'] = $GLOBALS['pref'];
            // $data['price'] = array(
            //     '1000'=>'1000円',
            //     '2000'=>'2000円',
            //     '3000'=>'3000円',
            //     '4000'=>'4000円',
            //     '5000'=>'5000円',
            //     '6000'=>'6000円',
            //     '7000'=>'7000円',
            //     '8000'=>'8000円',
            //     '9000'=>'9000円',
            //     '10000'=>'10000円',
            //     '12000'=>'12000円',
            //     '15000'=>'15000円',
            //     '20000'=>'20000円',
            //     '25000'=>'25000円',
            //     '30000'=>'30000円',
            //     '35000'=>'35000円',
            //     '40000'=>'40000円',
            //     '45000'=>'45000円',
            //     '50000'=>'50000円',

            // );
            $this->load->model('restaurant_model');
            $this->load->model('categories_model');
            $type = $this->restaurant_model->getSituation();
            $categories = $this->restaurant_model->categoriesListing('',NULL, NULL);    
            $subCategories = $this->categories_model->subCategoriesListing('', NULL, NULL);

            $data = array(
                'type' => $type,
                'categories' => $categories,
                'subCategories' => $subCategories,
                'city'          => $GLOBALS['pref']
             );
            $this->loadViews("addRestaurant", $this->global, $data, NULL);        
        }
    }

    public function listRestaurant() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->restaurant_model->restaurantListingCount($searchText);

			$returns = $this->paginationCompress ( "listRestaurant/", $count, 10 );
            
            $data['userRecords'] = $this->restaurant_model->restaurantListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("listRestaurant", $this->global, $data, NULL);   
        }    
    }

    public function addSituation() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'MVL Inc.';

            $this->loadViews("addSituation", $this->global, $data, NULL);
        }
    }

    public function addNewSituation() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            if($this->form_validation->run() == FALSE)
            {
                $this->addSituation();
            }
            else
            {
                $situation = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                
                $userInfo = array('situation'=>$situation);
                
                $this->load->model('restaurant_model');
                $result = $this->restaurant_model->addNewSituation($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', '新しいシチュエーションーが作成されました');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addSituation');
            }
        }
    }

    function editSituation($situationId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($situationId == null)
            {
                redirect('listRestaurant');
            }
            
            $data['situationInfo'] = $this->restaurant_model->getSituationInfo($situationId);
            
            $this->global['pageTitle'] = 'CodeInsect : Edit User';
            
            $this->loadViews("editSituation", $this->global, $data, NULL);
        }
    }
    function editNewSituation()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $situationId = $this->input->post('situationId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            if($this->form_validation->run() == FALSE)
            {
                $this->editSituation($situationId);
            }
            else
            {
                $situation = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $userInfo = array();
                    $situationInfo = array('situation'=>$situation);
  
                $result = $this->restaurant_model->editNewSituation($situationInfo, $situationId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('listRestaurant');
            }
        }
    }
    function deleteSituation()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('situationId');
            // $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->restaurant_model->deleteSituation($userId);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    public function restaurantListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->restaurant_model->getRestaurantListingCount($searchText);

            $returns = $this->paginationCompress ( "restaurantListing/", $count, 10 );
            
            $data['userRecords'] = $this->restaurant_model->getRestaurantListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("restaurantListing", $this->global, $data, NULL);
        }
    }

    public function addNewRestaurant()
    {
                if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {


            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            // $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('password','Password','required|max_length[20]');
            // $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addRestaurant();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $areaId = $this->input->post('role');
                $priceFrom = $this->input->post('price_from');
                $priceTo = $this->input->post('price_to');
                $type = $this->input->post('type');
                $price = $priceFrom."-".$priceTo;
                $comment = $this->security->xss_clean($this->input->post('comment'));
                $imageName = '';
                if (!empty($_FILES['picture']['name'])) { 
                               if ($this->upload->do_upload('picture')){
                                                                   $new_name = time().$_FILES["picture"]['name'];
                                $config['file_name'] = $new_name;
                                $data = array('upload_data' => $this->upload->data());
                                $imageName = $data['upload_data']['file_name'];
                               }else {
                                    $error = array('error' => $this->upload->display_errors());
                                    var_dump($error);
                                    exit();
                                }
                     

                }
                $restaurant = array(
                    'name'  =>$name, 
                    'area'  =>$areaId, 
                    'price_from' => $priceFrom,
                    'price_to' => $priceTo,
                    'situation' => $type,
                    'image' => (empty($imageName))? '':$imageName,
                    'comment' => $comment,
                    'isDeleted' => 0,
                    'created_by' => $this->vendorId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->vendorId,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                var_dump($restaurant);
                $this->load->model('restaurant_model');
                $result = $this->restaurant_model->addNewRestaurant($restaurant);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Restaurant created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNewRestaurant');
            }
        }
    }

    public function categoritesListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->restaurant_model->categoriesListingCount($searchText);

            $returns = $this->paginationCompress ( "categoriesListing/", $count, 10 );
            
            $data['userRecords'] = $this->restaurant_model->categoriesListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("categoriesListring", $this->global, $data, NULL);
        }
    }
    public function addCategories()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'MVL Inc.';

            $this->loadViews("addCategories", $this->global, $data, NULL);
        }
    }

    public function addNewCategories() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            if($this->form_validation->run() == FALSE)
            {
                $this->addSituation();
            }
            else
            {
                $categories = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                
                $userInfo = array('category'=>$categories);
                
                $this->load->model('restaurant_model');
                $result = $this->restaurant_model->addNewCategory($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', '新しいカテゴリーが作成されました');
                }
                else
                {
                    $this->session->set_flashdata('error', 'カテゴリー creation failed');
                }
                
                redirect('categoritesListing');
            }
        }
    }
    function editCategories($categorId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($categorId == null)
            {
                redirect('categoritesListing');
            }
            
            $data['situationInfo'] = $this->restaurant_model->getCategoryInfo($categorId);
            
            $this->global['pageTitle'] = 'CodeInsect : Edit User';
            
            $this->loadViews("editCategories", $this->global, $data, NULL);
        }
    }
    function editNewCategories()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $situationId = $this->input->post('categoryId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            if($this->form_validation->run() == FALSE)
            {
                $this->editSituation($situationId);
            }
            else
            {
                $situation = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $userInfo = array();
                    $situationInfo = array('category'=>$situation);
  
                $result = $this->restaurant_model->editNewCategories($situationInfo, $situationId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('categoritesListing');
            }
        }
    }
    // function deleteSituation()
    // {
    //     if($this->isAdmin() == TRUE)
    //     {
    //         echo(json_encode(array('status'=>'access')));
    //     }
    //     else
    //     {
    //         $userId = $this->input->post('situationId');
    //         // $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
    //         $result = $this->restaurant_model->deleteSituation($userId);
            
    //         if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
    //         else { echo(json_encode(array('status'=>FALSE))); }
    //     }
    // }

    
}
?>