<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class Show_category_model extends CI_model
	{
		
	  

 
  function show_category()
  {
  	//$ipJson = json_encode($input);
  	$this->db->select('topic_name, cat_image');
  	$this->db->from('category_topics'); 
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