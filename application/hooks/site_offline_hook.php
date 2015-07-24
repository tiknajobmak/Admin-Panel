<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Check whether the site is offline or not.
 *
 */
class site_offline_hook {

    public function __construct() {
        log_message('debug', 'Accessing site_offline hook!');
    }

    public function is_offline() {
        if (file_exists(APPPATH . 'config/config.php')) {
            include(APPPATH . 'config/config.php');
            // make instance of all loaded classes
            $CI =& get_instance();
            // get settings from database
            $query = $CI->db->query('SELECT * FROM settings');
            $settings = $query->result_array();
            
            // check admin or login page
            // Get the 1st segment
            $segment = $CI->uri->segment(1);
            if (isset($settings[0]['siteOffline']) && ($settings[0]['siteOffline'] == 1) && (($segment != 'admin') && ($segment != 'adminLogin')) ) {
                $this->show_site_offline($settings[0]['siteOfflineDesc']);
                exit;
            }
        }
    }

    private function show_site_offline($desc) {
        echo $desc;
    }

}

/* Location: ./system/application/hooks/site_offline_hook.php */