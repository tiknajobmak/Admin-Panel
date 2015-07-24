<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load libraries , view , helper
        $this->load->helper('url');
        $this->data['base_url'] = base_url();
        $this->load->library('session');
        $this->load->model('logicalexpert_model');
        // if session not set , redirect to admin login page
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Permission Denied!</div>');
            redirect('adminLogin');
        }
    }

    public function index() {
        // get notifications
        $join = array('users' => 'users.userId = notifications.notUserId' , 'pages' => 'notifications.notDisplayId = pages.pageId');
        $colName =  array('notId' , 'notSlug' , 'notType' , 'users.userName' , 'users.userImage' , 'pages.pageId' , 'pages.title' , 'pages.handle');
        $this->data['userData'] = $this->logicalexpert_model->getAllData('notifications' , '' , $join , $colName , 3 , '' , array('sortCol' => 'notifications.notId' , 'orderBy' => 'DESC') ,array('notId') );
        
        // get the number of visits
        $res = $this->logicalexpert_model->countTotalUsersVisited('logTbl');
        $this->data['totVisitors'] = $res[0]['count'];
        $this->load->view('admin/templates/sidebar.php', $this->data);
        $this->load->view('admin/templates/header.php', $this->data);
        $this->load->view('admin/dashboard', $this->data);
    }
    
    public function adminLogout() {
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Logout Successfully!</div>');
        redirect('adminLogin');
    }
//    public function adminUsers() {
//        $this->load->view('admin/adminUsers', $this->data);
//    }
}
