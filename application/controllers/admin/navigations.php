<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Navigations extends CI_Controller {
    public $counter = 1;
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
    }
    /*
     * categories listing page
     */   
    public function index(){
        // load sidebar and header
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $data['js'] = "<script src=".URL."assets/admin/js/jquery.nestable.js></script>";
        $sort = array('sortCol' => 'menuPosition','orderBy' => 'asc');
        $getMenu = $this->logicalexpert_model->getAllData('menu');
        foreach ($getMenu as $menu){
            $whereCondition = array('status' => 1 , 'menuMenuId' => $menu['menuId']);
            $joinData = array('pages' => 'pageId = menuPageId' , 'menu' => 'menuId = menuMenuId');
            $data['menuData'][$menu['menuName'].'_'.$menu['menuId']] = $this->logicalexpert_model->getAllData('menuMeta',$whereCondition,$joinData,array('pages.pageId','pages.handle' , 'pages.title' , 'menuMeta.menuParent as parent', 'menuMeta.menuPosition' , 'menuMeta.menuMetaId'),'','',$sort);
        }
        $data['heading'] = 'Navigations';
        $this->load->view('admin/navigation' , $data);
    }
    public function add(){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $viewData['submitButton'] = 'Save';
        $viewData['formUrl'] = 'navigations/add';
        $viewData['heading'] = "Add Navigation";
        // get pages
        $viewData['pages'] = $this->logicalexpert_model->getAllData('pages',array('status' => 1) , '' , array('title' , 'pageId'));
        if($this->input->post()){
            $validationError = $this->formValidations();
            if($validationError == TRUE){
                $data = $this->input->post();
                $menuData['menuName'] = url_title($data['menuName'], '-', TRUE);
                $menuData['menuTitle'] = $data['menuName'];
                $ret = $this->logicalexpert_model->insertData('menu' ,$menuData);
                if($ret)
                {
                    // add menu detail in menuMeta table
                    foreach ($data['pages'] as $pages){
                        $menuMetaData[] = array('menuMenuId'=> $ret , 'menuPageId' => $pages);
                    }
                    $retMeta = $this->logicalexpert_model->insertMultipleData('menuMeta' ,$menuMetaData);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Course has been Saved Successfully!</div>');
                }
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Some Error Occur!</div>');
                redirect(ADMIN_URL.'navigations');
            }
        }
        $this->load->view('admin/addNavigation' , $viewData);
    }
    public function edit($menuId){
        $this->load->view('admin/templates/sidebar.php');
        $this->load->view('admin/templates/header.php');
        $viewData['submitButton'] = 'Update';
        $viewData['formUrl'] = 'navigations/edit/'.$menuId;
        $viewData['heading'] = "Update Navigation";
        // get pages
        $viewData['pages'] = $this->logicalexpert_model->getAllData('pages',array('status' => 1) , '' , array('title' , 'pageId'));
        // get pages for edit
        $viewData['selPages'] = $this->logicalexpert_model->getAllData('menuMeta',array('menuMenuId' => $menuId) , '' , array('menuPageId'));
        $viewData['result'] = $this->logicalexpert_model->getSingleData('menu', array('menuId' => $menuId));
        $viewData['result'] = $viewData['result'][0];
        if($this->input->post()){
            $data = $this->input->post();
            $menuData['menuName'] = url_title($data['menuName'], '-', TRUE);
            $menuData['menuTitle'] = $data['menuName'];
            if($menuData['menuName'] == $viewData['result']['menuName'] )
                $val = FALSE;
            else
                $val = TRUE;
            $validationError = $this->formValidations($val);
            if($validationError == TRUE){
                $ret = $this->logicalexpert_model->updateData('menu' ,$menuData , 'menuId' , $menuId);
                // update menu detail in menuMeta table
                foreach ($data['pages'] as $pages){
                    $menuMetaData[] = array('menuPageId' => $pages , 'menuMenuId' => $menuId);
                }
                $deleteCheck = $this->logicalexpert_model->deleteData('menuMeta' , 'menuMenuId' , $menuId);
                if($deleteCheck)
                    $retMeta = $this->logicalexpert_model->insertMultipleData('menuMeta' ,$menuMetaData);

                $retMeta = $this->logicalexpert_model->updateMultipleData('menuMeta' ,$menuMetaData , 'menuPageId');
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Course has been Saved Successfully!</div>');                
                redirect(ADMIN_URL.'navigations');
            }
        }
        $this->load->view('admin/addNavigation' , $viewData);
    }
    public function delete($menuId){
        
          if($menuId != ''){
            $deleteCheck = $this->logicalexpert_model->deleteData('menu' , 'menuId' , $menuId);
            if($deleteCheck)
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Menu has been Deleted Successfully!</div>');
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Menu not found</div>');
       }
       redirect(ADMIN_URL.'navigations');
    }
    /*
     * ajax handler for navigation
     */
    public function changeMenu(){
        $array = JSON_decode($this->input->post('menu'));
        print_r($array);
        $this->recursionLoop($array);
        exit;
    }
    /*
     * recursive loop function to update menu
     * @param {array} menus
     * @param {integer} ids
     * @returns {recursive}
    */
    public function recursionLoop($menus , $ids=0)
    {
        $col = 'menuMetaId';
        foreach ($menus as $menu ){
            $val = $menu->id;
            //echo "parent = $ids and child = $menu->id<br>";
            $data = array('menuParent' => $ids , 'menuPosition' => $this->counter++);
            if(isset($menu->children) || !empty($menu->children)  ){
                $ret = $this->logicalexpert_model->updateData('menuMeta' ,$data ,$col , $val);
                $this->recursionLoop($menu->children , $menu->id );
            }
            
        }    
    }
    /*
     * function used to set validations
     * @param :- $updateCheck : check update or save
     * $validatehandle : whether to validate handle
     */
    public function formValidations($noVal = TRUE){
        $this->load->library('form_validation');
        $is_unique = ($noVal == TRUE) ? '|callback_menuNameCheck' : '';
        $this->form_validation->set_rules('menuName', 'Menu Title', 'trim|required|max_length[50]'.$is_unique );
        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        return TRUE;
    }
    public function menuNameCheck($param) {
        $menuName = url_title($param, '-', TRUE);
        $menuHandle = $this->logicalexpert_model->getSingleData('menu', array('menuName' => $menuName));
        if($menuHandle){
            $this->form_validation->set_message('menuNameCheck', 'This Menu Name is already Present');
            return FALSE;
        }
        return TRUE;
        exit;
    }
}