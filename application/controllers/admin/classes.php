<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes extends CI_Controller {
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
        $this->asset['js'] = "<script src=".URL."assets/admin/js/classes.js></script>";
    }
    /*
     * classes listing page
     */   
    public function index($cid = ''){
        if($cid == '')
            redirect(ADMIN_URL.'courses');
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        // returns number of pages per page
        $perPage = $this->paginationInitialize();
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $joinData = array('users as us' => 'us.userId = cl.createdBy ' , 'courses as co' => 'co.courseId = cl.courseId');
        $colName = "cl.className , cl.classId , cl.endDate , cl.startDate ,  cl.price , cl.time , cl.classType , cl.status , us.userName";
        $data['userData'] = $this->logicalexpert_model->getAllData('classes as cl',array('cl.courseId' => $cid), $joinData,$colName,$perPage,$offset ,'' ,''  ,'left');
        $where = array('courseId' => $cid);
        $courseId = $this->logicalexpert_model->getSingleData('courses' , $where);
        if(!empty($courseId)){
            // set session for course id if course present
            $this->session->set_userdata('courseId' , $cid);
        }else{
            redirect(ADMIN_URL.'courses');
        }
        // create pagination links
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'classes';
        $data['heading'] = 'Classes';
        $this->load->view('admin/contentListing' , $data);
    }
    function videoClass(){
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        $classType = 'videoClass';
        // total records
        $totalRows = $this->logicalexpert_model->countRows('classes' , 'classType' , $classType);
        // returns number of pages per page
        
        $perPage = $this->paginationInitialize('' , $totalRows , $classType );
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $joinData = array('users as us' => 'us.userId = cl.createdBy ');
        $colName = "cl.className , cl.classId , cl.endDate , cl.startDate ,  cl.price , cl.time , cl.classType , cl.status , cl.classVideo , cl.duration , us.userName";
        $data['userData'] = $this->logicalexpert_model->getAllData('classes as cl',array('cl.classType' => $classType ),$joinData,$colName,$perPage,$offset ,'' ,''  ,'left' );
        // create pagination links
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'classes';
        $data['controller'] = $classType ;
        $data['heading'] = 'Video On Demand Classes';
        $this->load->view('admin/contentListing' , $data);
    }
    function classroomClass(){
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        $classType = 'classroomClass';
        // total records
        $totalRows = $this->logicalexpert_model->countRows('classes' , 'classType' , $classType);
        // returns number of pages per page
        
        $perPage = $this->paginationInitialize('' , $totalRows , $classType);
        $offset = ($this->uri->segment(4))  ? $this->uri->segment(4) : 0;
        $joinData = array('users as us' => 'us.userId = cl.createdBy ');
        $colName = "cl.className , cl.classId , cl.endDate , cl.startDate ,  cl.price , cl.time , cl.classType , cl.status , us.userName";
        $data['userData'] = $this->logicalexpert_model->getAllData('classes as cl',array('cl.classType' => $classType ),$joinData,$colName,$perPage,$offset ,'' ,'' ,'left');
        // create pagination links 
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'classes';
        $data['controller'] = $classType;
        $data['heading'] = 'Class Room Classes';
        $this->load->view('admin/contentListing' , $data);
    }
    /*
     * add classes
     */
    public function add($classType = ''){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $viewData['cid']= $this->session->userdata('courseId');
        $viewData['submitButton'] = 'Save';
        $viewData['formUrl'] = 'classes/add';
        $viewData['heading'] = "Add Class";
        $viewData['classType'] = $classType;
        $cid = $this->session->userdata('courseId');
        if($this->input->post()){
            $validationError = $this->formValidations();
            $data = $this->input->post();
            if($validationError == FALSE){
                $this->load->view('admin/addClass' , $viewData);
            }
            else{
                $data['createdBy'] = $this->session->userdata('logged_in')[0]['userId'];
                $data['courseId']  = $cid;
                $categories = $data['categoryId'];
                unset($data['categoryId']);
                $ret = $this->logicalexpert_model->insertData('classes' , $data);
                // exit;
                if($ret){
                    foreach($categories as $category => $id){
                        $catData = array('classId' => $ret , 'categoryId' => $id);
                        $catRet = $this->logicalexpert_model->insertData('classCat' , $catData);
                    }
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Class has been Saved Successfully!</div>');
                }
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'classes/'.$classType);
            }
        }
        else{
            /** get categories **/
            $categories = $this->logicalexpert_model->getAllData('categories');
            $viewData['categories'] = $categories;
            $this->load->view('admin/addClass', $viewData);
        }
    }
    /*
     * Edit classes
     */
    public function edit($cid = ''){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        // check for the id in the url
        if($cid == '')redirect (ADMIN_URL.'classes');
        // get categories of a class
        /** get categories **/
        $categories = $this->logicalexpert_model->getAllData('categories');
        $viewData['categories'] = $categories;
        $classCat = $this->logicalexpert_model->getAllData('classCat' , array('classId' => $cid) );
        $viewData['classCat'] = $classCat;
        // get posted data in form
        $data = $this->input->post();
        $whereCondition = array('classId' => $cid);
        $return = $this->logicalexpert_model->getSingleData('classes', $whereCondition );
        // if no data found , redirect to listing
        if($return == '' || empty($return))redirect(ADMIN_URL.'classes');
        // setting variables for view
         /** get categories **/
        $viewData['result'] = $return[0];
        $viewData['classType'] = $return[0]['classType'];
        $viewData['formUrl'] = 'classes/edit/'.$viewData['result']['classId'];
        $viewData['submitButton'] = 'Update';
        $viewData['heading'] = "Edit Class";
        $viewData['cid'] = $this->session->userdata('courseId');
        $validationError = $this->formValidations();
            if($validationError == FALSE){
                $this->load->view('admin/addClass' , $viewData);
            }
            else{
                // prepare data to save in class
                $categories = $data['categoryId'];
                unset($data['categoryId']);
                // set private class
                $data['private'] = (!isset($data['private'])) ? 0 : $data['private'];
                // update class
                $ret = $this->logicalexpert_model->updateData('classes' ,$data ,$whereCondition , $cid);
                // delete all the categories wrt class
                $dlt = $this->logicalexpert_model->deleteData('classCat', 'classId', $cid);
                
                // add new updated categories
                foreach($categories as $category => $id){
                    $catData = array('classId' => $cid , 'categoryId' => $id);
                    $catRet = $this->logicalexpert_model->insertData('classCat' , $catData);
                }
                if(!empty($ret) || !empty($catRet) )
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Class has been Updated Successfully!</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'classes/'.$viewData['classType']);
        }        
    }
    /*
     * Single class view
     */
    public function view($cid = ''){
        $whereCondition = array('cl.classId' => $cid);
        $joinData = array('users as us' => 'us.userId = cl.createdBy ' , 'courses as co' => 'co.courseId = cl.courseId');
        $return = $this->logicalexpert_model->getSingleData('classes as cl', $whereCondition ,'' , $joinData );
        if($return == '' || empty($return)){
            echo "No Data Found";
            exit();
        }
        $viewData['data'] = $return[0] ;
        echo $this->load->view('admin/classDetail', $viewData , TRUE);
        exit();
    }
    
    /*
     * Delete single class
     */
    public function delete($uid = '') {
        if($uid != ''){
            $deleteCheck = $this->logicalexpert_model->deleteData('classes' , 'classId' , $uid);
            if($deleteCheck)
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Class has been Deleted Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Class not found</div>');            
       }
       redirect(ADMIN_URL.'classes/'. $this->session->userdata('courseId'));
    }
    /*
     * Delete multiple categories
     */
    public function multipleDelete(){
        $postData = $this->input->post('deleteId');
        $this->logicalexpert_model->deleteMultiple('classes' , 'classId' , json_decode($postData));
        $this->ajaxCall();
        exit;
    }
    /*
     * Call on any ajax call
     * Return : view of the page along with pagination
     */
    public function ajaxCall($page = '')  {
        $perPage = ($this->input->post('perPage')) ? $this->input->post('perPage') : $this->session->userdata('perPage' );
        $sortData['sortCol'] = ($this->input->post('sortcolumn')) ? $this->input->post('sortcolumn') : '';
        $sortData['orderBy'] = ($this->input->post('orderby')) ? $this->input->post('orderby') : '';
        $this->session->set_userdata('perPage' , $perPage );
        if(isset($page) && !empty($page)) {
            $classType = $page;
        }
        // total records
        $totalRows = $this->logicalexpert_model->countRows('classes' , 'classType' , $classType);
        // returns number of pages per page
          $this->paginationInitialize('' , $totalRows ,$page);
        //$perPage = $this->paginationInitialize();
        if($this->uri->segment(5))
            $offset = $this->uri->segment(5);
        else
            $offset = 0; 
        $this->session->set_userdata('pageNumber' , $offset );
        $sortData = ($sortData['sortCol'] != '') ? $sortData : '';
        $joinData = array('users as us' => 'us.userId = cl.createdBy ');
        $colName = "cl.className , cl.classId , cl.endDate , cl.startDate ,  cl.price , cl.time , cl.classType , cl.status ,  cl.classVideo , cl.duration , , us.userName";
        $data['userData'] = $this->logicalexpert_model->getAllData('classes as cl',array('cl.classType' => $classType),$joinData,$colName,$perPage,$offset ,$sortData , '' ,'left' );
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'classes';
        $data['controller'] = $classType;
        // get the view of the page
        echo $this->load->view('admin/classesTable' , $data , TRUE);
        exit;
    }
    /*
     * function used to initilize the pagination
     * @param :- $perpage : no of records per page
     */
    public function paginationInitialize($perPage = 2 ,$totalRows , $initPage){
        // pagination start
        $this->load->library('pagination');
        $perPage = ($this->session->userdata('perPage')) ? $this->session->userdata('perPage') : $perPage ;
        $config = array();
        $config['base_url'] = base_url().'admin/classes/ajaxCall/'.$initPage;
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 5;
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
     */
    public function formValidations(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('className', 'Class Name', 'trim|required|max_length[20]');
        if($this->input->post('typeCheck') == 'classroom' ){
            $this->form_validation->set_rules('startDate', 'Start Date', 'required');
            $this->form_validation->set_rules('endDate', 'End Date', 'required');
            $this->form_validation->set_rules('time', 'Class Time', 'required|min_length[3]');
            $this->form_validation->set_rules('attendee', 'Attendee', 'trim|required|numeric|max_length[3]');
        }
        elseif($this->input->post('typeCheck') == 'video'){
            $this->form_validation->set_rules('classVideo', 'Video', 'trim|required');
            $this->form_validation->set_rules('duration', 'Class Duration', 'trim|required|numeric|max_length[10]');
        }
        $this->form_validation->set_rules('paymentType', 'Class Payment Type', 'required|alpha_numeric');
        $this->form_validation->set_rules('price', 'Class Price', 'trim|required|numeric|max_length[10]');
        $this->form_validation->set_rules('private', 'Private', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_message('alpha_numeric','You need to select something other than the default in %s');
        $this->form_validation->set_message('min_length','You need to select something other than the default in %s');
        if($this->input->post('private') == '1'){
            $this->form_validation->set_rules('privatePassCode', 'Pass Code', 'trim|required');
        }
        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        return TRUE;
    }
    /*
     * function to enable/disable
     */
    public function changeStatus(){
        $id = $this->input->post('columnId');
        $status = $this->input->post('status');
        $newStatus = ($status == 'enabled') ? 0 : 1; 
        $data = array('status' => $newStatus);
        echo $ret = $this->logicalexpert_model->updateData('classes' ,$data , 'classId' ,$id);
        exit();
    }
}