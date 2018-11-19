<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Categories extends BaseController {

	public function __construct() {
		parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('categories_model');
	}

	public function index()
	{
		$this->global['pageTitle'] = 'CodeInsect : Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
	}

	public function subCategoriesListing()
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
            
            $count = $this->categories_model->subCategoriesListingCount($searchText);

            $returns = $this->paginationCompress ( "subCategoriesListing/", $count, 10 );
            
            $data['userRecords'] = $this->categories_model->subCategoriesListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Listing';

            // var_dump($data);
            
            $this->loadViews("subCategoriesListing", $this->global, $data, NULL);
        }
	}
	public function addSubCategories() {
		if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('restaurant_model');
            $count = $this->restaurant_model->categoriesListingCount();
			$data['userRecords'] = $this->restaurant_model->categoriesListing('',NULL, NULL);            
            $this->global['pageTitle'] = 'MVL Inc.';

            $this->loadViews("addSubCategories", $this->global, $data, NULL);
        }
	}

	public function addNewSubCategories()
	{
		if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');

            if($this->form_validation->run() == FALSE)
            {
                $this->addSubCategories();
            }
            else
            {
            	$categoriesId = $this->input->post('role');
                $subCategories = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $userInfo = array(
                	'categoriesId'	=>	$categoriesId,
                	'subCategories'	=>	$subCategories
                );
                
                $result = $this->categories_model->addNewSubCategories($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', '新しいサブカテゴリが作成されました');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addSubCategories');
            }
        }
	}

	public function editSubCategories($subCategorId = '')
	{
	if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($subCategorId == null)
            {
                redirect('subCategoriesListing');
            }

            $this->load->model('restaurant_model');
            $count = $this->restaurant_model->categoriesListingCount();
			$userRecords = $this->restaurant_model->categoriesListing('',NULL, NULL);            

            $subCategoriesInfo = $this->categories_model->getSubCategoryInfo($subCategorId);

            $data = array(
            	'userRecords' => $userRecords,
            	'subCategoriesInfo' => $subCategoriesInfo
            	);
            
            $this->global['pageTitle'] = 'CodeInsect : Edit User';
            $this->loadViews("editSubCategories", $this->global, $data, NULL);
        }
	}

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */