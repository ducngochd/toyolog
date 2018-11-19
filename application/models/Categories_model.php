<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

	public function subCategoriesListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.subCategories  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function subCategoriesListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategories as BaseTbl');
        $this->db->join('tbl_categories as Categories', 'Categories.id = BaseTbl.categoriesId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.subCategories  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getSituation()
    {
        $this->db->select('situationId, situation');
        $this->db->from('tbl_situation');
        // $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
    function addNewSubCategories($category)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_subcategories', $category);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    public function getSubCategoryInfo($subCategoriesId='')
    {
    	$this->db->select('*');
        $this->db->from('tbl_subcategories');
        $this->db->where('id', $subCategoriesId);
        $query = $this->db->get();
        
        return $query->row();
    }

}

/* End of file Categories_model.php */
/* Location: ./application/models/Categories_model.php */