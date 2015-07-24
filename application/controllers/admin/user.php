<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
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
    public function index($id = 0){
        if($id == 0 && !is_int($id))
            redirect('admin');
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php' , $this->asset);
        $this->load->view('admin/templates/header.php');
        $return = $this->logicalexpert_model->getSingleData('users', array('userId' => $id));
        $viewData['data'] = $return[0] ;
        $this->load->view('admin/userDetail' , $viewData);
    }
}