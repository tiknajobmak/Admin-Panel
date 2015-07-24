<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
include("base/PPPro.php");

class PPGetPalDetails extends PPPro{

	public $method = "GetPalDetails";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //

}

/* End of file third_party/paypal/libraries/PPGetPalDetails.php */