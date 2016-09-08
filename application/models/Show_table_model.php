<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class Show_table_model extends CI_model
	{
		
	  

 
  function show_table()
  {
  	//$ipJson = json_encode($input);
  	$this->db->select('table_image, table_name');
  	$this->db->from('main_table'); 
    //$this->db->order by('vehicle_id');


  
  	$query = $this->db->get();
  	//echo $this->db->last_query();

  	$details = $query->result();
  //print_r($details);
			//exit();
  	return $details;
  }  









	}
	


?>