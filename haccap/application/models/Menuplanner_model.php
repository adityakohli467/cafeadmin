<?php
class Menuplanner_model extends CI_Model{
    
     function __construct(){
        parent::__construct();
        $this->branch_id = $this->session->userdata('branch_id');
    }
    function add_menu($data){
	    
		 $this->db->insert('menuPlanner',$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id; 
	}
	function add_menuPlanner_category($data){
	    
		 $this->db->insert('menuPlanner_category',$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id; 
	}
	
	function menuPlanner_subcategory($data){
	    
		 $this->db->insert('menuPlanner_subcategory',$data);
		 $insert_id = $this->db->insert_id();
		
		 return  $insert_id; 
	}
	public function getMenuCategory($branch_id,$id=''){
		$this->db->select('*');
		$this->db->from('menuPlanner_category');
	
		$this->db->where('branch_id',$branch_id);
		if($id != ''){
		    $this->db->where('category_id',$id);
		}
		$this->db->order_by("category_id", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	public function fetchMenuCategory($branch_id,$id){
		$this->db->select('*');
		$this->db->from('menuPlanner_subcategory');
		$this->db->where('subcategory_status',1);
		
		$this->db->where('branch_id',$branch_id);
		if($id != ''){
		    $this->db->where('menu_category_id',$id);
		}
	
		$query = $this->db->get();
		
		return $query->result();
	}
	public function update_menuCategory($data,$id){
	    
	    $this->db->where('category_id',$id);
		return $this->db->update('menuPlanner_category',$data);
	}
	function deleteMenuCategory($id){
	    
		 $this->db->where('category_id',$id);
		 $this->db->delete('menuPlanner_category');
		 
		 echo "deleted";
	}
    public function getMenuPlanner($branch_id,$id=''){
		$this->db->select('*');
		$this->db->from('menuPlanner');
		$this->db->join('menuPlanner_category', 'menuPlanner_category.category_id = menuPlanner.category');
// 		$this->db->where('menuPlanner.status',1);
		$this->db->where('menuPlanner.branch_id',$branch_id);
		if($id != ''){
		    $this->db->where('menuPlanner.menuPlannerID',$id);
		}
		$this->db->order_by("menuPlanner.menuPlannerID", "desc");
	
		$query = $this->db->get();
// 			echo $this->db->last_query();exit;
		return $query->result();
	}

	public function update_menuplanner($data,$id){
	    
	    $this->db->where('menuPlannerID',$id);
		return $this->db->update('menuPlanner',$data);
	}
	function menuplanner_delete($id){
		 $this->db->delete('menuPlanner', array('menuPlannerID' => $id)); 
		 echo "deleted";
	}
	public function menuPlanner_category(){

		$this->db->select('*');
		$this->db->from('menuPlanner_category');
		$this->db->where('status',1);
		$this->db->where('branch_id',$this->branch_id);
		$query = $this->db->get();
		
		return $query->result();
	}
	public function getMenuPlannerMenus($branch_id,$menuPlannerID){
	  
		$this->db->select('*');
		$this->db->from('menuPlanner_category');
		$this->db->join('menuPlanner', 'menuPlanner.category = menuPlanner_category.category_id');
		$this->db->where('menuPlanner.status',1);
		$this->db->where('menuPlanner.branch_id',$branch_id);
		$this->db->where('menuPlanner_category.category_id',$menuPlannerID);
		$query = $this->db->get();
		
		return $query->result();
	}
	public function getMenuPlannerData($branch_id,$menuPlannerID){
	  
		$this->db->select('*');
		$this->db->from('menuPlanner');
		$this->db->join('menuPlanner_category', 'menuPlanner_category.category_id = menuPlanner.category');
		$this->db->where('menuPlanner.status',1);
		$this->db->where('menuPlanner.branch_id',$branch_id);
		$this->db->where('menuPlanner.menuPlannerID',$menuPlannerID);
		$query = $this->db->get();
		
		return $query->result();
	}
	function saveWeekMenu($data){
	   
		 $this->db->insert('menuPlannerWeek',$data);
		 $insert_id = $this->db->insert_id();
		 
		 return  $insert_id;
	}
	function weekMenuList($branch_id){
	    $this->db->select('*');
		$this->db->from('menuPlannerWeek');
		$this->db->where('branch_id',$branch_id);
		$this->db->order_by("week_start_date",'DESC');
		$query = $this->db->get();
	
		return $query->result();
	}
	function weekMenuView($branch_id,$week_menu_id){
	    $this->db->select('*');
		$this->db->from('menuPlannerWeek');
		$this->db->where('week_menu_id',$week_menu_id);
		$this->db->where('branch_id',$branch_id);
		$query = $this->db->get();
	
		return $query->result();
	}
	function updateWeekMenu($data,$id){
	   
	    $this->db->where('week_menu_id',$id);
		return $this->db->update('menuPlannerWeek',$data);
	}
	function menuWeek_delete($id){
	   
		 $this->db->where('week_menu_id',$id);
		 $this->db->delete('menuPlannerWeek');
		 echo "deleted";
	}
	public function filterMenuPlanner($branch_id,$filter){
	    
		$this->db->select('*');
		$this->db->from('menuPlanner');
		$this->db->join('menuPlanner_subcategory', 'menuPlanner_subcategory.subcategory_id = menuPlanner.category');
		$this->db->where('menuPlanner.status',1);
		$this->db->where('menuPlanner.branch_id',$branch_id);
		if($filter['cuisine'] != ''){
		    $this->db->where('menuPlanner.cuisine',$filter['cuisine']);
		}
		if($filter['category'] != ''){
		    $this->db->where('menuPlanner.category',$filter['category']);
		}
		if($filter['menu'] != ''){
		    $this->db->where('menuPlanner.menu',$filter['menu']);
		}
		$this->db->order_by("menuPlanner.menuPlannerID", "desc");
		$query = $this->db->get();
		echo $this->db->last_query();
		
		return $query->result();
	}
}