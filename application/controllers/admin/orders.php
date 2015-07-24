<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends CI_Controller {
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
        $this->asset['js'] = "<script src=".URL."assets/admin/js/orders.js></script>";
    }
    /*
     * orders listing page
     */   
    public function index($pdfChk = ''){
        // unset the search session
        $this->session->unset_userdata('search');
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        // returns number of pages per page
        $joinData = array('users' => 'users.userId = orders.orderUserId' , 'classes' => 'classes.classId = orders.orderClassId');
        $totalRows = $this->logicalexpert_model->countRows('orders' , '' , '' , '' , '' , '' , $joinData);
        $perPage = $this->paginationInitialize('' , $totalRows);
        $offset = 0;
        $data['userData'] = $this->logicalexpert_model->getAllData('orders','',$joinData,'',$perPage,$offset);
        // create pagination links
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'orders';
        $data['search'] = 'userName';
        $data['heading'] = 'Orders';
        $data['pdf'] = TRUE;
        if($pdfChk == 1){
            $this->load->helper(array('dompdf', 'file'));
            // page info here, db calls, etc.    
            $html = $this->load->view('admin/ordersTable' , $data , TRUE);
            pdf_create($html, 'myPdf');
        }
        $this->load->view('admin/contentListing' , $data);
    }
    /*
     * Single category view
     */
    public function view($oid = ''){
        $whereCondition = array('orderId' => $oid);
        $joinData = array('users' => 'users.userId = orders.orderUserId' , 'classes' => 'classes.classId = orders.orderClassId');
        $return = $this->logicalexpert_model->getSingleData('courses', $whereCondition ,'' , $joinData );
        if($return == '' || empty($return)){
            echo "No Data Found";
            exit();
        }
        $viewData['data'] = $return[0] ;
        echo $this->load->view('admin/orderDetail', $viewData , TRUE);
        exit();
    }
    /*
     * Delete single category
     */
    public function delete($uid = '') {
        if($uid != ''){
            $deleteCheck = $this->logicalexpert_model->deleteData('orders' , 'orderId' , $uid);
            if($deleteCheck)
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Order has been Deleted Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Order not found</div>');            
       }
       redirect(ADMIN_URL.'orders');
    }
    /*
     * Delete multiple categories
     */
    public function multipleDelete(){
        $postData = $this->input->post('deleteId');
        $this->logicalexpert_model->deleteMultiple('orders' , 'orderId' , json_decode($postData));
        $this->ajaxCall();
        exit;
    }
    /*
     * Call on any ajax call
     * Return : view of the page along with pagination
     */
    public function ajaxCall()  {
        
        
        $perPage = ($this->input->post('perPage')) ? $this->input->post('perPage') : $this->session->userdata('perPage' );
        $sortData['sortCol'] = ($this->input->post('sortcolumn')) ? $this->input->post('sortcolumn') : '';
        $sortData['orderBy'] = ($this->input->post('orderby')) ? $this->input->post('orderby') : '';
        $this->session->set_userdata('perPage' , $perPage );
        if($this->uri->segment(4)) 
            $offset = $this->uri->segment(4);
        else
            $offset = 0;
        $this->session->set_userdata('pageNumber' , $offset );
        $sortData = ($sortData['sortCol'] != '') ? $sortData : '';
        // get search value
        $postArray = array();
        $search = ($this->input->post('postData')) ? $this->input->post('postData') : '';
        parse_str($this->input->post('postData'), $postArray);
        $searchData = isset($postArray['userName']) ? $postArray['userName'] : $this->session->userdata('search');
        $this->session->set_userdata('search' , $searchData);
        $like = array('userName' => $searchData);
        $orLike = array('className' => $searchData);
        $joinData = array('users' => 'users.userId = orders.orderUserId' , 'classes' => 'classes.classId = orders.orderClassId');
        $totalRows = $this->logicalexpert_model->countRows('orders' , '' , '' , $like , $orLike  , '' , $joinData );
        $this->paginationInitialize('' , $totalRows);
        // get search value end
        $data['userData'] = $this->logicalexpert_model->getAllData('orders','',$joinData,'',$perPage,$offset ,$sortData ,''  , '' , $like ,  $orLike);
        $data['links']= $this->pagination->create_links();
        $data['pageLink'] = 'courses';
        // get the view of the page
        echo $this->load->view('admin/ordersTable' , $data , TRUE);
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
        $config['base_url'] = base_url().'admin/orders/ajaxCall';
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
    public function generatePDF($oid){
        if(empty($oid))
            exit();
        $whereCondition = array('orderId' => $oid);
        $joinData = array('users' => 'users.userId = orders.orderUserId' , 'classes' => 'classes.classId = orders.orderClassId');
        $return = $this->logicalexpert_model->getSingleData('orders', $whereCondition ,'' , $joinData );
        if(empty($return)){
            echo 'No Data Found';
            exit();
        }
        $this->load->helper(array('dompdf', 'file'));
        $data['viewData'] = $return[0];
        $html = $this->load->view('admin/orderPdf' , $data , TRUE);
        pdf_create($html, 'receipt_'.$return[0]['userId']);
    }
}