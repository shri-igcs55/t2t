<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class Select_category_model extends CI_model
	{
		
	  

 
  function select_category($input)
  {
  	$ipJson = json_encode($input);
   
$category = $input['category'];

foreach ($category as $category_value)
{
  $mycategory[] = array(
    'user_id'    => $input['user_id'],
    'cat_id'   => $category_value,
    'created_at' => Date('Y-m-d h:i:s')
     );
}
   

         $query = $this->db->insert_batch('users_category', $mycategory);
      
  }  









	}
	


?>