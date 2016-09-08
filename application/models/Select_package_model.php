<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class Select_package_model extends CI_model
	{
		
	  

 
  function select_package($input)
  {
  	$ipJson = json_encode($input);
   

{
  $mypackage = array(
    'user_id'    => $input['user_id'],
    'package_id' => $input['package'],
    'created_at' => Date('Y-m-d h:i:s')
     );
}
   

         $query = $this->db->insert('users_package', $mypackage);
   
  }  









	}
	


?>