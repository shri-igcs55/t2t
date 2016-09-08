<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class People_on_this_table_model extends CI_model
	{
		
	  

 
  function people_on_this_table($input)
  {
  	$ipJson = json_encode($input);
  	$this->db->select('b.name');
  	$this->db->from('users_table a'); 
    $this->db->join('users_registration b', 'a.user_id = b.user_id');
  	$this->db->where('a.table_id',$input['table_id']);
  	$query = $this->db->get();
  	//echo $this->db->last_query();

  	$details = $query->result();
  //print_r($details);
			//exit();
  	return $details;
  }  









	}
	


?>