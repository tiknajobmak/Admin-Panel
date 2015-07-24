<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load libraries , view , helper
        $this->load->helper('url');
        $this->load->library('session');        
        // if session not set , redirect to admin login page
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Permission Denied!</div>');
            redirect(URL.'adminLogin');   
        }
        $this->load->helper(array('form'));
        $this->load->model('logicalexpert_model');
        $this->asset['js'] = "<script src=".URL."assets/admin/js/categories.js></script>";
    }
    /*
     * categories listing page
     */   
    public function index(){
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        // returns number of pages per page
        $perPage = $this->paginationInitialize();
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $joinData = array('users' => 'users.userId = categories.createdBy ');
        $data['userData'] = $this->logicalexpert_model->getAllData('categories','',$joinData,'',$perPage,$offset);
        // create pagination links
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'categories';
        $data['heading'] = 'Categories';
        $this->load->view('admin/contentListing' , $data);
    }
    /*
     * add categories
     */
    public function add(){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $viewData['submitButton'] = 'Save';
        $viewData['formUrl'] = 'categories/add';
        $viewData['heading'] = "Add Category";
        if($this->input->post()){
            $validationError = $this->formValidations();
            if($validationError == FALSE){
                $this->load->view('admin/addCategory' , $viewData);
            }
            else{
                $data = $this->input->post();
                $data['createdBy'] = $this->session->userdata('logged_in')[0]['userId'];
                $ret = $this->logicalexpert_model->insertData('categories' ,$data);
                if($ret)
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Category has been Saved Successfully!</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'categories');
            }
        }
        else{
            $this->load->view('admin/addCategory' , $viewData);
        }
    }
    /*
     * Edit categories
     */
    public function edit($cid = ''){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        // check for the id in the url
        if($cid == '')redirect (ADMIN_URL.'categories');
        // get posted data in form
        $data = $this->input->post();
        $whereCondition = array('categoryId' => $cid);
        $return = $this->logicalexpert_model->getSingleData('categories', $whereCondition );
        // if no data found , redirect to listing
        if($return == '' || empty($return))redirect(ADMIN_URL.'categories');
        // setting variables for view
        $viewData['result'] = $return[0];
        $viewData['formUrl'] = 'categories/edit/'.$viewData['result']['categoryId'];
        $viewData['submitButton'] = 'Update';
        $viewData['heading'] = "Edit Category";
        $validationError = $this->formValidations();
            if($validationError == FALSE){
                $this->load->view('admin/addCategory' , $viewData);
            }
            else{
                $ret = $this->logicalexpert_model->updateData('categories' ,$data ,$whereCondition);
                if(!empty($ret))
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Category has been Updated Successfully!</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'categories');
        }        
    }
    /*
     * Single category view
     */
    public function view($cid = ''){
        $whereCondition = array('categoryId' => $cid);
        $joinData = array('users' => 'users.userId = categories.createdBy ');
        $return = $this->logicalexpert_model->getSingleData('categories', $whereCondition ,'', $joinData );
        if($return == '' || empty($return)){
            echo "No Data Found";
            exit();
        }
        $viewData['data'] = $return[0] ;
        echo $this->load->view('admin/categoryDetail', $viewData , TRUE);
        exit();
    }
    
    /*
     * Delete single category
     */
    public function delete($uid = '') {
        if($uid != ''){
            $deleteCheck = $this->logicalexpert_model->deleteData('categories' , 'categoryId' , $uid);
            if($deleteCheck)
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Category has been Deleted Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Category not found</div>');
       }
       redirect(ADMIN_URL.'categories');
    }
    /*
     * Delete multiple categories
     */
    public function multipleDelete(){
        $postData = $this->input->post('deleteId');
        $this->logicalexpert_model->deleteMultiple('categories' , 'categoryId' , json_decode($postData));
        $this->ajaxCall();
        exit;
    }
    /*
     * Call on any ajax call
     * Return : view of the page along with pagination
     */
    public function ajaxCall()
    {
        $perPage = ($this->input->post('perPage')) ? $this->input->post('perPage') : $this->session->userdata('perPage' );
        $sortData['sortCol'] = ($this->input->post('sortcolumn')) ? $this->input->post('sortcolumn') : '';
        $sortData['orderBy'] = ($this->input->post('orderby')) ? $this->input->post('orderby') : '';
        $this->session->set_userdata('perPage' , $perPage );
        $perPage = $this->paginationInitialize();
        if($this->uri->segment(4)) 
            $offset = $this->uri->segment(4);
        else
            $offset = 0;
        $this->session->set_userdata('pageNumber' , $offset );
        $sortData = ($sortData['sortCol'] != '') ? $sortData : '';
        $joinData = array('users' => 'users.userId = categories.createdBy ');
        $data['userData'] = $this->logicalexpert_model->getAllData('categories','',$joinData,'',$perPage,$offset ,$sortData);
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'categories';
        // get the view of the page
        echo $this->load->view('admin/categoriesTable' , $data , TRUE);
        exit;
    }
    /*
     * function used to initilize the pagination
     * @param :- $perpage : no of records per page
     */
    public function paginationInitialize($perPage = 2){
        // pagination start
        $this->load->library('pagination');
        $perPage = ($this->session->userdata('perPage')) ? $this->session->userdata('perPage') : $perPage ;
        $config = array();
        $config['base_url'] = base_url().'admin/categories/ajaxCall';
        $config['total_rows'] = $this->logicalexpert_model->countRows('categories');
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
        $config['last_link'] = '<span class="lastLink">Last ›</span>';
        $config['first_link'] = '<span class="firstLink">‹ First</span>';
        $config['next_link'] = '<span class="nextLink">&gt;</span>';
        $config['prev_link'] = '<span class="prevLink">&lt;</span>';
        $this->pagination->initialize($config);
        return $perPage;
        // pagination End
    }
    
    /*
     * function used to set validations
     * @param :- $updateCheck : check update or save
     * $validateUserName : whether to validate user name
     * $validateEmail : whether to validate email
     */
    public function formValidations(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('categoryName', 'Category Name', 'trim|required|max_length[50]');
        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        return TRUE;
    }
}