<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class registerUsers extends CI_Controller {
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
        $this->asset['js'] = "<script src=".URL."assets/admin/js/regUsers.js></script>";
    }
    /*
     * users listing page
     */   
    public function index(){
        // unset the search session
        $this->session->unset_userdata('search');
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        // returns number of pages per page
        $totalRows = $this->logicalexpert_model->countRows('users','userType','user');
        $perPage = $this->paginationInitialize( '' , $totalRows);
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['userData'] = $this->logicalexpert_model->getAllData('users',array('userType' => 'user'),'','',$perPage,$offset);
        // create pagination links
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'registerUsers';
        $data['search'] = 'userFName';
        $data['heading'] = 'Registered Users';
        $this->load->view('admin/contentListing' , $data);
    }
    /*
     * add users
     */
    public function add(){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $viewData['submitButton'] = 'Save';
        $viewData['formUrl'] = 'registerUsers/add';
        $viewData['heading'] = "Add User";
        $viewData['link'] = "registerUsers";
        if($this->input->post()){
            $validationError = $this->formValidations();
            if($validationError == FALSE){
                $this->load->view('admin/addUsers' , $viewData);
            }
            else{
                $data = $this->input->post();
                $data['userType'] = 'user';
                unset($data['ucpass']);
                $data['userPass'] = base64_encode($data['userPass'].KEY);
                $ret = $this->logicalexpert_model->insertData('users' ,$data);
                if($ret)
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User has been Saved Successfully!</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'registerUsers');
            }
        }
        else{
            $this->load->view('admin/addUsers' , $viewData);
        }
    }
    /*
     * Edit Users
     */
    public function edit($uid = ''){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        // check for the id in the url
        if($uid == '')redirect (ADMIN_URL.'registerUsers');
        // get posted data in form
        $data = $this->input->post();
        $whereCondition = array('userId' => $uid , 'userType' => 'user');
        $return = $this->logicalexpert_model->getSingleData('users', $whereCondition );
        // if no data found , redirect to listing
        if($return == '' || empty($return))redirect(ADMIN_URL.'registerUsers');
        // setting variables for view
        $viewData['result'] = $return[0];
        $viewData['formUrl'] = 'registerUsers/edit/'.$viewData['result']['userId'];
        $viewData['submitButton'] = 'Update';
        $viewData['heading'] = "Edit User";
        $viewData['link'] = "registerUsers";
        // check for the value with new updated value
        $validateUserName = ($data['userName'] == $viewData['result']['userName'])? 0 : 1;
        $validateEmail = ($data['userEmail'] == $viewData['result']['userEmail'])? 0 : 1;
        $validationError = $this->formValidations($viewData['result']['userId'] , $validateUserName , $validateEmail );
            if($validationError == FALSE){
                $this->load->view('admin/addUsers' , $viewData);
            }
            else{
                echo $data['userPass'] = base64_encode($data['userPass'].KEY);
                
                unset($data['ucpass']);
                $ret = $this->logicalexpert_model->updateData('users' ,$data , 'userId' ,$uid);
                
                if(!empty($ret))
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User has been Updated Successfully!</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'registerUsers');
        }        
    }
    /*
     * Single users view
     */
    public function view($uid = ''){
        $whereCondition = array('userId' => $uid , 'userType' => 'user');
        $return = $this->logicalexpert_model->getSingleData('users', $whereCondition );
        if($return == '' || empty($return))redirect(ADMIN_URL.'userAdmin');
        $viewData['data'] = $return[0] ;
        $this->load->view('admin/adminUserDetail', $viewData);
    }
    
    /*
     * Delete single user
     */
    public function delete($uid = '') {
        if($uid != ''){
            $deleteCheck = $this->logicalexpert_model->deleteData('users' , 'userId' , $uid);
            if($deleteCheck)
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User has been Deleted Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User not found</div>');
       }
       redirect(ADMIN_URL.'registerUsers');
    }
    /*
     * Delete multiple users
     */
    public function multipleDelete(){
        $postData = $this->input->post('deleteId');
        $this->logicalexpert_model->deleteMultiple('users' , 'userId' , json_decode($postData));
        $this->ajaxCall();
        exit;
    }
    /*
     * Call on any ajax call
     * Return : view of the page along with pagination
     */
    public function ajaxCall()
    {
        // get search value
        $postArray = array();
        $search = ($this->input->post('postData')) ? $this->input->post('postData') : '';
        parse_str($search, $postArray);
        $searchData = isset($postArray['userFName']) ? $postArray['userFName'] : $this->session->userdata('search');
        $this->session->set_userdata('search' , $searchData);
        $like = array('userFName' => $searchData);
        $totalRows = $this->logicalexpert_model->countRows('users','userType','user' , $like );
        // get search value end
        $perPage = ($this->input->post('perPage')) ? $this->input->post('perPage') : $this->session->userdata('perPage' );
        $sortData['sortCol'] = ($this->input->post('sortcolumn')) ? $this->input->post('sortcolumn') : '';
        $sortData['orderBy'] = ($this->input->post('orderby')) ? $this->input->post('orderby') : '';
        $this->session->set_userdata('perPage' , $perPage );
        $perPage = $this->paginationInitialize('' , $totalRows);
        if($this->uri->segment(4)) 
            $offset = $this->uri->segment(4);
        else
            $offset = 0;
        $this->session->set_userdata('pageNumber' , $offset );
        $sortData = ($sortData['sortCol'] != '') ? $sortData : '';
        $data['userData'] = $this->logicalexpert_model->getAllData('users',array('userType' => 'user'),'','',$perPage,$offset ,$sortData , '' , '' , $like);
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'registerUsers';
        // get the view of the page
        echo $this->load->view('admin/registerUsersTable' , $data , TRUE);
        exit;
    }
    /*
     * function used to initilize the pagination
     * @param :- $perpage : no of records per page
     */
    public function paginationInitialize($perPage = 2 , $totalRows){
        // pagination start
        $this->load->library('pagination');
        $perPage = ($this->session->userdata('perPage')) ? $this->session->userdata('perPage') : $perPage ;
        $config = array();
        $config['base_url'] = base_url().'admin/registerUsers/ajaxCall';
        $config['total_rows'] = $totalRows;
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
    public function formValidations($updateCheck = '' , $validateUserName = 1 , $validateEmail = 1 ){
        $required = ($updateCheck == '') ? 'required' : '';
        $isUniqueUserName = ($validateUserName == 1) ? '|is_unique[users.userName]' : '';
        $isUniqueEmail = ($validateEmail == 1) ? '|is_unique[users.userEmail]' : '';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userFName', 'First Name', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('userName', 'User Name', 'trim||required|max_length[30]'.$isUniqueUserName );
        $this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email'.$isUniqueEmail );
        $this->form_validation->set_rules('userPass', 'Password',  $required.'|matches[ucpass]|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('ucpass', 'Confirm Password', $required);
        $this->form_validation->set_rules('userLName', 'Last Name', 'trim|max_length[15]');
        $this->form_validation->set_rules('userAddress', 'Address', 'trim');
        $this->form_validation->set_rules('userPhnNo', 'Phone Number', 'trim|numeric|max_length[15]');
        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        return TRUE;
    }
    public function changeStatus(){
        $id = $this->input->post('columnId');
        $status = $this->input->post('status');
        $newStatus = ($status == 'enabled') ? 0 : 1; 
        $data = array('userStatus' => $newStatus);
        echo $ret = $this->logicalexpert_model->updateData('users' ,$data , 'userId' ,$id);
        exit();
    }
}