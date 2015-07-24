<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
include("base/PPPro.php");

class PPBMSetInventory extends PPPro{

	public $method = "BMSetInventory";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //

// ---------- Optional Parameters ----------------------------------------------------------------------- //



	
}

/* End of file third_party/paypal/libraries/PPBMSetInventory.php */