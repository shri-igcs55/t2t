<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Model for signin
*/
class User_model extends CI_model
{
  
  public function check_signin($input, $serviceName) {
    //echo "string";
    $ipJson = json_encode($input);
      
      $this->db->select('user_id, name, email, phone');
      $this->db->from('users_registration');
      $this->db->where('email', $input['email']);
      $this->db->where('password', base64_encode($input['password']));
      $query = $this->db->get();
      $resultRows = $query->num_rows();
      //print_r($query);exit();
      $result = $query->result();
      
      if ($resultRows > 0) {
        //print_r($result[0]->pass);exit();
        $data['details'] = $result;
        $data['message'] = 'Login Successfully';
        $status = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
      }
      else {
        $data['message'] = 'Email address and Password does not match';
        $status = $this->seekahoo_lib->return_status('error', $serviceName, $data, $ipJson);
      }
    return $status;
  }

/*Sign Up*/

  function signup($input, $serviceName) {
      $ipJson = json_encode($input);
      
        $signup_data = array(
              
            'name'          => $input['name'],
            'email'         => $input['email'],
            'phone'         => $input['phone'],
            'password'      => base64_encode($input['password']),
            'created_at'    => Date('Y-m-d h:i:s')
          );
        $query = $this->db->insert('users_registration', $signup_data);

        if ($query == 1) {
          
          $last_id = $this->db->insert_id();
          $this->db->select('name,
            occupation,
            email,
            phone');
            $this->db->from('users_registration');
          $this->db->where('user_id', $last_id );

            $detail_last_user = $this->db->get();
            $resultq = $detail_last_user->result();
            
          //$data['detail'] = $resultq;
          $data = $resultq;
          //$data['id'] = $profile_thumb_url;

          $status = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);

        }
        else {
          $data['message'] = 'Something went wrong while signup. Try Again.';
          $status = $this->seekahoo_lib->return_status('Error', $serviceName, $data, $ipJson);
        }
      return $status;
    }


    function update_brief($input, $serviceName) {
      $ipJson = json_encode($input);
      
        $update_data = array(
              
            'dateofbirth'          => $input['dateofbirth'],
            'occupation'           => $input['occupation'],
            'company'              => $input['company'],
            'gender'               => $input['gender'],
            'city'                 => $input['city'],
            'web'                  => $input['web'],
            'image'                => $input['image']
                   );
        $this->db->where('user_id',$input['user_id']);
        $query = $this->db->update('users_registration', $update_data);

    //     if ($query == 1) {
          
          

    //       //$status = $this->seekahoo_lib->return_status('success', $serviceName, $ipJson);

    //     }
    //     else {
    //       $data['message'] = 'Something went wrong while signup. Try Again.';
    //       //$status = $this->seekahoo_lib->return_status('Error', $serviceName, $data, $ipJson);
    //     }
    //   return $status;
     }

    function check_email($input) 
    {
      //echo $email;die();
      $this->db->select('*');
      $this->db->from('users_registration');
      $this->db->where('email', $input['email']);
      $query = $this->db->get();
      $details = $query->result();    
      $result = $query->num_rows();
      if ($result > 0 ){
        //print_r($details); die();
        return $details;
      }
      return false;
    }
 
        function check_mob($input) 
    {
      //echo $email;die();
      $this->db->select('*');
      $this->db->from('users_registration');
      $this->db->where('phone', $input['phone']);
      $query = $this->db->get();
      $details = $query->result();    
      $result = $query->num_rows();
      if ($result > 0 ){
        //print_r($details); die();
        return $details;
      }
      return false;
    }

/*Verification Section Starts*/




   

    /*function check_email($email) 
    {
      //echo $email;die();
      $this->db->select('*');
      $this->db->from('user_reg');
      $this->db->where('email', $email);
      $query = $this->db->get();
      $details = $query->result();    
      $result = $query->num_rows();
      if ($result > 0 ){
        //print_r($details); die();
        return $details;
      }
      return false;
    }*/

/*End of Verification Section*/
/*Otp Section Starts*/

/*Check mobnum exsist function or not Is also here*/

    

/*End of Otp Section*/
/*Change pass Section Starts*/

  function c_pass($input)
    {
            $ipJson = json_encode($input);
      

            $this->db->select('*');
      $this->db->from('users_registration');
      $this->db->where('phone', $input['phone']);
          $this->db->where('password', base64_encode($input['old_password']));
      $query = $this->db->get();
      $details = $query->result();    
          $result =  $query->num_rows();
           
              
            if ($result > 0 )
          {
            $ipJson = json_encode($input);

            $up_status = array(
                      'password' => base64_encode($input['new_password']) 
                    );

        $this->db->where('phone',$input['phone']);
      $this->db->update('users_registration', $up_status);
               return True;
      }
      else
      {  
           return False;
      }
      

    }

    function updt_status_simple ($input)
      {
            $ipJson = json_encode($input);

            $up_status = array(
                      'user_pic' => $input['user_pic'],
              'username' => $input['username'],
            'email' => $input['email'],
                        'blood_group'=>$input['blood_group'],
                        'gender'=>$input['gender'],
                        'dob'=>$input['dob'],
                        'city'=>$input['city'],
                        'created_on' => Date('Y-m-d h:i:s'),
                        'updated_on' => Date('Y-m-d h:i:s')
                              );

        $this->db->where('patient_id',$input['patient_id']);
      $ins=$this->db->update('user_reg', $up_status);
      //echo $this->db->last_query($ins);
      }

      function updt_status_with ($input)
      {
            $ipJson = json_encode($input);

            $up_status = array(
                      'user_pic' => $input['user_pic'],
              'username' => $input['username'],
            'email' => $input['email'],
            'status'=>'pending',
                        'phone_number' => $input['mobile'],
            'blood_group'=>$input['blood_group'],
                        'gender'=>$input['gender'],
                        'dob'=>$input['dob'],
                        'city'=>$input['city'],
                        'otp'=>$input['otp'],
                        'created_on' => Date('Y-m-d h:i:s'),
                        'updated_on' => Date('Y-m-d h:i:s')
                              );

        $this->db->where('patient_id',$input['patient_id']);
      $ins=$this->db->update('user_reg', $up_status);
      //echo $this->db->last_query($ins);
      }


    function check_mob_cp($input) 
    {
      //echo $email;die();
      $ipJson = json_encode($input);
      //var_dump($input);
      $this->db->select('*');
      $this->db->from('users_registration');
      $this->db->where('phone', $input['phone']);
      $query = $this->db->get();
      $details = $query->result();

      //var_dump($details);  exit();
      $result = $query->num_rows();
      if ($result > 1 )
      {
        //print_r($details); die();
        return $details;
      }
      return false;
    }

/*End of Change pass Section*/
/*Update Section Starts.*/
function check_update($input)
    {
            $ipJson = json_encode($input);
      

            $this->db->select('*');
      $this->db->from('users_registration');
      //$this->db->where('patient_id', $input['patient_id']);
          $ins=$this->db->where('phone', $input['phone']);
      $query = $this->db->get();
      $details = $query->result();    
          $result =  $query->num_rows();
           
              
            if ($result > 0 )
          {
            $ipJson = json_encode($input);
            
            $up_status = array(
                        'user_pic' => $input['user_pic'],
                        'username' => $input['username'],
                        'email' => $input['email'],
                        'blood_group'=>$input['blood_group'],
                        'gender'=>$input['gender'],
                        'dob'=>$input['dob'],
                        'city'=>$input['city'],
                        'created_on' => Date('Y-m-d h:i:s'),
                        'updated_on' => Date('Y-m-d h:i:s')
                              );

        $this->db->where('patient_id',$input['patient_id']);
      $ins=$this->db->update('user_reg', $up_status);
               return True;
      }
      else
      {  
        $ipJson = json_encode($input);

            $up_status = array(
                        'user_pic' => $input['user_pic'],
                        'username' => $input['username'],
                        'email' => $input['email'],
                        'status'=>'pending',
                        'phone_number' => $input['mobile'],
                        'blood_group'=>$input['blood_group'],
                        'gender'=>$input['gender'],
                        'dob'=>$input['dob'],
                        'city'=>$input['city'],
                        'otp'=>$input['otp'],
                        'created_on' => Date('Y-m-d h:i:s'),
                        'updated_on' => Date('Y-m-d h:i:s')
                              );

        $this->db->where('patient_id',$input['patient_id']);
      $ins=$this->db->update('user_reg', $up_status);
           return False;
      }
      

    }

    /*function updt_status_simple ($input,$uploadPhoto)
      {
            
      //echo $this->db->last_query($ins);
      }

      function updt_status_with ($input,$uploadPhoto)
      {
            
      //echo $this->db->last_query($ins);
      }*/


    function check_mob_u($input) 
    {
      //echo $email;die();
      $ipJson = json_encode($input);
      //var_dump($input);
      $this->db->select('*');
      $this->db->from('user_reg');
      $this->db->where('phone_number', $input['mobile']);
      $query = $this->db->get();
      $details = $query->result();

      //var_dump($details);  exit();
      $result = $query->num_rows();
      if ($result > 1 )
      {
        //print_r($details); die();
        return $details;
      }
      return false;
    }


    function check_email_u($input) 
    {
      //echo $email;die();
      $ipJson = json_encode($input);
      $this->db->select('*');
      $this->db->from('user_reg');
      $this->db->where('email', $input['email']);
      $query = $this->db->get();
      $details = $query->result();
      $result = $query->num_rows();
      if ($result > 1 )
      {
        //print_r($details); die();
        return $details;
      }
      return false;
      }


        
          /*$uploadPhoto,*/
        function add_photo($ip) {
            $serviceName = 'add_media';

            $ipJson = json_encode($ip);
            //echo $ipJson;exit();
            if ($ip['flag'] == 'post') {
                $photoArray = array(
                    'media_type' => $uploadPhoto[0]['type'],
                    'media_thumb_url' => $uploadPhoto[0]['thumbnail_url'],
                    'media_org_url' => $uploadPhoto[0]['photo_url'],
                    'media_created_date' => date('Y-m-d H:i:s'),
                    'media_modified_date' => date('Y-m-d H:i:s')
                );
                $photoIns = $this->db->insert('media', $photoArray);
            } else { 
                //print_r($uploadPhoto[0]['thumbnail_url']);
                $photoArray = array(
                    'profile_thumb_url' => $uploadPhoto[0]['thumbnail_url'],
                    'profile_org_url'   => $uploadPhoto[0]['photo_url'],
                    'reg_date_time'     => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $ip['user_id']);
                $photoIns = $this->db->update('signup', $photoArray);
            }
            if ($photoIns) {
                $mediaId = $this->db->insert_id();
                $uploadPhoto[0]['photo_id'] = $mediaId;
            } else {
                return false;
            }
            return $uploadPhoto;
        }


    
/*End of Update Section*/
/* forget(Recover) Section Starts*/

function recover($input) 
    {
        $ipJson = json_encode($input);
          //var_dump($ipJson);exit();
        $this->db->select('*');
        $this->db->from('users_registration');
        $this->db->where('phone',$input['phone'] );
        $query = $this->db->get();
        $details = $query->result();
            //echo $this->db->last_query();
        $result = $query->num_rows();
        if ($result > 0 )
        {
          //print_r($details); die();
          return true;
        }
        return false; 
    }



    function updt_pass ($input,$upuser)
      {
         $this->db->where('phone',$input['phone']);
         $ins=$this->db->update('users_registration', $upuser);
        //echo $this->db->last_query($ins);
      }



    
/*End of Forget (Recover) Section*/
/*View details Section Starts*/

public function view_profile($input,$serviceName)
      {
        $ipJson = json_encode($input);

        $this->db->select(['user_id','name','phone','company','email','occupation','gender','dateofbirth','web','city']);
        $this->db->from('users_registration');
        $this->db->where('user_id',$input['user_id']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
         
     }





/*End of View details Section*/
/*Favrourite Submission Section Starts*/








/*End of Favrourite Submission Section*/
/*Top Hospitals Section Starts*/










/*End of Top Hospitals Section*/
/* Section Starts*/


    
    




}

?>