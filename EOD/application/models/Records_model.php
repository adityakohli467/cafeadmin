<?php
class Records_model extends CI_Model{
    
    public function getData($table_name,$fields,$branch_id='',$whereid=[]){
        // echo $table_name;
        $fields =implode(',',$fields['sql_columns']);
		
		$this->db->select($fields);
		$this->db->from($table_name);
		
		if($branch_id !=''){
		$this->db->where('branch_id',$branch_id);
		}
// 		$this->db->join('menuPlanner_category', 'menuPlanner_category.category_id = menuPlanner.category');
		if(!empty($whereid)){
		    foreach($whereid as $key=>$condition){
		       $this->db->where($key,$condition); 
		    }
		   
		}
		
		$query = $this->db->get();
	
		return $query->result();
	}   
	public function fetchData($table_name,$branch_id,$whereid){
        
        
		$this->db->select("*");
		$this->db->from($table_name);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('status',1);
// 		$this->db->join('menuPlanner_category', 'menuPlanner_category.category_id = menuPlanner.category');
		if($whereid != ''){
		    $this->db->where('suppliers_category_id',$whereid);
		}
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
    function addData($table_name,$data){
	    
		 $this->db->insert($table_name,$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id;
	}
	function updateData($table_name,$data,$whereid){
		 
		 $this->db->where($table_name.'_id',$whereid);
		 return $this->db->update($table_name,$data);
	}
	function recordDelete($whereid,$table_name){
	    
	   $colname= $table_name."_id";
	   
		$this->db->where($colname,$whereid);
		
		return $this->db->delete($table_name);
	}
	
	public function getsupplierManagementData($table_name,$fields,$where_fields){
	    $branch_id = $this->session->userdata('branch_id');
	    $supplierManagement = $this->load->database('supplierManagement', TRUE);
	        
	    $fields =implode(',',$fields);
	    
        $query = '';
        if($table_name == 'suppliers'){
            $query .= "SELECT * FROM `supplier_branch_access` LEFT JOIN `suppliers` ON `suppliers`.`supplier_id` = `supplier_branch_access`.`supplier_id` WHERE `supplier_branch_access`.`branch_id` = ".$branch_id." AND `suppliers`.`status` = 1 ";
            if(!empty($where_fields)){
                foreach($where_fields as $key=>$where_field){
                    $query .= " AND `suppliers`.`".$key."` = '".$where_field."'";
                   
                }
            }
        }else{
            $query .= "SELECT ".$fields." FROM ".$table_name."";
            if(!empty($where_fields)){
                foreach($where_fields as $key=>$where_field){
                    $query .= " WHERE ".$key." = '".$where_field."'";
                   
                }
            }
        }
        // echo $query;
       
        $sql = $supplierManagement->query($query);
        return $sql->result();
	}
	public function getFilterData($table_name,$fields,$branch_id='',$whereid=''){
	   
        $field =implode(',',$fields);
		
		$this->db->select($field);
		$this->db->from($table_name);
		
		if($branch_id !=''){
		$this->db->where('branch_id',$branch_id);
		}

		if(!empty($whereid)){
		    foreach($whereid as $key=>$condition){
		       $this->db->like($key,$condition); 
		    }
		   
		}
		
		$query = $this->db->get();

		return $query->result();
	} 
}