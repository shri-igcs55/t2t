<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require('application/libraries/REST_Controller.php');  
	//error_reporting(0);

	/**
	* Sign up form controller
	*/
	class User extends REST_Controller
	{
		public function User() {
			parent::__construct();

			$this->load->model('User_model');
			$this->load->library('email');
			$this->load->library('upload');
			$this->load->library('uploader');
			$this->load->library('seekahoo_lib');
			$this->load->library('Validator');
			$this->load->database();
    	}
		
		public function user_signup_post()
		{
			$six_digit_random_number = mt_rand(100000, 999999);
			$serviceName = 'user_signup';
			//getting posted values
			$ip['name']              = trim($this->input->post('name'));
			$ip['email']             = trim($this->input->post('email'));
			$ip['phone']             = trim($this->input->post('phone'));
			$ip['password']          = trim($this->input->post('password'));
			$ip['c_password']        = trim($this->input->post('c_password'));
			//$ip['user_otp']         = $six_digit_random_number;

            $ip['created_datetime']  = Date('Y-m-d h:i:s');
             

             $ipJson = json_encode($ip);
			
			//validation
			$validation_array = 1;
					//$ip_array[] = array("name", $ip['name'], "not_null", "name", "Name is empty.");

					$ip_array[] = array("email", $ip['email'], "not_null", "email", "E-Mail is empty.");

					$ip_array[] = array("phone", $ip['phone'], "not_null", "phone", "Mobile number is empty.");
					
					
					$validation_array = $this->validator->validate($ip_array);
					
					if($ip['password'] != $ip['c_password'])
					 {
				     $data['message'] = "Password missmatch.";
				     $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
                     } 
					else if(empty($_POST['password']))
					 {
					  $data['message'] = "Password field empty.";
				      $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					 }


					 else if ($this->User_model->check_mob($ip)) 
					 {
					  $data['message'] = 'Mobile number alerady registered.';
					 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					 } 

					else if ($this->User_model->check_email($ip)) 
					{
					 $data['message'] = 'Email address alerady registered.';
					 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					}

					else if ($validation_array !=1) 
					{
					 $data['message'] = $validation_array;
					 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					} 
					else  {
                           $retVals1 = $this->User_model->signup($ip, $serviceName);
	
			               
					      }

     		          //echo $retVals1 = $this->user_model->signup($ip, $serviceName);
			          header("content-type: application/json");
			          echo $retVals1;
			          exit;
	     	}


/*Sign in Section*/
        public function user_signin_post(){
		$serviceName = 'user_signin';
		//getting posted values
		$ip['email'] = trim($this->input->post('email'));
		$ip['password'] = trim($this->input->post('password'));
		$ipJson = json_encode($ip);

		//validation
		$validation_array = 1;
			$ip_array[] = array("email", $ip['email'], "email", "email_id", "Wrong or Invalid Email address.");
			$ip_array[] = array("password", $ip['password'], "not_null", "password", "Password is empty.");
			$validation_array = $this->validator->validate($ip_array);
			if ($validation_array !=1) {
				$data['message'] = $validation_array;
				$retVals = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
				json_decode($retVals1);
			} 
			else {
				$retVals = $this->User_model->check_signin($ip, $serviceName);
			}
		
		header("content-type: application/json");
		echo $retVals;
		exit;
	}
/*End of Sign in Section*/
/*Verification Section*/




/*End of Resend Otp Section*/
/* chng_pass Section*/
 public function chng_pass_post()
		{
			$serviceName = 'change password';
			//getting posted values
			$ip['old_password']    = trim($this->input->post('old_password'));
			$ip['new_password']    = trim($this->input->post('new_password'));
		    $ip['c_password']      = trim($this->input->post('c_password'));
		    $ip['phone']           = trim($this->input->post('phone'));
		    //$ip['name']            = trim($this->input->post('name'));
          $ipJson = json_encode($ip);


			//var_dump($_FILES['user_pic']);exit();
           // print_r($ip); exit();
			 if (!null==($ipJson = json_encode($ip)))
               {
               	/*=================GENRAING OTP=====================*/
	             $user="developer22211@indglobal-consulting.com:indglobal123";

			    $sender ="TEST SMS";
			    $number = $ip['mobile'];
			    $name   = "Dear User";//$ip['user_name'];
			     $message="Hi:".$name." Your Password is Changed Successfully You can Login in Few minutes - table_to_talk.com"; 
			     $ipJson = json_encode($ip);
                 $chk_pass=$this->User_model->c_pass($ip);
                 /*=================ENDING OF GENRAING OTP=====================*/
				}
			
			//validation
			$validation_array = 1;
									
					$ip_array[] = array("old_password", $ip['old_password'], "not_null", "old_password", "Old password is empty.");

					$ip_array[] = array("new_password", $ip['new_password'], "not_null", "new_password", "New password is Empty.");
					
					$ip_array[] = array("c_password", $ip['c_password'], "not_null", "c_password", "Conifirm password is empty.");

					$ip_array[] = array("phone", $ip['phone'], "not_null", "phone", "Mobile number is empty.");


					$validation_array = $this->validator->validate($ip_array);
					
					
                    if($ip['new_password'] != $ip['c_password'])
					 {
				     	$data['message'] = "Password missmatch.";
				     	$retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
                     }

					else if ($validation_array !=1) 
					{
					 	$data['message'] = $validation_array;
					 	$retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					} 

					else if ($chk_pass=="True") 
					{
					  $change=$this->User_model->c_pass($ip);
						$data['message'] = "Paasword Changed Successfully";
					 	$retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);

					} 
					else  
					{
					  	//$done_otp=$this->update_model->updt_status_with($ip);
					  	$data['message'] = "Paasword Not Correct";
					  	$retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					  	json_decode($retVals1);
					  
					}

     		         	//echo $retVals1 = $this->signup_model->signup($ip, $serviceName);
			          	header("content-type: application/json");
			            echo $retVals1;
			            exit;
	     	}     



 /*End of chng_pass Section*/
/* Update Section*/

public function update_brief_post()
		{
			$six_digit_random_number = mt_rand(100000, 999999);
			$serviceName = 'update_breif';
			 $filename = $_FILES['image']['name'];
            

           $flag = "profile";
           $add_pic['user_id'] = trim($this->input->post('user_id'));
           $add_pic['flag'] = $flag;
           if(!empty($_FILES['image']['name'])){
           $target_file = $this->uploader->upload_image($_FILES['image'], $flag,$add_pic);
           }
           //print_r($target_file);die();

           $ip['image']  = $target_file['profile_org_url'];
			//getting posted values
			$ip['user_id']        = trim($this->input->post('user_id'));
			$ip['dateofbirth']    = trim($this->input->post('dateofbirth'));
			$ip['occupation']     = trim($this->input->post('occupation'));
			$ip['company']        = trim($this->input->post('company'));
			$ip['gender']         = trim($this->input->post('gender'));
			$ip['city']           = trim($this->input->post('city'));
		    $ip['web']            = trim($this->input->post('web'));
		    $ip['image']          = $target_file['profile_org_url'];
		    //$ip['created_at']     = Date('Y-m-d h:i:s');
			//var_dump($_FILES['user_pic']);exit();
           // print_r($ip); exit();
			$ipJson = json_encode($ip);
                
			
			//validation
			$validation_array = 1;
									
					
					$ip_array[] = array("dateofbirth", $ip['dateofbirth'], "not_null", "dateofbirth", "Date of birth is empty.");

					$ip_array[] = array("occupation", $ip['occupation'], "not_null", "occupation", "Occupation is empty.");

					$ip_array[] = array("company", $ip['company'], "not_null", "company", "Company is empty.");

					


					$validation_array = $this->validator->validate($ip_array);
					
					 if ($validation_array !=1) 
					{
						 $data['message'] = $validation_array;
						 $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
					} 

					else  
					{
						$data['details']=$this->User_model->update_brief($ip, $serviceName);
					  	$data['message'] = "Profile Details updated ";
					  	$retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
					} 
        
                         //echo $retVals1 = $this->signup_model->signup($ip,  $serviceName);
			             header("content-type: application/json");
			             echo $retVals1;
			             exit;
	     	}
 

            

/*End of Update Section*/
/* Forget password(Recover) Section*/

     public function recover_post()
		{
			$six_digit_random_number = mt_rand(100000, 999999);
			$serviceName = 'Forgot Password';
			
			$ip['phone']   = trim($this->input->post('phone'));
			$ipJson = json_encode($ip);
			if (empty($ip['phone']))
            {    
            	
                $data['message'] = "Mobile number is null....";
				$retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
		         //json_decode($retVals1);	
			}
			    else 
			    {    
			    	 $chkmob=$this->User_model->recover($ip);
                     if($chkmob=="true")
		             {
		             	 $six_digit_random_number = mt_rand(10000000, 99999999);
		             	 //echo $six_digit_random_number;exit()
				         $ipJson = json_encode($ip);
			             $data['message'] = "Password sent to number";
					     $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson); 
					     /*==================Sending Otp Again=====================*/ 
                           $user="developer321322@indglobal-consulting.com:indglobal123";

					    $sender="TEST SMS";
					    $number = $ip['phone'];
					    $message="Your Temporary Password is :".$six_digit_random_number." To change Your Paasword Login with this Please do not share this password with Anyone - Doctorway"; 
					               
					    $ch = curl_init();
					    curl_setopt($ch,CURLOPT_URL, "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
					    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					    curl_setopt($ch, CURLOPT_POST, 1);
					    curl_setopt($ch, CURLOPT_POSTFIELDS, "user=".$user."&senderID=".$sender."&receipientno=".$number."&msgtxt=".$message."");
					    $buffer = curl_exec($ch);
					   
					    curl_close($ch);
					    /*==================Sending Otp Again=====================*/
					    /*==================Updating Otp Again=====================*/
                        $upuser = array( 
                					   'password' => md5($six_digit_random_number),
                					   );
                        $user = $this->User_model->updt_pass($ip,$upuser);
					    /*==================Updating Otp Again=====================*/
				     
		             }
		             else
		             {
		             	$data['message'] = "Please Sign up first";
					    $retVals1 = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);	
					    json_decode($retVals1);
		             }

				        
		        }
			        header("content-type: application/json");
			        echo $retVals1;
			        exit;
	     	}  


/*End of Forget (Recover) Section*/
/*Mobile num change Section Starts*/


public function view_profile_post()
		{
			$serviceName = 'view_profile';
			//getting posted values
			$ip['user_id'] = trim($this->input->post('user_id'));


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
                    $data['View_profile'] =$this->User_model->view_profile($ip, $serviceName);
                    $retVals1 = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
				}



		          header("content-type: application/json");
		          echo $retVals1;
		          exit;
	    }


/*End of View details Section*/
/*Document Section Starts*/



/*End of Document  Section*/
/*Updating Document Section Section Starts*/

	}
?>

