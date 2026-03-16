<?php
class Settings_model extends CI_Model{
		public $tables = array();

	/**
	 * activation code
	 *
	 * @var string
	 **/
	public $activation_code;

	/**
	 * forgotten password key
	 *
	 * @var string
	 **/
	public $forgotten_password_code;

	/**
	 * new password
	 *
	 * @var string
	 **/
	public $new_password;

	/**
	 * Identity
	 *
	 * @var string
	 **/
	public $identity;

	/**
	 * Where
	 *
	 * @var array
	 **/
	public $_ion_where = array();

	/**
	 * Select
	 *
	 * @var array
	 **/
	public $_ion_select = array();

	/**
	 * Like
	 *
	 * @var array
	 **/
	public $_ion_like = array();

	/**
	 * Limit
	 *
	 * @var string
	 **/
	public $_ion_limit = NULL;

	/**
	 * Offset
	 *
	 * @var string
	 **/
	public $_ion_offset = NULL;

	/**
	 * Order By
	 *
	 * @var string
	 **/
	public $_ion_order_by = NULL;

	/**
	 * Order
	 *
	 * @var string
	 **/
	public $_ion_order = NULL;

	/**
	 * Hooks
	 *
	 * @var object
	 **/
	protected $_ion_hooks;

	/**
	 * Response
	 *
	 * @var string
	 **/
	protected $response = NULL;

	/**
	 * message (uses lang file)
	 *
	 * @var string
	 **/
	protected $messages;

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors;

	/**
	 * error start delimiter
	 *
	 * @var string
	 **/
	protected $error_start_delimiter;

	/**
	 * error end delimiter
	 *
	 * @var string
	 **/
	protected $error_end_delimiter;

	/**
	 * caching of users and their groups
	 *
	 * @var array
	 **/
	public $_cache_user_in_group = array();

	/**
	 * caching of groups
	 *
	 * @var array
	 **/
	protected $_cache_groups = array();
		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');

		//Load the session, CI2 as a library, CI3 uses it as a driver
		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->load->library('session');
		}
		else
		{
			$this->load->driver('session');
		}

		$this->lang->load('ion_auth');

		//initialize db tables data
		$this->tables  = $this->config->item('tables', 'ion_auth');

		//initialize data
		$this->identity_column = $this->config->item('identity', 'ion_auth');
		$this->store_salt      = $this->config->item('store_salt', 'ion_auth');
		$this->salt_length     = $this->config->item('salt_length', 'ion_auth');
		$this->join			   = $this->config->item('join', 'ion_auth');


		//initialize hash method options (Bcrypt)
		$this->hash_method = $this->config->item('hash_method', 'ion_auth');
		$this->default_rounds = $this->config->item('default_rounds', 'ion_auth');
		$this->random_rounds = $this->config->item('random_rounds', 'ion_auth');
		$this->min_rounds = $this->config->item('min_rounds', 'ion_auth');
		$this->max_rounds = $this->config->item('max_rounds', 'ion_auth');


		//initialize messages and error
		$this->messages = array();
		$this->errors = array();
		$this->message_start_delimiter = $this->config->item('message_start_delimiter', 'ion_auth');
		$this->message_end_delimiter   = $this->config->item('message_end_delimiter', 'ion_auth');
		$this->error_start_delimiter   = $this->config->item('error_start_delimiter', 'ion_auth');
		$this->error_end_delimiter     = $this->config->item('error_end_delimiter', 'ion_auth');

		//initialize our hooks object
		$this->_ion_hooks = new stdClass;

		//load the bcrypt class if needed
	
	}
	
	public function hash_password($password, $salt=false, $use_sha1_override=FALSE)
	{
		if (empty($password))
		{
			return FALSE;
		}

		//bcrypt
		if ($use_sha1_override === FALSE && $this->hash_method == 'bcrypt')
		{
			return $this->bcrypt->hash($password);
		}


		if ($this->store_salt && $salt)
		{
			return  sha1($password . $salt);
		}
		else
		{
			$salt = $this->salt();
			return  $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
		}
	}

	/**
	 * This function takes a password and validates it
	 * against an entry in the users table.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function hash_password_db($id, $password, $use_sha1_override=FALSE)
	{
		if (empty($id) || empty($password))
		{
			return FALSE;
		}

		$this->trigger_events('extra_where');

		$query = $this->db->select('password, salt')
		                  ->where('customer_user_id', $id)
		                  ->limit(1)
		                  ->get($this->tables['users']);

		$hash_password_db = $query->row();

		if ($query->num_rows() !== 1)
		{
			return FALSE;
		}

		// bcrypt
		if ($use_sha1_override === FALSE && $this->hash_method == 'bcrypt')
		{
			if ($this->bcrypt->verify($password,$hash_password_db->password))
			{
				return TRUE;
			}

			return FALSE;
		}

		// sha1
		if ($this->store_salt)
		{
			$db_password = sha1($password . $hash_password_db->salt);
		}
		else
		{
			$salt = substr($hash_password_db->password, 0, $this->salt_length);

			$db_password =  $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
		}

		if($db_password == $hash_password_db->password)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Generates a random salt value for forgotten passwords or any other keys. Uses SHA1.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function hash_code($password)
	{
		return $this->hash_password($password, FALSE, TRUE);
	}

	/**
	 * Generates a random salt value.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function salt()
	{
		return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
	}
	
	public function getUserDetails($user_id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_users');
		$this->db->where('customer_user_id', $user_id);
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
			$this->getUserDetails($user_id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function getCustomerDetails($customer_id,$i=null){
		$this->db->select('customers.*,customer_users.email_verification');
		$this->db->from('customers');
		$this->db->join('customer_users','customers.customer_id=customer_users.customer_id');
		$this->db->where('customers.customer_id', $customer_id);
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
			$this->getCustomerDetails($customer_id,$i);
		}else{
			return $query->result();
		}
	}
	
	
	public function updateCustomerDetail($details, $customerId, $user_id){
		
		$user_details = array(
			'username' => $details['firstName'],
			'email' => $details['email'],
			'first_name' => $details['firstName'],
			'last_name' => $details['lastName'],
			'company' => $details['brand_name'],
			'phone' => $details['mobile'],
			'status' => 'Complete'
			);
	
			
		$this->db->where('customer_id', $customerId);
		$this->db->update('customers', $details);
		
		$this->db->where('customer_user_id', $user_id);
		$this->db->update('customer_users', $user_details);
		
		//branch add
		$details1 = array(
			'unit' => $details['unit'],
			'street' => $details['street'],
			'suburb' => $details['suburb'],
			'postcode' => $details['postcode'],
			'state' => $details['state'],
			'customer_id' => $customerId,
			'branch_name' => $details['brand_name'],
		);
		
		$this->db->insert('customer_branches', $details1);
		$branch_id = $this->db->insert_id();
		
		//branch access
		$b_details['customer_user_id'] = $user_id;
		$b_details['branch_id'] = $branch_id;
		
		$res = $this->db->insert('branches_access', $b_details);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	
	//05102017
	// Branches starts
	
	function get_branches($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('customer_id',$customer_id);
		$query=$this->db->get();
		
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
			$this->get_branches($i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	function cust_branches($i=null){
		$user_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('customer_id',$user_id);
		$query=$this->db->get();
		
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
			$this->cust_branches($i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	function submit_update_branches($data,$branch_id,$i=null){
		 $this->db->where('branch_id',$branch_id);
		$result = $this->db->update('customer_branches',$data);
		 
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
			$this->submit_update_branches($data,$branch_id,$i);
		}else{
			return $result;
		}
		 
	 }
     function edit_branches_detail_row_details($data, $id,$i=null){		
		$this->db->where('branch_id',$id);
	    $result = $this->db->update('customer_branches', $data);
	    
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
			$this->edit_branches_detail_row_details($data, $id,$i);
		}else{
			return $result;
		}
	    
	}
     function add_branches($data,$i=null){
      $this->db->insert('customer_branches',$data);	
      $res_id = $this->db->insert_id();
	  
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
			$this->add_branches($data,$i);
		}else{
			return $res_id;
		}
	 }	
	 // Users starts
	 function get_users($id="",$i=null){
	     $user_id = $this->session->userdata('customerId');
	     
		$this->db->select('customer_users.*,customer_users_groups.group_id,customer_groups.name, customer_groups.clearanceLevel');
		$this->db->from('customer_users');
		$this->db->join('customer_users_groups','customer_users.customer_user_id=customer_users_groups.user_id');
		$this->db->join('customer_groups','customer_users_groups.group_id = customer_groups.id');
		$this->db->where('customer_users.customer_id',$user_id);
		if($id != ''){
		  	$this->db->where('customer_users.customer_user_id',$id);  
	     }
	     $this->db->where('customer_users.is_haccap_user','0');
	     $this->db->where('customer_users.is_outlet_manager','0');
	     $this->db->where('customer_users.is_preparea_user','0');
		$this->db->order_by('customer_groups.clearanceLevel', 'DESC');
		$this->db->order_by('customer_users.first_name', 'ASC');
		$query=$this->db->get();
// 		echo $this->db->last_query();exit;
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
			$this->get_users($id,$i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	function get_users_admin($id='',$i=null){
	    
	    $user_id = $this->session->userdata('customerId');
	    
		$branch_id = $this->session->userdata('branch_id');
		
		if($id != ''){
		  	$whr = " AND customer_users.customer_user_id = ".$id; 
	     }
	     else{
	         $whr ='';
	     }
        $query = $this->db->query("SELECT customer_users.*,customer_users_groups.group_id,customer_groups.name FROM customer_users LEFT JOIN customer_users_groups ON customer_users.customer_user_id=customer_users_groups.user_id LEFT JOIN customer_groups ON customer_users_groups.group_id = customer_groups.id  WHERE customer_users.customer_id='".$user_id."' ".$whr." AND group_id <> 7");
        
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
			$this->get_users_admin($i);
		}else{
			$res56 = $query->result();
            return $res56;
		}
	}
	function cust_branches_checked($user_id,$i=null){
		$this->db->select('branch_id');
		$this->db->from('branches_access');
		$this->db->where('customer_user_id',$user_id);
		$query=$this->db->get();
		
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
			$this->cust_branches_checked($user_id,$i);
		}else{
			$result = $query->result();
		    return $result;
		}
	}
	function branches_checked_data($id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('branch_id',$id);
		$query=$this->db->get();
		
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
			$this->branches_checked_data($id,$i);
		}else{
			$result = $query->result();
		    return $result;
		}
	}
	 function edit_users_detail_row_details($customer_user_id,$first_name,$last_name,$email,$status,$user_type,$branch_id,$customer_id,$pwd,$i=null){
		   
		
		
		if($first_name =='' || $email  == '' || $user_type  == '' || (isset($branch_id ) && empty($branch_id )) || !isset($branch_id )){
			return false;
		}else{
	        $data = array(
			  'username' => $first_name .' '.$last_name ,
			  'first_name' => $first_name ,
			  'last_name' => $last_name ,
			  'email' => $email ,
			  'customer_id' => $customer_id,
			  'active' => $status 
			);
			
			 if($pwd !=''){
		     $salt       = $this->store_salt ? $this->salt() : FALSE;
		    $password   = $this->hash_password($pwd, $salt); 
		    $data['password'] = $password;
		    }
		    
			$this->db->where('customer_user_id',$customer_user_id);
		    $result = $this->db->update('customer_users', $data);
		  //  echo $this->db->last_query();
		    $details = array(
		    	'user_id' => $customer_user_id,
		    	'group_id' => $user_type 
		    	);
		    
		    $this->db->where('user_id',$customer_user_id);
		    $this->db->update('customer_users_groups', $details);
		    
	    	$this->db->where('customer_user_id',$customer_user_id);
		    $this->db->delete('branches_access');
			
			if(isset($branch_id) && !empty($branch_id)){
		    	foreach($branch_id as $branch){
		    		$details_data = array(
				    	'branch_id' => $branch,
				    	'customer_user_id' => $customer_user_id
		            	);
		           $this->db->insert('branches_access', $details_data); 	
		    	}
			}
			
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
				$this->edit_users_detail_row_details($customer_user_id,$first_name,$last_name,$email,$status,$user_type,$branch_id,$customer_id,$pwd,$i);
			}else{
				return $result;
			}
		}
	    
	    
	}
	
// 	function edit_users_detail_row_details($key,$first_name,$last_name,$email,$status,$user_type,$branch_id,$customer_id,$i=null){
		
// 		if($first_name[$key] =='' || $email[$key] == '' || $user_type[$key] == '' || (isset($branch_id[$key]) && empty($branch_id[$key])) || !isset($branch_id[$key])){
// 			return false;
// 		}else{
// 	        $data = array(
// 			  'username' => $first_name[$key].' '.$last_name[$key],
// 			  'first_name' => $first_name[$key],
// 			  'last_name' => $last_name[$key],
// 			  'email' => $email[$key],
// 			  'customer_id' => $customer_id,
// 			  'active' => $status[$key]
// 			);	
// 			$this->db->where('customer_user_id',$key);
// 		    $result = $this->db->update('customer_users', $data);
		    
// 		    $details = array(
// 		    	'user_id' => $key,
// 		    	'group_id' => $user_type[$key]
// 		    	);
		    
// 		    $this->db->where('user_id',$key);
// 		    $this->db->update('customer_users_groups', $details);
		    
// 	    	$this->db->where('customer_user_id',$key);
// 		    $this->db->delete('branches_access');
			
// 			if(isset($branch_id[$key]) && !empty($branch_id[$key])){
// 		    	foreach($branch_id[$key] as $branch){
// 		    		$details_data = array(
// 				    	'branch_id' => $branch,
// 				    	'customer_user_id' => $key
// 		            	);
// 		           $this->db->insert('branches_access', $details_data); 	
// 		    	}
// 			}
			
// 		    $errors = $this->db->error();
// 			if($errors['code'] != 0){
// 				if($i == null){
// 					$i = 1;
// 				}else{
// 					$i = $i+1;
// 				}
				
// 				if($i == 5){
// 					show_error('error '+$i);
// 				}
// 				sleep(5);
// 				$this->edit_users_detail_row_details($key,$first_name,$last_name,$email,$status,$user_type,$branch_id,$customer_id,$i);
// 			}else{
// 				return $result;
// 			}
// 		}
	    
	    
// 	}
     function add_users($new_first_names,$new_last_name,$new_email,$new_user_type,$new_branch_id,$customer_id, $pwd,$i=null){
		 
		$salt       = $this->store_salt ? $this->salt() : FALSE;
		$password   = $this->hash_password($pwd, $salt);
		
        $data = array(
		  'username' => $new_first_names.' '.$new_last_name,
		  'first_name' => $new_first_names,
		  'last_name' => $new_last_name,
		  'email' => $new_email,
		  'password' => $password,
		  'active' => 0,
		  'status' => "New",
		  'customer_id' => $customer_id
		);	
       //echo '<pre>';print_r($data);exit;
       $this->db->insert('customer_users',$data);
       $id = $this->db->insert_id();
    
       $details = array(
	    	'user_id' => $id,
	    	'group_id' => $new_user_type
	    	);
	    $this->db->insert('customer_users_groups', $details);
	    
	    foreach($new_branch_id as $branch){
		    $details_data = array(
		    	'branch_id' => $branch,
		    	'customer_user_id' => $id,
		    	);
			$this->db->insert('branches_access', $details_data);
	    }
       $errors = $this->db->error();
// 			if($errors['code'] != 0){
// 				if($i == null){
// 					$i = 1;
// 				}else{
// 					$i = $i+1;
// 				}
				
// 				if($i == 5){
// 					show_error('error '+$i);
// 				}
// 				sleep(5);
// 				$this->add_users($new_first_names,$new_last_name,$new_email,$new_user_type,$new_branch_id,$customer_id, $pwd,$i);
// 			}else{
				return $id;
// 			}
	 }
	 
	 public function deleteUsers($ids){
	 	$userids = explode(',',$ids ?? '');
	 	foreach($userids as $cusId){
	 		//customer users
	 		$this->db->where('customer_user_id',$cusId);
	    	$this->db->delete('customer_users');
	    	
	    	$this->db->where('user_id',$cusId);
	    	$this->db->delete('customer_users_groups');
	    
	 		$this->db->where('customer_user_id',$cusId);
	    	$this->db->delete('branches_access');
	 	}
	 }
	 // 17-11-2017
	 
	 function get_suppliers($i=null){
	 	$user_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('customer_id',$user_id);
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
			$this->get_suppliers($i);
		}else{
			return $query->result();
		}
	 }

	
	function get_branch_detail($id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('branch_id',$id);
		$query=$this->db->get();
		
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
			$this->get_branch_detail($id,$i);
		}else{
			$result = $query->result();
		    return $result;
		}
	}
	public function getSupplierBranches($supId,$i=null){
		$this->db->select('*');
		$this->db->from('supplier_branch_access');
		$this->db->where('branch_id',$supId);
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
			$this->getSupplierBranches($supId,$i);
		}else{
			return $query->result();
		}
	}
	
	function update_branch($details,$branch_id,$i=null){
		 $this->db->where('branch_id',$branch_id);
		 $result = $this->db->update('customer_branches',$details);
		 
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
			$this->update_branch($details,$branch_id,$i);
		}else{
			return $result;
		}
		 
	}
	 
	 public function deleteSupplierBranches($supId,$i=null){
		$this->db->where('branch_id',$supId);
		$result = $this->db->delete('supplier_branch_access');
		
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
			$this->deleteSupplierBranches($supId,$i);
		}else{
			return $result;
		}
		
	}
	 
	public function addSupplierBudget($data,$i=null){
	    $result = $this->db->insert('supplier_branch_access',$data);
		
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
			$this->addSupplierBudget($data,$i);
		}else{
			return $result;
		}
		
	}
	
	function branch_delete($id,$i=null){
		$this->db->where('branch_id',$id);
		$result = $this->db->delete('customer_branches');
		
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
			$this->branch_delete($id,$i);
		}else{
			return $result;
		}
		
	}
	
	public function supplier_branch_delete($supId,$i=null){
		$this->db->where('branch_id',$supId);
		$result = $this->db->delete('supplier_branch_access');
		
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
			$this->supplier_branch_delete($supId,$i);
		}else{
			return $result;
		}
		
	}
	
	//get user group details
	public function getUserGroupDetails($group_id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_groups');
		$this->db->where('id',$group_id);
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
			$this->getUserGroupDetails($group_id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function getSubscriptionDetails($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('customer_subscription_relation');
		$this->db->where('customer_id',$customer_id);
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
			$this->getSubscriptionDetails($i);
		}else{
			return $query->result();
		}
	}
	public function get_active_branches($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('count(*) as cnt');
		$this->db->from('customer_branches');
		$this->db->where('customer_id',$customer_id);
		$this->db->where('status','1');
		$query=$this->db->get();
		
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
			$this->get_active_branches($i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	public function getUserPackageDetails($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('c.*,p.package_name,p.validity,p.no_of_users as base_users,p.no_of_branches as base_branches,p.no_of_orders as base_orders,p.amount as package_amount,p.trail_period');
		$this->db->from('customer_subscription_relation as c');
		$this->db->join('packages as p', 'p.package_id = c.package_id');
		$this->db->where('c.customer_id',$customer_id);
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
			$this->getUserPackageDetails($i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	public function getAddons($package_id,$i=null){
		$this->db->select('*');
		$this->db->from('addon_items');
		$this->db->where('package_id',$package_id);
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
			$this->getAddons($package_id,$i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	public function getPackages($i=null){
		$this->db->select('*');
		$this->db->from('packages');
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
			$this->getPackages($i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	public function getPackageDetails($package_id,$i=null){
		$this->db->select('*');
		$this->db->from('packages');
		$this->db->where('package_id',$package_id);
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
			$this->getPackageDetails($package_id,$i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	public function updatePackage($data,$i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->where('customer_id',$customer_id);
		$result = $this->db->update('customer_subscription_relation',$data);
		
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
			$this->updatePackage($data,$i);
		}else{
			return $result;
		}
		
	}
	public function customer_details($i=null){
		$customer_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('customer_users');
		$this->db->where('customer_user_id',$customer_id);
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
			$this->customer_details($i);
		}else{
			$result=$query->result();
		    return $result;
		}
	}
	public function update_profile($data,$i=null){
		$customer_id = $this->session->userdata('user_id');
		$this->db->where('customer_user_id',$customer_id);
		$result = $this->db->update('customer_users',$data);
		
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
			$this->update_profile($data,$i);
		}else{
			return $result;
		}
		
	} 
	public function updateEmailVerification($customer_id,$i=null){
		$data['email_verification'] = 1;
		$this->db->where('customer_user_id',$customer_id);
		$result = $this->db->update('customer_users',$data);
		
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
			$this->updateEmailVerification($customer_id,$i);
		}else{
			return $result;
		}
		
	}
	public function customer_branch_delete($supId,$i=null){
		$this->db->where('branch_id',$supId);
		$result = $this->db->delete('customer_branches');
		
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
			$this->customer_branch_delete($supId,$i);
		}else{
			return $result;
		}
		
	}
}
?>