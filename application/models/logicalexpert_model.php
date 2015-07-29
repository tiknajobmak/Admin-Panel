<?php

class LogicalExpert_model extends CI_Model {

    function __construct() {
        $this->load->database(); // load databse library in constructor
    }

    /*
     * check for login
     * @param {string} $tableName
     * @param {string} $data
     * @param {array} $userTypeArr
     * @returns {array}
     */

    public function getUser($tableName = '', $data = '', $userTypeArr, $join = array()) {
        $this->db->select('*');
        $this->db->from($tableName);
        if ($join != '') {
            foreach ($join as $tbName => $condition) {
                $this->db->join($tbName, $condition, 'left');
            }
        }
        $this->db->where("(userName = '" . $data['username'] . "'OR userEmail = '" . $data['username'] . "')");
        $this->db->where('userPass', $data['password']);
        $this->db->where('userStatus', 1);
        // check user type
        $this->db->where_in('userType', $userTypeArr);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     * fetch all records
     * @param {string} $tableName
     * @param {string} $whereCol
     * @param {string} $whereVal
     * @param {string} $type (array/object)
     * @param {string} $limit (number of records in one time)
     * @param {string} $offset (start record)
     * @param {array} $sortData
     * @param {array} $join ( Data to join tables )
     * @param {array} $joinType
     * @param {array} $colName ( column to fetch )
     * @param {array} $groupBy
     * @returns {array/object}
     */

    public function getAllData($tableName, $whereCondition = '',$join = '' , $colName = '',  $limit = '', $offset = '', $sortData = '',$groupBy = '' , $joinType = 'left',  $like = 0, $orLike = 0, $status = 0 , $type = 'array') {
        if ($colName != '')
            $this->db->select($colName);
        $this->db->from($tableName);
        if ($join != '') {
            foreach ($join as $tbName => $condition) {
                $this->db->join($tbName, $condition, 'LEFT');
            }
        }
        if ($limit != '')
            $this->db->limit($limit, $offset);
        if ($whereCondition != '')
            $this->db->where($whereCondition);
        if ($sortData != '')
            $this->db->order_by($sortData['sortCol'], $sortData['orderBy']);
        if ($like != 0)
            $this->db->like($like);
        if ($groupBy != 0)
            $this->db->group_by($groupBy); 
        if ($orLike != 0) {
            foreach ($orLike as $col => $cond) {
                $this->db->or_like($col, $cond);
            }
        }
        $query = $this->db->get();
        //echo $this->print_query();
        //exit;
        return ($type == 'object') ? $query->result() : $query->result_array();
    }

    /*
     * fetch single record
     * @param {string} $tableName
     * @param {string} $whereCondition
     * @param {string} $type (array/object)
     * @param {array} $join ( Data to join tables )
     * @returns {array/object}
     */

    public function getSingleData($tableName, $whereCondition, $type = "array", $join = '', $colName = '') {
        if ($colName != '')
            $this->db->select($colName);
        $this->db->from($tableName);
        if ($join != '') {
            foreach ($join as $tbName => $condition) {
                $this->db->join($tbName, $condition , 'left');
            }
        }
        $this->db->where($whereCondition);
        $query = $this->db->get();
        //echo $this->print_query();
        return ($type == 'object') ? $query->result() : $query->result_array();
    }

    /*
     * Insert record
     * @param {string} $tableName
     * @param {array} $data
     * @returns {array/object}
     */

    public function insertData($tableName, $data) {
        $this->db->insert($tableName, $data);
        return $insert_id = $this->db->insert_id();
    }
    /*
     * Insert record
     * @param {string} $tableName
     * @param {array} $data
     * @returns {array/object}
     */

    public function insertMultipleData($tableName, $data) {
        $this->db->insert_batch($tableName, $data);
        return $insert_id = $this->db->insert_id();
    }

    /*
     * update record
     * @param {string} $tableName
     * @param {array} $data
     * @param {string} $updateIdCol
     * @param {string} $updateIdVal
     * @returns {int}
     */

    public function updateData($tableName, $data, $updateIdCol, $updateIdVal) {
        $this->db->where($updateIdCol, $updateIdVal);
        $this->db->update($tableName, $data);
        return $this->db->affected_rows();
    }
    /*
     * update record
     * @param {string} $tableName
     * @param {array} $data
     * @param {string} $updateIdCol
     * @param {string} $updateIdVal
     * @returns {int}
     */

    public function updateMultipleData($tableName, $data, $key) {
        //$this->db->where($updateIdCol, $updateIdVal);
        $this->db->update_batch($tableName, $data , $key);
        return $this->db->affected_rows();
    }

    /*
     * delete record
     * @param {string} $tableName
     * @param {string} $whereCol
     * @param {string} $whereVal
     * @returns {int}
     */

    public function deleteData($tableName, $whereCol = '', $whereVal = '') {
        $this->db->delete($tableName, array($whereCol => $whereVal));
        return $this->db->affected_rows();
    }

    /*
     * delete multiple records
     * @param {string} $tableName
     * @param {string} $whereCol
     * @param {string} $whereVal
     * @returns {int}
     */

    public function deleteMultiple($tableName, $whereCol = '', $whereVal = '') {
        $this->db->where_in($whereCol, $whereVal);
        $this->db->delete($tableName);
        return $this->db->affected_rows();
    }

    /*
     * Count number of rows
     * @param {string} $tableName
     * @param {string} $whereCol
     * @param {string} $whereVal
     * @returns {int}
     */
    public function countRecord($tableName, $whereCondition,$join = '' , $limit = '', $offset = '',$groupBy = '' , $joinType = 'left',  $like = 0, $orLike = 0, $status = 0 , $type = 'array'){
            $this->db->select('COUNT(*) AS `numrows`');
            if ($join != '') {
                foreach ($join as $tbName => $condition) {
                    $this->db->join($tbName, $condition, 'INNER');
                }
            }
            if ($limit != '')
                $this->db->limit($limit, $offset);
            if ($whereCondition != '')
                $this->db->where($whereCondition);
            if ($like != 0)
                $this->db->like($like);
            if ($groupBy != 0)
                $this->db->group_by($groupBy); 
            if ($orLike != 0) {
                foreach ($orLike as $col => $cond) {
                    $this->db->or_like($col, $cond);
                }
            }
            $query = $this->db->get($tableName);
            return $query->row()->numrows;

    }
    public function countRows($tableName, $whereCol = '', $whereVal = '', $like = 0, $orLike = 0, $status = 0 , $join = '') {
        $this->db->select('COUNT(*) AS `numrows`');
        if ($join != '') {
            foreach ($join as $tbName => $condition) {
                $this->db->join($tbName, $condition , 'left');
            }
        }
        if ($whereCol != '')
            $this->db->where(array($whereCol => $whereVal));
        if ($status == 1)
            $this->db->where('status', 1);
        if ($like != 0)
            $this->db->like($like);
        if ($orLike != 0) {
            foreach ($orLike as $col => $cond) {
                $this->db->or_like($col, $cond);
            }
        }
        $query = $this->db->get($tableName);
        return $query->row()->numrows;
    }

    /*
     * Generate a random string with 10 character
     */

    public function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /*
     * Execute custom Query
     * @param {string} $qry
     * @returns {array}
     */

    public function customQuery($qry) {
        $query = $this->db->query($qry);
        return $query->result_array();
    }
    /*
     * return last executed query
     */
    public function print_query() {
        return $this->db->last_query();
    }
    /*
     * send mail
     * @param {string} $to 
     * @returns {string} $sub
     * @returns {array} $msg
     */
    public function sendMail($to, $sub, $msg) {
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from('abc@abc.com', 'Logic Expert Information Mail');
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);
        return $this->email->send();
    }

    /*
     * call paypal api for credit card payment
     * @param {string} $methodName (dodirectpayment)
     * @returns {string} $nvpStr_ ( string to call API )
     * @returns {array} api response
     */

    public function PPHttpPost($methodName_, $nvpStr_) {
        // Set up your API credentials, PayPal end point, and API version.  
        //$environment = 'live';                                      //live or sandbox  
        $environment = 'sandbox';                                      //live or sandbox  
        $API_UserName = urlencode('vipuln_1349947071_biz_api1.yahoo.com');           //paypal api username  
        $API_Password = urlencode('1349947145');              //paypal api password  
        $API_Signature = urlencode('A2JzD249c4LtceKyb5C0vw0LR8DBAuqr-7XGgDlVCnszDXlueE2cPb86');   //paypal api signature  

        if ($environment == 'sandbox') //// live 
            $subenvi = 'sandbox';  // $subenvi = ''; 
        else
            $subenvi = $environment . '.';

        $API_Endpoint = 'https://api-3t.' . $subenvi . '.paypal.com/nvp';

        $version = urlencode('51.0');                               //paypal version  
        // Set the curl parameters.  
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the API operation, version, and API signature in the request.  
        $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
        // Set the request as a POST FIELD for curl.  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
        // Get response from the server.  
        $httpResponse = curl_exec($ch);
        if (!$httpResponse) {
            exit("$methodName_ failed: " . curl_error($ch) . '(' . curl_errno($ch) . ')');
        }
        // Extract the response details.  
        $httpResponseAr = explode("&", $httpResponse);

        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }
        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
        }
        return $httpParsedResponseAr;
    }
     /* total number of users visited the site
      * @param {array} $tableName
     *  @returns {integer} number of users
     */
    public function countTotalUsersVisited($tableName , $type = 'array'){
        $this->db->select('COUNT(*) AS `count`');
        $this->db->from($tableName);
        $query = $this->db->get();
        return ($type == 'object') ? $query->result() : $query->result_array();
    }
    
    /* 
     * Recursive loop to generate multidimentional array having parent child relation
     * @param {array} $nav (array to generate parent child relation) 
     * @param  {integer} $parent ( ul attr )
     * @returns array
     */
    public function displayMenu($arr , $parent = 0){
        $pages = Array();
        foreach ($arr as $page) {
            if ($page['parent'] == $parent) {
                $page['sub'] = isset($page['sub']) ? $page['sub'] : $this->displayMenu($arr, $page['menuMetaId']);
                $pages[] = $page;
            }
        }
        return $pages;
    }
     
    /* 
     * Recursive loop to generate the HTML for menu from multidimentional array
     * @param {array} $nav (array with parent child relation) 
     * @param  {string} $ulAttr ( ul attr )
     * @param  {string} $liAttr ( li attr )
     * @returns HTML for menu
     */
    public function generateNavHTML($nav , $ulAttr  , $liAttr ) {
        $html = '<ul '.$ulAttr.'>';
        foreach ($nav as $page) {
            $html .= '<li '.$liAttr.' data-id="' . $page['pageId'] . '">';
            $html .= '<a href='.URL.'pages'.$page['handle'].'">' . $page['title'] . '</a>';
            $html .= $this->GenerateNavHTML($page['sub'] , $ulAttr , $liAttr);
            $html .= '</li>';
        }
        $html .= "</ul>";
        return $html;
    }
    /*
     * @param {string} $menuName (menu nanme to call) 
     * @param  {string} $ulAttr ( ul attr for u; )
     * @param  {string} $liAttr ( string to call API )
     * @returns HTML for menu
     */

    public function menu($menuName , $ulAttr , $liAttr){
        $sort = array('sortCol' => 'menuPosition','orderBy' => 'asc');
        $whereCondition = array('status' => 1 , 'menuName' => $menuName);
        $joinData = array('pages' => 'pageId = menuPageId' , 'menu' => 'menuId = menuMenuId');
        $pages = $this->getAllData('menuMeta',$whereCondition,$joinData,array('pages.pageId','pages.handle' , 'pages.title' , 'menuMeta.menuParent as parent', 'menuMeta.menuPosition' , 'menuMeta.menuMetaId'),'','',$sort);
        $nav = $this->displayMenu($pages);
        return $this->generateNavHTML($nav , $ulAttr ,  $liAttr);
    }

}
