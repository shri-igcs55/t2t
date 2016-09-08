<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*  signup model
	*/
	class Select_table_model extends CI_model
	{
		
	  

 
  function select_table($input)
  {
  	$ipJson = json_encode($input);
   
$table = $input['table'];

foreach ($table as $table_value)
{
  $mytable[] = array(
    'user_id'    => $input['user_id'],
    'table_id'   => $table_value,
    'created_at' => Date('Y-m-d h:i:s')
     );
}
   

         $query = $this->db->insert_batch('users_table', $mytable);
      //    if ($query == 1) {
          
      //     // $last_id = $this->db->insert_id();
      //     // $this->db->select('a.table_id,b.table_name');
      //     //   $this->db->from('users_table a');
      //     //   $this->db->join('main_table b', 'a.table_id = b.table_id');
      //     // $this->db->where('a.id', $last_id );

      //     //   $detail_last_user = $this->db->get();
      //     //   $resultq = $detail_last_user->result();
            
      //     //$data['detail'] = $resultq;
      //     $data = $resultq;
      //     //$data['id'] = $profile_thumb_url;

      //     $status = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);

      //   }
      //   else {
      //     $data['message'] = 'Something went wrong while signup. Try Again.';
      //     $status = $this->seekahoo_lib->return_status('Error', $serviceName, $data, $ipJson);
      //   }
      // return $status;
  

         
          


  	//$status = $this->seekahoo_lib->return_status('success', $serviceName, $data, $ipJson);
  }  









	}
	


?>