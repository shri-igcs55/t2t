<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	require('application/libraries/REST_Controller.php');  
	//error_reporting(0);

	/**
	* Sign up form controller
	*/
	class My_table extends REST_Controller
	{
		public function My_table() {
			parent::__construct();

			$this->load->model('My_table_model');
			$this->load->library('seekahoo_lib');
			$this->load->library('Validator.php');
			$this->load->database();
		}
		
		public function my_table_post()
		{
			$serviceName = 'My_table';
			//getting posted values
			$ip['user_id'] = $this->input->post('user_id');


			$ipJson = json_encode($ip);
			    
				//validation
				$validation_array = 1;
									
				$ip_array[] = array("user_id", $ip['user_id'], "not_null", "user_id", "Field is empty.");
			
				$validation_array = $this->validator->validate($ip_array);
				
				
        		if ($validation_array !=1) 
				{
				 $data['message'] = $validation_array;
				 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
				} 
				else
				{
                    $data['My_table'] =$this->My_table_model->my_table($ip, $serviceName);
                    $data['Other_table'] =$this->My_table_model->other_table($ip, $serviceName);
                    $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
				}



		          header("content-type: application/json");
		          echo $retVals1;
		          exit;
	    }

	}
?>