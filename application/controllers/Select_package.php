<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	require('application/libraries/REST_Controller.php');  
	//error_reporting(0);

	/**
	* Sign up form controller
	*/
	class Select_package extends REST_Controller
	{
		public function Select_package() {
			parent::__construct();

			$this->load->model('Select_package_model');
			$this->load->library('seekahoo_lib');
			$this->load->library('Validator.php');
			$this->load->database();
		}
		
		public function select_package_post()
		{
			$serviceName = 'select_package';
			//getting posted values
			
		
			$ip['user_id'] = $this->input->post('user_id');

			$ip['package']  = $this->input->post('package');
//var_dump($ip['table']);
//exit();


			$ipJson = json_encode($ip);
			    
				//validation
				$validation_array = 1;
									
				$ip_array[] = array("user_id", $ip['user_id'], "not_null", "user_id", "Field is empty.");
				$ip_array[] = array("package", $ip['package'], "not_null", "package", "Field is empty.");
			
				$validation_array = $this->validator->validate($ip_array);
				
				
        		if ($validation_array !=1) 
				{
				 $data['message'] = $validation_array;
				 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
				} 
				else
				{
                    //$data['Select_package'] =$this->Select_package_model->select_package($ip, $serviceName);
                    $data['message'] = "Inserted Successfully";
                    $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
				}



		          header("content-type: application/json");
		          echo $retVals1;
		          exit;
	    }

	}
?>