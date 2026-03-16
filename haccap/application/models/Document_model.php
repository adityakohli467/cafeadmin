<?php
class Document_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}


		public function fetch_data($table_name,$branch_id,$limit,$start,$category='',$i=null){

		$this->db->select('*'); 
		$this->db->from($table_name);
		$this->db->where('branch_id',$branch_id);
		if($category !=''){
		    	$this->db->where('category',$category);
		}
	
		$this->db->limit($limit, $start);
	
		
		$this->db->order_by('document_id',"DESC");
	
		$query = $this->db->get();
		
		$errors = $this->db->error();

		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			sleep(5);
			$this->fetch_data($table_name,$branch_id,$limit,$start,$i=null);
		}else{
			return $query->result();
		}
	    
	}
		public function add_data_to_tble($table_name,$data=array()){
		
	    $this->db->insert($table_name,$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id;
	}
	function delete_document($id,$tablename){
	   
		$this->db->where('document_id',$id);
		
		$this->db->delete($tablename);
	}
	public function get_total($table_name) 
    {
        return $this->db->count_all($table_name);
    }
	
}
?>