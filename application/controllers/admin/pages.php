<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {
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
        $this->load->helper('text');
        $this->asset['js'] = "<script src=".URL."assets/admin/js/pages.js></script>";
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
        $joinData = array('users' => 'users.userId = pages.createdBy ');
        $data['userData'] = $this->logicalexpert_model->getAllData('pages','',$joinData,'',$perPage,$offset);
        // create pagination links
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'pages';
        $data['heading'] = 'Pages';
        $this->load->view('admin/contentListing' , $data);
    }
    /*
     * add categories
     */
    public function add(){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $viewData['submitButton'] = 'Save';
        $viewData['formUrl'] = 'pages/add';
        $viewData['tinyMiceJs'] = "<script src=".URL."assets/admin/js/ckeditor.js></script>";
        $viewData['heading'] = "Add Pages";
        if($this->input->post()){
            $validationError = $this->formValidations(1);
            if($validationError == FALSE){
                $this->load->view('admin/addPages' , $viewData);
            }
            else{
                $data = $this->input->post();
                $data['lastUpdated'] =  date("Y-m-d");
                $data['createdBy'] = $this->session->userdata('logged_in')[0]['userId'];
                $ret = $this->logicalexpert_model->insertData('pages' ,$data);
                if($ret){
                    // update notifications table
                    $this->load->helper('date');
                    $datestring = "%Y-%m-%d %h:%i:%a";
                    $time = time();
                    $notData = array('notUserId' => $data['createdBy'] , 'notSlug' => 'pages/'.$data['handle'] , 'notDisplayId' => $ret , 'notType' => 'page' , 'notDate' => mdate($datestring, $time) , 'notStatus' => 0 );
                    $this->logicalexpert_model->insertData('notifications' ,$notData);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Page has been created Successfully!</div>');
                }
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'pages');
            }
        }
        else{
            $this->load->view('admin/addPages' , $viewData);
        }
    }
    /*
     * Edit categories
     */
    public function edit($cid = ''){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        // check for the id in the url
        if($cid == '')redirect (ADMIN_URL.'pages');
        // get posted data in form
        $data = $this->input->post();
        $whereCondition = array('pageId' => $cid);
        $return = $this->logicalexpert_model->getSingleData('pages', $whereCondition );
        // if no data found , redirect to listing
        if($return == '' || empty($return))redirect(ADMIN_URL.'pages');
        // setting variables for view
        $viewData['result'] = $return[0];
        $viewData['formUrl'] = 'pages/edit/'.$viewData['result']['pageId'];
        $viewData['submitButton'] = 'Update';
        $viewData['heading'] = "Edit Page";
        $handleChk = ($viewData['result']['handle'] == $data['handle']) ? 0 : 1;
        $validationError = $this->formValidations($handleChk);
            if($validationError == FALSE){
                $this->load->view('admin/addPages' , $viewData);
            }
            else{
                $data['lastUpdated'] =  date("Y-m-d");
                $ret = $this->logicalexpert_model->updateData('pages' ,$data ,$whereCondition);
                if(!empty($ret))
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Page has been Updated Successfully!</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'pages');
        }        
    }
    /*
     * Single category view
     */
    public function view($cid = ''){
        $whereCondition = array('pageId' => $cid);
        $joinData = array('users' => 'users.userId = pages.createdBy ');
        $return = $this->logicalexpert_model->getSingleData('pages', $whereCondition ,'', $joinData );
        if($return == '' || empty($return)){
            echo "No Data Found";
            exit();
        }
        $viewData['data'] = $return[0] ;
        echo $this->load->view('admin/pageDetail', $viewData , TRUE);
        exit();
    }
    
    /*
     * Delete single category
     */
    public function delete($uid = '') {
        if($uid != ''){
            $deleteCheck = $this->logicalexpert_model->deleteData('pages' , 'pageId' , $uid);
            if($deleteCheck)
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Page has been Deleted Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Page not found</div>');
       }
       redirect(ADMIN_URL.'pages');
    }
    /*
     * Delete multiple categories
     */
    public function multipleDelete(){
        $postData = $this->input->post('deleteId');
        $this->logicalexpert_model->deleteMultiple('pages' , 'pageId' , json_decode($postData));
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
        $joinData = array('users' => 'users.userId = pages.createdBy ');
        $data['userData'] = $this->logicalexpert_model->getAllData('pages','',$joinData,'',$perPage,$offset ,$sortData);
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'pages';
        // get the view of the page
        echo $this->load->view('admin/pagesTable' , $data , TRUE);
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
        $config['base_url'] = base_url().'admin/pages/ajaxCall';
        $config['total_rows'] = $this->logicalexpert_model->countRows('pages');
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
     * $validatehandle : whether to validate handle
     */
    public function formValidations($validateHandle = 0){
        $isUniqueHandle = ($validateHandle == 1) ? '|is_unique[pages.handle]' : '';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Page Title', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('handle', 'Page Handle', 'trim|required|max_length[50]'.$isUniqueHandle);
        $this->form_validation->set_rules('content', 'Page Content', 'trim');
        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        return TRUE;
    }
    /*
     * enable/disable pages
     */
    public function changeStatus(){
        $id = $this->input->post('columnId');
        $status = $this->input->post('status');
        $newStatus = ($status == 'enabled') ? 0 : 1; 
        $data = array('status' => $newStatus);
        echo $ret = $this->logicalexpert_model->updateData('pages' ,$data , 'pageId' ,$id);
        exit();
    }
}