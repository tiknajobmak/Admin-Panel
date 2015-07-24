<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    protected $perPage = 2;

    public function __construct() {
        parent::__construct();
        // load libraries , view , helper
        $this->load->model('logicalexpert_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->data['base_url'] = base_url();
        $this->load->helper('date');
        
        /**** calculate the number of users visited the site ****/
        // Check if you have been counted this session
        $datestring = "%Y-%m-%d";
        $time = time();
        $date = mdate($datestring, $time);
        $this->session->unset_userdata('HasBeenCounted');
         //echo now();
        if (!$this->session->userdata('HasBeenCounted')) {
            // Fetch the ammount of times
            // this IP has been counted today
            $IP = $this->input->ip_address();
           
            $res = $this->logicalexpert_model->getSingleData('logTbl' , array('logIp' => $IP , 'logDate' => $date));
            // If it has not been counted; add it
            if (count($res) == 0) {
                $this->logicalexpert_model->insertData('logTbl', array('logIp' => $IP , 'logDate' => $date ));
            }
            // Set the $_SESSION var
            $this->session->set_userdata('HasBeenCounted', true);
        }
    }

    /*
     * init function for pages
     * @param : {string} $pageName (page handle)
     */

    public function index($pageName = '') {
        /**
         * load->template('template_name',$data)
         * $params string
         */
        echo $ret =  $this->logicalexpert_model->menu('class=ul-menu' , 'class=li-menu');
        echo  '<pre>';
        //print_r($ret);
        echo  '</pre>';
        
        $whereCondition = array('status' => 1, 'handle' => $pageName);
        $data = $this->logicalexpert_model->getSingleData('pages', $whereCondition);
        $this->data['pageData'] = (!empty($data)) ? $data[0] : "Page Does Not Exit or Not Enable";
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        switch ($pageName) {
            case 'courses':
                $this->courses(); // call courses function for listing
                break;
            case 'classes':
                $this->classes($segment); // call classes function for listing
                break;
            case '':
                $this->load->template('index', $this->data); // home page template
                break;
            default :
                $this->load->template('v_pages', $this->data); // other pages template
        }
    }

    /*
     * dispaly courses
     */

    public function courses() {
        //$this->session->unset_userdata('courseId');
        $this->session->unset_userdata('filter');
        $joinData = array('users' => 'users.userId = courses.createdBy');
        // count rows
        $noOfRows = $this->logicalexpert_model->countRows('courses');
        $this->paginationInitialize($noOfRows, 'courses');
        $offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data = $this->logicalexpert_model->getAllData('courses', '', '', '', $this->perPage, $offset, '', $joinData);
        /** get categories * */
        $categories = $this->logicalexpert_model->getAllData('categories');
        $this->session->set_userdata('pages', 'courses');
        $this->data['categories'] = $categories;
        $this->data['listData'] = $data;
        $this->data['links'] = $this->pagination->create_links();
        $this->data['pageLink'] = 'courses';
        $this->load->template('v_listing', $this->data);
    }

    /*
     * Call on any ajax call
     * param :- { integer }  $cid (course id)
     */

    public function classes($cid = 0) {
        $this->session->unset_userdata('filter');
        if ($cid == 0)
            redirect(URL . 'pages/courses');
        $noOfRows = $this->logicalexpert_model->countRows('classes', 'courseId', $cid, '', '', 1);
        $this->paginationInitialize($noOfRows, 'classes');
        $offset = 0;
        $joinData = array('users as us' => 'us.userId = cl.createdBy ', 'courses as co' => 'co.courseId = cl.courseId');
        $colName = "cl.className , cl.classId , cl.endDate , cl.startDate ,  cl.price , cl.time , cl.classType , cl.status , cl.private , us.userName";
        $data = $this->logicalexpert_model->getAllData('classes as cl', 'cl.courseId', $cid, '', $this->perPage, $offset, '', $joinData, 'left', $colName, '', '', 1);
        $where = array('courseId' => $cid);
        $courseId = $this->logicalexpert_model->getSingleData('courses', $where);
        if (!empty($courseId)) {
            // set session for course id if course present
            $this->session->set_userdata('courseId', $cid);
        } else {
            redirect(URL . 'pages/courses');
        }
        // create pagination links
        $this->session->set_userdata('pages', 'classes');
        $this->data['listData'] = $data;
        $this->data['links'] = $this->pagination->create_links();
        $this->data['pageLink'] = 'classes';
        $this->load->template('v_listing', $this->data);
    }

    /*
     * Call on any ajax call
     * param :- { string }  $init (from which page been called)
     * Return : view of the page along with pagination
     */

    public function ajaxCall($init = '') {
        $pageName = $init;
        // set session for pagination within selected category
        if ($this->input->post('dataId') && $this->input->post('dataId') != '-1')
            $this->session->set_userdata('filter', $this->input->post('dataId'));
        elseif ($this->input->post('dataId') == '-1')
            $this->session->unset_userdata('filter');
        // prepare data for sorting
        $sortData['sortCol'] = ($this->input->post('sortcolumn')) ? $this->input->post('sortcolumn') : '';
        $sortData['orderBy'] = ($this->input->post('orderby')) ? $this->input->post('orderby') : '';
        $sortData = ($sortData['sortCol'] != '') ? $sortData : '';
        // prepare data for category
        if ($this->session->userdata('filter') && !($this->session->userdata('filter'))) {
            $like = array('categoryId' => $this->session->userdata('filter'));
            $orLike1 = $this->session->userdata('filter') . ",";
            $orLike = array('categoryId' => $orLike1);
        } else {
            $orLike = $like = '';
        }
        // data for course id in class
        if (!empty($init) && $init == 'classes'):
            $cid = $this->session->userdata('courseId');
            $courseCol = "courseId";
            $status = 1;
            $joinData = array('users' => 'users.userId = ' . $pageName . '.createdBy');
        elseif (!empty($init) && $init == 'orders'):
            $cid = $this->session->userdata('user_logged_in')[0]['userId'];
            $courseCol = "orderUserId";
            $joinData = array('classes as cl' => 'cl.classId = orders.orderClassId');
            $status = 0;
        else:
            $courseCol = $cid = '';
            $status = 0;
            $joinData = array('users' => 'users.userId = ' . $pageName . '.createdBy');
        endif;
        // count rows
        $noOfRows = $this->logicalexpert_model->countRows($pageName, $courseCol, $cid, $like, $orLike, $status);
        $this->paginationInitialize($noOfRows, $init);
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = $this->logicalexpert_model->getAllData($pageName, $courseCol, $cid, '', $this->perPage, $offset, $sortData, $joinData, '', '', $like, $orLike, $status);
        $this->data['listData'] = $data;
        $this->data['pageLink'] = $pageName;
        $this->data['links'] = $this->pagination->create_links();
        echo $this->load->view('front/v_' . $pageName . 'Table', $this->data, TRUE);
        exit;
    }

    /*
     * function used to initilize the pagination
     * * param :- { string }  $init (from which page been called)
     * @param :- $noOfRows : Total no of records
     */

    public function paginationInitialize($noOfRows, $init = '') {
        $init = ($init != '') ? '/' . $init : '';
        $segment = ($this->uri->segment(1) == 'pages') ? 2 : 3;
        // pagination start
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . 'ajaxCall' . $init;
        $config['total_rows'] = $noOfRows;
        $config['per_page'] = $this->perPage;
        $config['uri_segment'] = $segment;
        $config['last_link'] = '<span class="lastLink">Last ›</span>';
        $config['first_link'] = '<span class="firstLink">‹ First</span>';
        $config['next_link'] = '<span class="nextLink">&gt;</span>';
        $config['prev_link'] = '<span class="prevLink">&lt;</span>';
        $this->pagination->initialize($config);
        // pagination End
    }

    /*
     * view detail page
     * @param : { string } $viewName (name of view to show)
     * @param : { int } $viewId (Id of view to show)
     * return (html of detail view)
     */

    public function view($viewName, $viewId) {
        $columns = '';
        $joinData = '';
        // switch of pages and prepare data accordingly for each
        switch ($viewName) {
            case 'courses' :
                // prepare where condition AND join
                $joinData = array('users as us' => 'us.userId = tb.createdBy ');
                $whereCondition = array('courseId' => $viewId);
                break;
            case 'classes' :
                // prepare where condition , join and columns to fetch
                $whereCondition = array('classId' => $viewId);
                $joinData = array('users as us' => 'us.userId = tb.createdBy ', 'courses as co' => 'co.courseId = tb.courseId');
                $columns = array('tb.classId', 'tb.className', 'tb.startDate', 'tb.endDate', 'tb.duration', 'tb.time', 'tb.price', 'tb.paymentType', 'co.courseName', 'us.userName');
                break;
        }
        $return = $this->logicalexpert_model->getSingleData($viewName . ' as tb', $whereCondition, '', $joinData, $columns);
        if ($return == '' || empty($return)) {
            echo "No Data Found";
            exit();
        }
        $this->data['singleData'] = $return[0];
        echo $this->load->view('front/v_' . $viewName . 'Detail', $this->data, TRUE);
        exit();
    }

    /*
     * user login page
     */

    public function login() {
        // if submit , save else load login view
        if ($this->input->post()):
            //load validation library
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'UserName', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            // if data not correct,show error else login and redirect to profile page
            if ($this->form_validation->run() == FALSE) {
                $error = '<div class="alert alert-danger text-center">' . validation_errors() . '</div>';
            } else {
                $postData = $this->input->post();
                $userTypeArr = array('user');
                $postData['password'] = base64_encode($postData['password'] . KEY); // pass encode to base64
                // $joinData = array('orders as ord' => 'ord.orderUserId = us.userId' , 'classes as cl' => 'cl.classId = ord.orderClassId');
                $userData = array();
                $check = $this->logicalexpert_model->getUser('users', $postData, $userTypeArr);
                if ($check && !empty($check)) {
                    $this->session->set_userdata('user_logged_in', $check);
                    $date = date('Y-m-d h:i:s');
                    $this->logicalexpert_model->updateData('users', array('userLastLogin' => $date), 'userId', $check[0]['userId']);
                    $error = 0;
                } else {
                    $error = '<div class="alert alert-danger text-center">Invalid username or password!</div>';
                }
            }
            echo $error;
            exit; elseif ($this->session->userdata('user_logged_in') && !($this->session->userdata('user_logged_in'))):
            if (!($this->input->get('redirect', TRUE)) && $this->input->get('redirect', TRUE) != ''):
                $url = $this->input->get('redirect', TRUE);
            else :
                $url = 'profile';
            endif;
            redirect($url);
        else:
            $this->load->template('v_login', $this->data);
        endif;
    }

    /*
     * register page
     */

    public function register() {
        // prepare data for view
        $redirect = (!($this->input->get('redirect', TRUE)) && $this->input->get('redirect', TRUE) != '') ? '?redirect=checkout' : '';
        $this->data['formUrl'] = 'register' . $redirect;
        $this->data['submitButton'] = 'Register';
        $this->data['link'] = 'login' . $redirect;
        // if submit , save else load register view
        if ($this->input->post()) {
            $validationError = $this->formValidations();
            // if data not correct,show error else login and redirect to profile page
            if ($validationError == FALSE) {
                $this->load->template('v_register', $this->data);
            } else {
                $data = $this->input->post();
                if (isset($_FILES['useImage']['name']) && $_FILES['useImage']['name'] != '') {
                    // configuration for image upload
                    $target_dir = './assets/front/images/uploads/';
                    $info = new SplFileInfo($_FILES['useImage']['name']);
                    $fileName = $this->input->post('userName') . '.' . $info->getExtension();
                    $filepath = $target_dir . $fileName;
                    if (move_uploaded_file($_FILES["useImage"]["tmp_name"], $filepath)) {
                        echo "The file " . basename($_FILES["useImage"]["name"]) . " has been uploaded.";
                    } else {
                        $error = "Sorry, there was an error uploading your file.";
                    }
                    $data['userImage'] = $fileName;
                }
                $data['userType'] = 'user';
                $data['userStatus'] = ($redirect != '') ? 1 : 0;
                $data['activateCode'] = $this->logicalexpert_model->generateRandomString();
                unset($data['ucpass']);
                $data['userPass'] = base64_encode($data['userPass'] . KEY);
                $ret = $this->logicalexpert_model->insertData('users', $data);
                if ($ret && $redirect == '') {
                    $to = $data['userEmail'];
                    $subject = "Activation Link";
                    $msg = "Hello " . $data['userName'] . "<br>Please Click this link to activate your account : "
                            . "<a href=" . URL . "activateAccount?uname=" . $data['userName'] . "&activateCode=" . $data['activateCode'] . ">Click here to activate account</a>";
                    $return = $this->logicalexpert_model->sendMail($to, $subject, $msg);
                    if ($return)
                        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">you have registered successfully. and a confirmation email has been sent to your registered email address</div>');
                    else
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                }
                if ($redirect != '') {
                    redirect(URL . 'login?redirect=checkout');
                } else
                    redirect(URL . 'login');
            }
        }
        elseif ($this->session->userdata('user_logged_in') && !($this->session->userdata('user_logged_in')))
            redirect('profile');
        else
            $this->load->template('v_register', $this->data);
    }

    /*
     * used to fetch the password,send password to valid provided email.
     */

    public function forgetPass() {
        $postArray = array();
        parse_str($this->input->post('postData'), $postArray);
        $where = array("userEmail" => $postArray['username']);
        // check for correct email
        $check = $this->logicalexpert_model->getSingleData('users', $where);
        // if email correct , send password to valid provided email.
        if (empty($check)) {
            echo "Not found";
        } else {
            $to = $check[0]['userEmail'];
            $subject = "Recover Password";
            $recoverPass = base64_decode($check[0]['userPass']);
            $msg = "Your password is : " . str_replace(KEY, '', $recoverPass);
            echo $return = $this->logicalexpert_model->sendMail($to, $subject, $msg);
        }
        exit();
    }

    /*
     * function used to set validations
     * @param :- $updateCheck : check update or save
     * $validateUserName : whether to validate user name
     * $validateEmail : whether to validate email
     */

    public function formValidations($updateCheck = '', $validateUserName = 1, $validateEmail = 1) {
        $required = ($updateCheck == '') ? 'required' : '';
        $isUniqueUserName = ($validateUserName == 1) ? '|is_unique[users.userName]' : '';
        $isUniqueEmail = ($validateEmail == 1) ? '|is_unique[users.userEmail]' : '';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userFName', 'First Name', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('userName', 'User Name', 'trim||required|max_length[30]' . $isUniqueUserName);
        $this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email' . $isUniqueEmail);
        $this->form_validation->set_rules('userPass', 'Password', $required . '|matches[ucpass]|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('ucpass', 'Confirm Password', $required);
        $this->form_validation->set_rules('userLName', 'Last Name', 'trim|max_length[15]');
        $this->form_validation->set_rules('userAddress', 'Address', 'trim');
        $this->form_validation->set_rules('userPhnNo', 'Phone Number', 'trim|numeric|max_length[15]');
        $this->form_validation->set_rules('useImage', 'User Image', 'callback_validate_image');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    public function validate_image() {
        $error = '';
        $target_dir = './assets/front/images/uploads/';
        $target_file = $target_dir . basename($_FILES["useImage"]["name"]);
        $fileName = $target_dir . $this->input->post('userName') . '.jpg';
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (isset($_FILES['useImage']['name']) && $_FILES['useImage']['name'] != '') {
            // Check file size above 500 kb
            if ($_FILES["useImage"]["size"] > 500000) {
                $error = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (($imageFileType != "jpg") && ($imageFileType != "png") && ($imageFileType != "jpeg") && ($imageFileType != "gif")) {

                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $this->form_validation->set_message('validate_image', $error);
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    /*
     * destroy login session and logout
     */

    public function logout() {
        $sessionItems = array('user_logged_in' => '', 'checkout' => '');
        $this->session->unset_userdata($sessionItems);
        redirect(URL . 'login');
    }

    /*
     * to activate account from email
     */

    public function activateAccount() {
        $uname = $this->input->get('uname', TRUE);
        $actvCode = $this->input->get('activateCode', TRUE);
        $whereCondition = array('userName' => $uname, 'activateCode' => $actvCode);
        $updateData = array('userStatus' => 1);
        $chk = $this->logicalexpert_model->getSingleData('users', $whereCondition);
        if (!empty($chk)) {
            if ($chk[0]['userStatus']) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Account Already Activated </div>');
            } else {
                $upd = $this->logicalexpert_model->updateData('users', $updateData, 'userName', $uname);
                if ($upd)
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Account Activated</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some error occur.Please click on link again in mail</div>');
            }
        }
        else {
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Not Found</div>');
        }
        redirect('login');
        exit;
    }

    /*
     * user profile page
     */

    public function profile() {
        if ($this->session->userdata('user_logged_in') && !($this->session->userdata('user_logged_in'))) {
            //$this->data['css'] = "<link href='".URL."assets/front/css/minimalist.css' type='text/css' rel='stylesheet'>";
            $this->data['js'] = "<script src='" . URL . "assets/front/js/flowplayer-3.2.13.min.js' type='text/javascript'></script>";
            $uid = $this->session->userdata('user_logged_in')[0]['userId'];
            $userData = $this->logicalexpert_model->getSingleData('users', array('userId' => $uid));

            $join = array('classes as cl' => 'cl.classId = ord.orderClassId');
            $noOfRows = $this->logicalexpert_model->countRows('orders', 'orderUserId', $uid);
            $this->paginationInitialize($noOfRows, 'orders');
            $offset = 0;

            $this->data['userData'] = $userData[0];
            $join = array('classes as cl' => 'cl.classId = ord.orderClassId');
            $this->data['listData'] = $this->logicalexpert_model->getAllData('orders as ord', 'orderUserId', $uid, '', $this->perPage, $offset, '', $join);
            $this->data['links'] = $this->pagination->create_links();
            $this->load->template('v_userProfile', $this->data);
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please login first</div>');
            redirect('login');
        }
    }

    /*
     * user edit their profile
     * @param : {int} $uid (user id)
     */

    public function profileEdit($uid = 0) {
        // check for the id in the url
        if ($uid == '')
            redirect(URL . 'profile');
        // get posted data in form
        $data = $this->input->post();
        $whereCondition = array('userId' => $uid, 'userType' => 'user');
        $return = $this->logicalexpert_model->getSingleData('users', $whereCondition);
        // if no data found , redirect to listing
        if ($return == '' || empty($return))
            redirect(URL . 'profile');
        $this->data['result'] = $return[0];
        $this->data['formUrl'] = 'profileEdit/' . $this->data['result']['userId'];
        $this->data['submitButton'] = 'Update Profile';
        $this->data['link'] = "profile";
        // check for the value with new updated value
        $validateUserName = ($data['userName'] == $this->data['result']['userName']) ? 0 : 1;
        $validateEmail = ($data['userEmail'] == $this->data['result']['userEmail']) ? 0 : 1;
        $validationError = $this->formValidations($this->data['result']['userId'], $validateUserName, $validateEmail);
        if ($validationError == FALSE) {
            $this->load->template('v_register', $this->data);
        } else {
            if (isset($_FILES['useImage']['name']) && $_FILES['useImage']['name'] != '') {
                // configuration for image upload
                $target_dir = './assets/front/images/uploads/';
                $info = new SplFileInfo($_FILES['useImage']['name']);
                $fileName = $this->input->post('userName') . '.' . $info->getExtension();
                $filepath = $target_dir . $fileName;
                // Check if file already exists
                if (file_exists($fileName)) {
                    unlink($this->input->post('userName') . '.jpg'); //remove the file
                }
                if (move_uploaded_file($_FILES["useImage"]["tmp_name"], $filepath)) {
                    echo "The file " . basename($_FILES["useImage"]["name"]) . " has been uploaded.";
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
                $data['userImage'] = $fileName;
            }
            $data['userPass'] = base64_encode($data['userPass'] . KEY);
            unset($data['ucpass']);
            $ret = $this->logicalexpert_model->updateData('users', $data, 'userId', $uid);
            if (!empty($ret))
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User has been Updated Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
            redirect(URL . 'profile');
        }
    }

    /*
     * check for call full or private class
     * if private , check for correct pass code
     */

    public function joinClass($cid = 0) {
        $postData = $this->input->post();
        $classId = ($cid != 0 && empty($postData)) ? $cid : $postData['classId'];
        $whereCondition = array('classId' => $classId);
        $classData = $this->logicalexpert_model->getSingleData('classes', $whereCondition);
        if (empty($classData)):
            $return = "Class not found!";
        else :
            $cid = $classData[0]['classId'];
            // check for attendee 
            $qry = "select count(*) as attendee from orders where orderClassId = $cid";
            $attendee = $this->logicalexpert_model->customQuery($qry);
            if ($attendee[0]['attendee'] < $classData[0]['attendee']) {
                if ($cid != 0 && empty($postData) && !$classData[0]['private']) {
                    $this->session->set_userdata('checkout', $cid);
                    redirect('login?redirect=checkout');
                }
                if ($postData['privateCode'] == $classData[0]['privatePassCode']) {
                    $return = 1;
                    $this->session->set_userdata('checkout', $cid);
                } else {
                    $return = "Pass Code is not correct";
                }
            } else {
                if ($cid != 0 && empty($postData) && !$classData[0]['private']) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Class Is Full Now</div>');
                    redirect('pages/courses');
                } else
                    $return = "Class is full now";
            }
        endif;
        echo $return;
        exit();
    }

    /*
     * checkout page from where the payment method will be selected 
     * and do the payment
     */

    public function checkout() {
        // class data
        $cid = $this->session->userdata('checkout');
        if (!empty($cid)) {
            $whereCondition = array('classId' => $cid);
            $classData = $this->logicalexpert_model->getSingleData('classes', $whereCondition);
            $this->data['classData'] = $classData[0];
        }
        // form data 
        $postData = $this->input->post();
        if (!empty($postData)) {

            switch ($postData['payment']) {
                case 'none' :
                    $this->data['msg'] = "<div class='alert alert-danger text-center'>Please select payment gateway first</div>";
                    break;
                case 'paypal':
                    redirect('paypalPayment');
                    break;
                case 'authorize':
                    redirect('authorizePayment');
                    break;
                case 'wireframe':
                    // send mail to admin and user
                    $uid = $this->session->userdata('user_logged_in')[0]['userId'];
                    $userData = $this->logicalexpert_model->getSingleData('users', array('userId' => $uid));
                    // prepare email for user
                    $to = $userData[0]['userEmail'];
                    $sub = "Payment Details";
                    $msg = "Account Number : +++++++<br>"
                            . "Bank Name : HDFC";
                    $this->logicalexpert_model->sendMail($to, $sub, $msg);
                    // prepare email for admin
                    $cid = $this->session->userdata('checkout');
                    $settings = $this->logicalexpert_model->getSingleData('settings', array('settingsId' => 1));
                    $toAdmin = $settings[0]['contactEmail'];
                    $subAdmin = "User contacted for join class";
                    $msgAdmin = "User Name : " . $userData[0]['userFName'] . "<br>"
                            . "User Email Id : " . $userData[0]['userEmail'] . "<br>"
                            . "Class ID : " . $cid;
                    $this->logicalexpert_model->sendMail($toAdmin, $subAdmin, $msgAdmin);
                    redirect('successOrder/2');
                    break;
                case 'creditCard' :
                    //validations for checkout form
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('userFName', 'First Name', 'trim|max_length[15]');
                    $this->form_validation->set_rules('card_type', 'Card Type', 'alpha_numeric');
                    $this->form_validation->set_rules('city', 'City', 'trim');
                    $this->form_validation->set_rules('street', 'Street', 'trim');
                    $this->form_validation->set_rules('zip_code', 'Zip Code', 'integer|max_length[8]|min_length[6]');
                    $this->form_validation->set_rules('card_number', 'Card Number', 'required|integer|max_length[19]');
                    $this->form_validation->set_rules('cvv_num', 'CVV', 'required|integer|max_length[3]|min_length[3]');
                    $this->form_validation->set_rules('month', 'Month', 'required|integer|max_length[2]');
                    $this->form_validation->set_rules('year', 'Year', 'required|integer|max_length[4]');
                    $this->form_validation->set_message('alpha_numeric', 'Please Select %s first');
                    if ($this->form_validation->run() == TRUE) {
                        // prepare data for paypal
                        $amt = $classData[0]['price'];
                        $cardType = $postData['card_type'];
                        $cardNumber = $postData['card_number'];
                        $cvv = $postData['cvv_num'];
                        $expDate = $postData['month'] . $postData['year'];
                        $fName = $postData['userFName'];
                        $lName = $postData['userLName'];
                        $state = $postData['state'];
                        $street = $postData['street'];
                        $city = $postData['city'];
                        $zip = $postData['zip_code'];
                        $countryCode = 'US';
                        // Add request-specific fields to the request string.  
                        $nvpStr = '&PAYMENTACTION=Sale&AMT=' . $amt . '&CREDITCARDTYPE=' . $cardType . '&ACCT=' . $cardNumber . '&EXPDATE=' . $expDate . '&CVV2=' . $cvv . '&FIRSTNAME=' . $fName . '&LASTNAME=' . $lName . '&STREET=' . $street . '&CITY=' . $city . '&STATE=' . $state . '&ZIP=' . $zip . '&COUNTRYCODE=' . $countryCode;
                        //echo $nvpStr='&PAYMENTACTION=Sale&AMT=8.88&CREDITCARDTYPE=Visa&ACCT=4683075410516684&EXPDATE=042016&CVV2=123&FIRSTNAME=John&LASTNAME=Smith&STREET=1+Main+St.&CITY=San+Jose&STATE=CA&ZIP=95131&COUNTRYCODE=US';
                        // Execute the API operation; see the PPHttpPost function above.  
                        $httpParsedResponseAr = $this->logicalexpert_model->PPHttpPost('DoDirectPayment', $nvpStr);  //TURN THIS ON TO MAKE THE PAYMENT LIVE  

                        if ($httpParsedResponseAr["ACK"] == 'Success') {
                            $data['orderUserId'] = $this->session->userdata('user_logged_in')[0]['userId'];
                            $data['orderTime'] = urldecode($httpParsedResponseAr['TIMESTAMP']);
                            $data['orderClassId'] = $this->session->userdata('checkout');
                            $data['orderPaymentReciptId'] = $httpParsedResponseAr['TRANSACTIONID'];
                            $data['orderStatus'] = $httpParsedResponseAr['ACK'];
                            $data['orderClassPaymentCount'] = 1;
                            $ret = $this->logicalexpert_model->insertData('orders', $data);
                            //$this->session->unset_userdata('checkout');
                            $this->data['msg'] = "<div class='alert alert-success text-center'>Payment successfully completed</div>";
                            redirect('successOrder/1');
                        } else {
                            $error = '';
                            for ($index = 0; $index < 10; $index++) {
                                if (isset($httpParsedResponseAr['L_LONGMESSAGE' . $index])) {
                                    $error .= urldecode($httpParsedResponseAr['L_LONGMESSAGE' . $index]) . '<br>';
                                }
                            }
                            $this->data['msg'] = "<div class='alert alert-danger text-center'>" . $error . "</div>";
                        }
                    }
            }
        }
        $this->load->template('v_checkout', $this->data);
    }

    /*
     * paypal payment gateway
     */

    public function paypalPayment() {
        $cid = $this->session->userdata('checkout');
        if (empty($cid))
            redirect('pages/courses');
        $whereCondition = array('classId' => $cid);
        $whereCondSetting = array('settingsId' => 1);
        $classData = $this->logicalexpert_model->getSingleData('classes', $whereCondition);
        $settings = $this->logicalexpert_model->getSingleData('settings', $whereCondSetting);
        $this->data['classData'] = $classData[0];
        $this->data['merchantId'] = $settings[0]['gatewayApi'];
        $this->load->template('v_payment', $this->data);
    }

    /*
     * authorize.net payment gateway
     * SIM (simple integration method) method used
     */

    public function authorizePayment() {
        $cid = $this->session->userdata('checkout');
        if (empty($cid))
            redirect('pages/courses');

        $whereCondSetting = array('settingsId' => 1);
        $classData = $this->logicalexpert_model->getSingleData('classes', $whereCondition);
        $settings = $this->logicalexpert_model->getSingleData('settings', $whereCondSetting);
        $this->data['classData'] = $classData[0];
        $this->data['gatewayData'] = $settings[0];
        $this->load->template('v_authorize', $this->data);
    }

    /*
     * page call after payment completed from paypal or authorize.net
     */

    public function successOrder($init = 0) {
        if ($this->session->userdata('checkout') == '') {
            redirect('pages/courses');
        }
        $cid = $this->session->userdata('checkout');
        // show video after payment
        if ($init != 2) {
            $this->data['css'] = "<link href='" . URL . "assets/front/css/minimalist.css' type='text/css' rel='stylesheet'>";
            $this->data['js'] = "<script src='" . URL . "assets/front/js/flowplayer.min.js' type='text/javascript'></script>";
            $whereCondition = array('classId' => $cid);
            $classData = $this->logicalexpert_model->getSingleData('classes', $whereCondition, '', '', array('classVideo'));
            $this->data['classVideo'] = $classData[0]['classVideo'];
        }
        $this->data['orderCheck'] = true;
        $postData = ($this->input->post()) ? $this->input->post() : array();
        $ret = '';
        if ((!empty($postData)) || (!empty($init) && $init == 1)) {
            if (!empty($postData)) {
                if (array_key_exists("x_response_code", $postData)) {
                    // prepare data for authorize.net payment gateway
                    $data['orderUserId'] = $this->session->userdata('user_logged_in')[0]['userId'];
                    $data['orderTime'] = date('Y-m-d H:i:s');
                    $data['orderClassId'] = $cid;
                    $data['orderPaymentReciptId'] = $postData['x_trans_id'];
                    $data['orderStatus'] = 'Success';
                    $data['orderClassPaymentCount'] = 1;
                } elseif (array_key_exists("txn_id", $postData)) {
                    // prepare data for paypal payment gateway
                    $data['orderUserId'] = $this->session->userdata('user_logged_in')[0]['userId'];
                    $data['orderTime'] = $postData['payment_date'];
                    $data['orderClassId'] = $cid;
                    $data['orderPaymentReciptId'] = $postData['txn_id'];
                    $data['orderStatus'] = $postData['payment_status'];
                    $data['orderClassPaymentCount'] = 1;
                }
                $ret = $this->logicalexpert_model->insertData('orders', $data);
            }
            if ($ret || $init == 1) {
                // prepare email for user
                $to = $this->session->userdata('user_logged_in')[0]['userEmail'];
                $sub = "Payment Successful";
                $msg = "Your payment has been confirmed";
                $this->logicalexpert_model->sendMail($to, $sub, $msg);
                $this->session->unset_userdata('checkout');
            } else {
                $this->data['orderCheck'] = false;
                $this->data['msg'] = "<div class='alert alert-danger text-center'>Payment not successful</div>";
            }
        } elseif ($init == 2) {
            $this->session->unset_userdata('checkout');
            $this->data['orderCheck'] = false;
            $this->data['msg'] = "<div class='alert alert-success text-center'>Bank details has been sent to your mail id</div>";
        } else {
            $this->data['orderCheck'] = false;
            $this->data['msg'] = "<div class='alert alert-danger text-center'>No Payment found</div>";
        }
        $this->load->template('v_successOrder', $this->data);
    }

    public function detail($viewName, $viewId) {
        $columns = '';
        $joinData = '';
        // switch of pages and prepare data accordingly for each
        switch ($viewName) {
            case 'courses' :
                // prepare where condition AND join
                $joinData = array('users as us' => 'us.userId = tb.createdBy ');
                $whereCondition = array('courseId' => $viewId);
                break;
            case 'classes' :
                // prepare where condition , join and columns to fetch
                $whereCondition = array('classId' => $viewId);
                $joinData = array('users as us' => 'us.userId = tb.createdBy ', 'courses as co' => 'co.courseId = tb.courseId');
                //$columns = array('tb.classId','tb.className', 'tb.startDate', 'tb.endDate', 'tb.duration', 'tb.time', 'tb.price', 'tb.paymentType', 'co.courseName', 'us.userName');
                break;
        }
        $return = $this->logicalexpert_model->getSingleData($viewName . ' as tb', $whereCondition, '', $joinData, $columns);
        $this->data['singleData'] = (!empty($return)) ? $return[0] : 0;
        $this->load->template('v_' . $viewName . 'Detail', $this->data);
    }

}
