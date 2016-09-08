<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require('application/libraries/REST_Controller.php');  
	//error_reporting(0);

	/**
	* Sign up form controller
	*/
	class Show_category extends REST_Controller
	{
		public function Show_category() {
			parent::__construct();

			$this->load->model('Show_category_model');
			$this->load->library('seekahoo_lib');
			$this->load->database();

			//$this->load->library('Validator.php');

		}
		
		public function show_category_get()
		{
			
			$serviceName = 'Show_category';
			
						$retVals1 =$this->Show_category_model->show_category();

						$data['Show_category'] = $retVals1;	
                           //$retVals1 = $this->Enquiry_form_model->enquiry_form($ip, $serviceName);
                          $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, '');
						   	
					

     		          //echo $retVals1 = $this->signup_model->signup($ip, $serviceName);
			          header("content-type: application/json");
			          echo $retVals1;
			          exit;
	     	}

	}
?>