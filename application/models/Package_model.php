<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class Package_model extends MY_Model
	{
		
	   function package()
	   {
	   	$this->db->select('package_name, duration');
	   	$this->db->from('packages');

	   	$query = $this->db->get();
	   	$details = $query->result();
	   	return $details;
	   }

  




	}

	


?>