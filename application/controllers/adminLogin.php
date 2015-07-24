<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class adminLogin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // load session librery
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form'));
        // Load model
        $this->load->model('logicalexpert_model');
        $this->asset['js'] = "<script src=".URL."assets/admin/js/login.js></script>";
    }    
    public function index() {
        // if session set show dashboard else login form
        if($this->session->userdata('logged_in'))
            redirect('admin');
        else    
            $this->load->view('admin/login' , $this->asset);
        
    }
    
    public function form_check() {
        //This method will have the credentials validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $error = '<div class="alert alert-danger text-center">'.validation_errors().'</div>';
            $this->session->set_flashdata('msg', $error );
            redirect('adminLogin');
        }
        else {
            $postData = $this->input->post();
            $userTypeArr = array('superadmin','admin');
            $postData['password'] = base64_encode($postData['password'].KEY);
            $check = $this->logicalexpert_model->getUser('users',$postData,$userTypeArr );
            if($check ){
                $this->session->set_userdata('logged_in', $check);
                $date = date('Y-m-d h:i:s');
                $this->logicalexpert_model->updateData('users' , array('userLastLogin' => $date ) ,'userId', $check[0]['userId']);
                redirect('admin');
            }else{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username or password!</div>');
                redirect('adminLogin');
            }
        }
    }
    public function forgetPassword(){
        $postArray = array();
        parse_str($this->input->post('postData') , $postArray);
        $where = array("userEmail" => $postArray['forgotPass']);
        $check = $this->logicalexpert_model->getSingleData('users' , $where );
        if(empty($check)){
            echo "Not found";
        }
        else {
            $to = $check[0]['userEmail'];
            $subject = "Recover Password";
            $recoverPass = base64_decode($check[0]['userPass']);
            $msg = "Your password is : ".str_replace(KEY, '', $recoverPass);;
            echo $return = $this->logicalexpert_model->sendMail($to , $subject , $msg);
        }       
        exit();
    }
}

