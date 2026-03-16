<?php
class Forms_model extends CI_Model{
    
    public function get_count() 
	{
        return $this->db->count_all("haccap_review_form");
    }
    
    public function get_data($limit, $start) 
	{
         $this->db->limit($limit, $start);
        $query = $this->db->get("haccap_review_form");
        return $query->result();
    }
    
    public function TempFormList($branch_id,$table_name,$prep_area_id=''){
         $this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('branch_id',$branch_id);
		if($prep_area_id != ''){
		    $this->db->where('prep_name',$prep_area_id);
		}
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
	
		return $query->result();
    }
    
     public function tempFormView($id,$table_name){
	  
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('status',1);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
    public function get_table_data($parames) 
	{
        $this->db->select('*');
		$this->db->from($parames["table_name"]);
	
        if(!empty($parames["conditions"])){
            foreach($parames["conditions"] as $field_name => $field_value){
             $this->db->where($field_name,$field_value); 
            }
           
        }
      	$query = $this->db->get();
        return $query->result();
    }
    
    public function update_table_data($data,$id,$tableName){
     
	   $this->db->where('id',$id);
	   $this->db->update($tableName,$data);
	   return true;
    }
    
    
    
    
    public function add($data,$tableName){
	    
		 $this->db->insert($tableName,$data);
		 $insert_id = $this->db->insert_id();
// 		echo $this->db->last_query();exit;
		 return  $insert_id;
	}

	
	public function update($data,$id,$tableName){
	    $idcol=$tableName.'ID';
	    $this->db->where($idcol,$id);
		return $this->db->update($table_name,$data);
	}
	function delete($id,$tableName){
	   $idcol= 'id';
	   
	   $this->db->where($idcol,$id);
	   $this->db->delete($tableName);
	
	}
	public function filterFormList($branch_id,$filter,$table_name){
	    
		$this->db->select('*');
		$this->db->from($table_name);
// 		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		if($filter['cafe_name'] != ''){
		    $this->db->where('cafe_name',$filter['cafe_name']);
		}
	
		if($filter['prep_name'] != ''){
		    $this->db->where('prep_name',$filter['prep_name']);
		}
		if(isset($filter['start_date']) && $filter['start_date'] !='' && isset($filter['end_date']) && $filter['end_date'] !=''){
		    $myinput=$filter['start_date']; 
		    $date_from=date('Y-m-d',strtotime($myinput));
		    
		    $myinput2=$filter['end_date']; 
		    $date_to=date('Y-m-d',strtotime($myinput2));
		   
		    $this->db->where("start_date BETWEEN '$date_from' AND '$date_to'");
		}
		else if(isset($filter['start_date']) && $filter['start_date'] !=''){
		    $myinput=$filter['start_date']; 
		    $date_from=date('Y-m-d',strtotime($date_from));
		    
		     $this->db->where('start_date',$myinput);
		}
		else if(isset($filter['end_date']) && $filter['end_date'] !=''){
		    $myinput=$filter['end_date']; 
		    $date_to=date('Y-m-d',strtotime($myinput));
		    
		     $this->db->where('end_date',$date_to);
		}
		else{
		    
		}
		
		if($filter['correctiveaction'] != ''){
		    $this->db->where('correctiveaction',$filter['correctiveaction']);
		}
		if($filter['classification'] != ''){
		    $this->db->where('classification',$filter['classification']);
		}
		if($filter['correctiveaction_date'] != ''){
		    $this->db->where('correctiveaction_date',$filter['correctiveaction_date']);
		}
		
		
		$this->db->order_by("id", "desc");
		
		$query = $this->db->get();
// 		echo $this->db->last_query();
		
		return $query->result();
	}
	
	function addRecipe($data){
	   //echo "<pre>";print_r($data);exit;
		 $this->db->insert('haacp_recipe_form',$data);
// 		 echo $this->db->last_query(); exit;
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id;
	}
	function updateRecipe($data,$id){
		 
		 $this->db->where('haacp_recipe_form_id',$id);
		 return $this->db->update('haacp_recipe_form',$data);
	}
	public function getAllRecipes($branch_id,$recipe_type,$id=''){
        
		$this->db->select('*');
		$this->db->from('haacp_recipe_form');
// 		$this->db->where('status',1);
        
		$this->db->where('branch_id',$branch_id);
		
		if($recipe_type != ''){
		   $this->db->where('recipe_type',$recipe_type);
		}
		
		if($id != ''){
		    $this->db->where('haacp_recipe_form_id',$id);
		}
		$this->db->order_by("haacp_recipe_form_id", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
function record_delete($id,$tablename){
	    
	   $colname= $tablename."_id";
	   
	  
	  
		$this->db->where($colname,$id);
		
		$this->db->delete($tablename);
	}
	public function getAllRecipesrecord($id){
        
		$this->db->select('*');
		$this->db->from('haacp_recipe_form');
		$this->db->join('haccap_ServingSize', 'haacp_recipe_form.serving_size_id = haccap_ServingSize.haccap_ServingSize_id');
		
		if($id != ''){
		    $this->db->where('haacp_recipe_form.haacp_recipe_form_id',$id);
		}
		$query = $this->db->get();
		
		return $query->result();
	}
	
// 	prep area
    public function getAllPrepAreas($branch_id,$status='',$id=''){
        $this->db->select('*');
		$this->db->from('haccap_prep_area');
		
		if($status != ''){
		    $this->db->where('prep_area_status',$status);
        }
        
		$this->db->where('branch_id',$branch_id);
		
		if($id != ''){
		    $this->db->where('prep_area_id',$id);
		}
		$this->db->order_by("prep_area_id", "desc");
		$query = $this->db->get();
// 		echo $this->db->last_query();
		return $query->result();
    }
    public function getPrepAreas($email,$branch_id){
        $this->db->select('*');
		$this->db->from('haccap_prep_area');
		$this->db->where('prep_area_useremail',$email);
        
		$this->db->where('branch_id',$branch_id);
		
		$query = $this->db->get();
// 		echo $this->db->last_query();
		return $query->result();
    } 
    public function getPrepAreaFilter($filter,$branch_id){
        $this->db->select('*');
		$this->db->from('haccap_prep_area');
		if($filter['prep_area_name'] != ''){
		    $this->db->like('prep_area_name',$filter['prep_area_name']);
		}

		$this->db->where('branch_id',$branch_id);
		
		$query = $this->db->get();
// 		echo $this->db->last_query();
		return $query->result();
    }
    public function getAllForms($table_name=''){
        $this->db->select('*');
		$this->db->from('haccap_tables');
		
		$this->db->where('haccap_table_status',1);
       
        if($table_name != ''){
		    $this->db->where('table_name',$table_name);
        }
        
		
		$this->db->order_by("table_description", "ASC");
		$query = $this->db->get();
		
		return $query->result();
    }
    
    public function getForms($table_id=''){
        $this->db->select('*');
		$this->db->from('haccap_tables');
		
		$this->db->where('haccap_table_status',1);
       
        if($table_id != ''){
		    $this->db->where('haccap_table_id',$table_id);
        }
        
		
		$this->db->order_by("table_description", "ASC");
		$query = $this->db->get();
		
		return $query->result();
    }
    function addPrepArea($data){
	   
		 $this->db->insert('haccap_prep_area',$data);
// 		 echo $this->db->last_query(); exit;
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id;
	}
	public function updatePrepArea($data,$userdata,$id,$old_email){
     
	   $this->db->where('prep_area_id',$id);
	   $res = $this->db->update('haccap_prep_area',$data);
	   if($res){
	       $this->db->where('email',$old_email);
	   $res = $this->db->update('customer_users',$userdata);
	   }
	   return true;
    }
    public function updatePrepAreaStatus($data,$id){
     
	   $this->db->where('prep_area_id',$id);
	   $res = $this->db->update('haccap_prep_area',$data);
	   if($res){
	        return true;
	   }else{
	       return false;
	   }
	  
    }

    function delete_prep_area($id){
	   
	    $this->db->where('prep_area_id',$id);
		
		$res = $this->db->delete('haccap_prep_area');
		if($res){
	        return true;
	   }else{
	       return false;
	   }
	}
	public function email_check($email = ''){
	    $this->db->select('*');
		$this->db->from('haccap_prep_area');
		$this->db->where('prep_area_useremail',$email);
		
		$query = $this->db->get();
// 		echo $this->db->last_query();
		return $query->result();
	
	}
	function fetch_branches(){
	    
	   $this->db->select('branch_id');
	   $this->db->from('customer_branches');
	  
	   $query = $this->db->get();
		
	return $query->result();
		
	}
// 	prep area ends
}