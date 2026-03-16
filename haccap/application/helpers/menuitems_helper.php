<?php
 
   function display_menu(){
        $CI =& get_instance();
     $CI->load->library('ion_auth');
     $CI->load->library('session');
     
        if($CI->session->userdata('supervisor') !=''){ 
             $menus = $CI->ion_auth->getMenusdynamic();
        }else{
            $menus = $CI->ion_auth->getMenus(); 
        }
       
       
				$menu_items = array();
				 $userlevel = $CI->session->userdata('clearance_level');
			
				
				foreach($menus as $key=>$menu){
					if($userlevel >= $menu->level){
						$menu_items[$key] = $menu;
						$submenu_items = array();
						$sub_menus = $CI->ion_auth->getSubMenus($menu->menu_id);
						if(!empty($sub_menus)){
							foreach($sub_menus as $key1 => $submenu){
								if($userlevel >= $submenu->level){
									$submenu_items[$key1] = $submenu;
								}
							}
						}
						$menu_items[$key]->submenus = $submenu_items;
					}
				}
        
        return $menu_items;
    }
    

?>