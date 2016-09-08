<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class My_table_model extends CI_model
	{
		
	  

 
  function my_table($input)
  {
  	$ipJson = json_encode($input);
  	$this->db->select('b.table_name, b.table_image');
  	$this->db->from('users_table a'); 
    $this->db->join('main_table b', 'a.table_id = b.table_id');
  	$this->db->where('a.user_id',$input['user_id']);
  	$query = $this->db->get();
  	//echo $this->db->last_query();

  	$details = $query->result();
  //print_r($details);
			//exit();
  	return $details;
  }  

    function other_table($input)
  {
    $ipJson = json_encode($input);
    $this->db->select('table_name, table_image');
    $this->db->from('main_table'); 
    //$this->db->join('main_table b', 'a.table_id = b.table_id');
    $this->db->where('table_name NOT IN (select b.table_name from users_table a JOIN main_table b ON a.table_id=b.table_id where a.user_id = '.$input['user_id'].')', NULL, FALSE);
    $query = $this->db->get();
    //echo $this->db->last_query();

    $details = $query->result();
  //print_r($details);
      //exit();
    return $details;
  }









	}
	


?>