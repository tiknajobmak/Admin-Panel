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
            $data['menuData'][$menu['menuName']] = $this->logicalexpert_model->getAllData('menuMeta',$whereCondition,$joinData,array('pages.pageId','pages.handle' , 'pages.title' , 'menuMeta.menuParent as parent', 'menuMeta.menuPosition' , 'menuMeta.menuMetaId'),'','',$sort);
        }
        $data['heading'] = 'Navigations';
        $this->load->view('admin/navigation' , $data);
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
}