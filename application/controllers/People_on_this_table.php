<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	require('application/libraries/REST_Controller.php');  
	//error_reporting(0);

	/**
	* Sign up form controller
	*/
	class People_on_this_table extends REST_Controller
	{
		public function People_on_this_table() {
			parent::__construct();

			$this->load->model('People_on_this_table_model');
			$this->load->library('seekahoo_lib');
			$this->load->library('Validator.php');
			$this->load->database();
		}
		
		public function people_on_this_table_post()
		{
			$serviceName = 'People_on_this_table';
			//getting posted values
			$ip['table_id'] = $this->input->post('table_id');


			$ipJson = json_encode($ip);
			    
				//validation
				$validation_array = 1;
									
				$ip_array[] = array("table_id", $ip['table_id'], "not_null", "table_id", "Field is empty.");
			
				$validation_array = $this->validator->validate($ip_array);
				
				
        		if ($validation_array !=1) 
				{
				 $data['message'] = $validation_array;
				 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
				} 
				else
				{
                    $data['People_on_this_table'] =$this->People_on_this_table_model->people_on_this_table($ip, $serviceName);
                    $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
				}



		          header("content-type: application/json");
		          echo $retVals1;
		          exit;
	    }

	}
?>