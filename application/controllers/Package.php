<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require('application/libraries/REST_Controller.php');  
	//error_reporting(0);

	/**
	* Sign up form controller
	*/
	class Package extends REST_Controller
	{
		public function Package() {
			parent::__construct();

			$this->load->model('Package_model');
			$this->load->library('seekahoo_lib');
			$this->load->library('Validator');
			$this->load->database();

		}
		
		public function package_get()
		{
			
			$serviceName = 'Package';
			
						$retVals1 =$this->Package_model->package();

						$data['Package_list'] = $retVals1;	
                           //$retVals1 = $this->Enquiry_form_model->enquiry_form($ip, $serviceName);
                          $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, '');
						   	
					

     		          //echo $retVals1 = $this->signup_model->signup($ip, $serviceName);
			          header("content-type: application/json");
			          echo $retVals1;
			          exit;
	     	}

	}
?>