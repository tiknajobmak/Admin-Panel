<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications extends CI_Controller {
    public $data;
    public function __construct() {
        parent::__construct();
        // load libraries , view , helper
        $this->load->helper('url');
        $this->load->library('session');        
        // if session not set , redirect to admin login page
        if(!$this->session->userdata('logged_in') || $this->session->userdata('logged_in')[0]['userType'] != 'superadmin'){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Permission Denied!</div>');
            redirect(URL.'adminLogin');   
        }
        $this->load->helper(array('form'));
        $this->load->model('logicalexpert_model');
    }
    public function index(){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $join = array('users' => 'users.userId = notifications.notUserId' , 'pages' => 'notifications.notDisplayId = pages.pageId');
        $colName =  array('notId' , 'notSlug' , 'notType' , 'users.userName' , 'users.userImage' , 'pages.pageId' , 'pages.title' , 'pages.handle');
        $this->data['userData'] = $this->logicalexpert_model->getAllData('notifications' , '' , $join , $colName , 20 , '' , array('sortCol' => 'notifications.notId' , 'orderBy' => 'DESC') ,array('notId') );
        // UPDATE notificaton status
        if($this->input->get('status', TRUE) == 1){
            $this->logicalexpert_model->updateData('notifications', array('notStatus' => 1), 'notStatus', 0) ;
        }
        $this->load->view('admin/notifications', $this->data);
    }
}