<?php
class Menucard_model extends CI_Model{
    
    public function getAllRecipesrecord($branch_id,$id){
        
		$this->db->select('*');
		$this->db->from('haacp_recipe');
		$this->db->join('haccap_ServingSize', 'haacp_recipe.serving_size_id = haccap_ServingSize.haccap_ServingSize_id');
		$this->db->where('haacp_recipe.branch_id',$branch_id);
		if($id != ''){
		    $this->db->where('haacp_recipe.haacp_recipe_id',$id);
		}
		$query = $this->db->get();
		
		return $query->result();
	}
	
    function addServingSize($data){
	    
		 $this->db->insert('haccap_ServingSize',$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id;
	}
	function updateServingSize($data,$id){
		 
		 $this->db->where('haccap_ServingSize_id',$id);
		 return $this->db->update('haccap_ServingSize',$data);
	}
    public function getServingSize($branch_id,$id=''){
        
		$this->db->select('*');
		$this->db->from('haccap_ServingSize');
// 		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		if($id != ''){
		    $this->db->where('haccap_ServingSize_id',$id);
		}
		$this->db->order_by("haccap_ServingSize_id", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	 public function getServingSizes($branch_id,$id=''){
        
		$this->db->select('*');
		$this->db->from('haccap_ServingSize');
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		if($id != ''){
		    $this->db->where('haccap_ServingSize_id',$id);
		}
		$query = $this->db->get();
		
		return $query->result();
	}
	function addRecipe($data){
	   
		 $this->db->insert('haacp_recipe',$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id;
	}
	function updateRecipe($data,$id){
		 
		 $this->db->where('haacp_recipe_id',$id);
		 return $this->db->update('haacp_recipe',$data);
	}
	public function getAllRecipes($branch_id,$recipe_type,$id=''){
        
		$this->db->select('*');
		$this->db->from('haacp_recipe');
// 		$this->db->where('status',1);
        
		$this->db->where('branch_id',$branch_id);
		
		if($recipe_type != ''){
		   $this->db->where('recipe_type',$recipe_type);
		}
		
		if($id != ''){
		    $this->db->where('haacp_recipe_id',$id);
		}
		$this->db->order_by("haacp_recipe_id", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
// 	public function getRecipes($branch_id,$id=''){
        
// 		$this->db->select('*');
// 		$this->db->from('haacp_recipe');
// 		$this->db->where('status',1);
// 		$this->db->where('branch_id',$branch_id);
// 		if($id != ''){
// 		    $this->db->where('haacp_recipe_id',$id);
// 		}
// 		$this->db->order_by("haacp_recipe_id", "desc");
// 		$query = $this->db->get();
		
// 		return $query->result();
// 	}
	function record_delete($id,$tablename){
	    
	   $colname= $tablename."_id";
	   
	  
	   
		$this->db->where($colname,$id);
		
		return $this->db->delete($tablename);
	}

	public function filterMenuPlanner($branch_id,$filter){
	    
		$this->db->select('*');
		$this->db->from('menuPlanner');
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		if($filter['cuisine'] != ''){
		    $this->db->where('cuisine',$filter['cuisine']);
		}
		if($filter['category'] != ''){
		    $this->db->where('category',$filter['category']);
		}
		if($filter['menu'] != ''){
		    $this->db->where('menu',$filter['menu']);
		}
		$query = $this->db->get();
		echo $this->db->last_query();
		
		return $query->result();
	}
	
	public function filterFormList($branch_id,$filter,$recipe_type){
	    
		$this->db->select('*');
		$this->db->from('haacp_recipe');
// 		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('recipe_type',$recipe_type);
		if($filter['recipe_name'] != ''){
		    $this->db->where('recipe_name',$filter['recipe_name']);
		}
	
		
		
		$this->db->order_by("haacp_recipe_id", "desc");
		
		$query = $this->db->get();
		echo $this->db->last_query();
		
		return $query->result();
	}
}