<?php if(isset($form_type) && $form_type == 'view'){ $disabled='disabled'; } else{ $disabled = ''; }
    $id=$table_name.'_id'; 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <style>
      .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}
.bg-black{ 
    background-color: #000;
    color: #fff;
}
input::placeholder,textarea::placeholder,*::placeholder {
    text-transform: capitalize;
}
span.fieldChange.rightfloat {
    float: right;
    color: #4b38b3;
    font-weight: 700;
    cursor: pointer;
}
.fieldChangeselect{
    display:none;
}
.customTableCell{
    width:100%;
    height:100%;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    padding: .5rem .9rem;
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5;
}
th .customTableCell{
    text-align:center;
}
.highlightedCell{
        background-color: #f06a28 !important;
    color: #fff;
    font-weight: 500;
}
 select{
    -webkit-appearance: auto !important;
    -moz-appearance: auto !important;
    appearance: auto !important;
 }  
 .border-right{
     border-right: 1px solid #eee;
 }
 td.menubtns-width {
    vertical-align: bottom;
    padding-bottom: 5px;
}
tr.menurow:nth-child(even) {
    background-color: #f1f1f1;
}
 @media(max-width:1024px){
    .border-right{
        border-right: 0px solid #eee;
    }
 }
 <?php if(isset($form_type) && $form_type == 'view'){ ?>
 select{
     -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
 }
 <?php } ?>
 
 
select.selectdropdown {
    display: none !important;
}

.dropdown-select {
   cursor: pointer;
    display: block;
    padding-right: 30px;
    position: relative;
    text-align: left !important;
    transition: all 0.2s ease-in-out;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    white-space: nowrap;
    width: 100%;

}

.dropdown-select:focus {
    background-color: #fff;
}

.dropdown-select:hover {
    background-color: #fff;
}

.dropdown-select:active,
.dropdown-select.open {
    background-color: #fff !important;
    border-color: #bbb;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
}

.dropdown-select:after {
    height: 0;
    width: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #777;
    -webkit-transform: origin(50% 20%);
    transform: origin(50% 20%);
    transition: all 0.125s ease-in-out;
    content: '';
    display: block;
    margin-top: -2px;
    pointer-events: none;
    position: absolute;
    right: 10px;
    top: 50%;
}

.dropdown-select.open:after {
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg);
}

.dropdown-select.open .list {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
    pointer-events: auto;
}

.dropdown-select.open .option {
    cursor: pointer;
}

.dropdown-select.wide {
    width: 100%;
}

.dropdown-select.wide .list {
    left: 0 !important;
    right: 0 !important;
}

.dropdown-select .list {
    box-sizing: border-box;
    transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
    -webkit-transform: scale(0.75);
    transform: scale(0.75);
    -webkit-transform-origin: 50% 0;
    transform-origin: 50% 0;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
    background-color: #fff;
    border-radius: 6px;
    margin-top: 4px;
    padding: 3px 0;
    opacity: 0;
    overflow: hidden;
    pointer-events: none;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 999;
    max-height: 250px;
    overflow: auto;
    border: 1px solid #ddd;
}

.dropdown-select .list:hover .option:not(:hover) {
    background-color: transparent !important;
}
.dropdown-select .dd-search{
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:center;
  margin:2px;
}

.dropdown-select .dd-searchbox {
    width: 100%;
    padding: 2px;
    border: 1px solid #999;
    border-color: #999;
    border-radius: 4px;
    outline: none;
}
.dropdown-select .dd-searchbox:focus{
  border-color:#12CBC4;
}

.dropdown-select .list ul {
    padding: 0;
}

.dropdown-select .option {
    cursor: default;
    font-weight: 400;
    line-height: 40px;
    outline: none;
    padding-left: 5px;
    padding-right: 5px;
    text-align: left;
    transition: all 0.2s;
    list-style: none;
}

.dropdown-select .option:hover,
.dropdown-select .option:focus {
    background-color: #f6f6f6 !important;
}

.dropdown-select .option.selected {
    font-weight: 600;
    color: #12cbc4;
}

.dropdown-select .option.selected:focus {
    background: #f6f6f6;
}

.dropdown-select a {
    color: #aaa;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
}

.dropdown-select a:hover {
    color: #666;
}
.supplierCostTable td.dropdownautocomplete, .supplierCostTable th.dropdownautocomplete{
    width:60%;
}

  </style>
 <!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList">
                    
                        <form action="<?php echo base_url() ?>index.php/records/submit_<?php echo $table_name;?>" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0 txt-uppercase">
                                         <?php if($form_type == 'edit'){ echo "Edit "; } else if($form_type == 'add'){ echo "Add "; }else if($form_type == 'view'){ echo "View  "; } echo $form_fields['page_name']; ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/records/list/<?php echo $table_name;?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                   <?php if($form_type == 'edit'){?>
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    
                                   <?php }else if($form_type == 'add'){?>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                    <?php }?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                              <?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
                            <div class='hideMe'>
                              <p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
                            </div>
                            <?php } ?>
                            <?php if(null !==$this->session->userdata('error_msg')) { ?>  
                            <div class='hideMe'>
                              <p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                           
                                <div class="row">
                                    <input type="hidden" name="table_name" value="<?php echo $table_name;?>">
                                    <input type="hidden" id="form_type" name="form_type" value="<?php echo $form_type;?>">
                                     <?php if($form_type == 'edit'){  ?>
                                          <input class="form-control" type="hidden" name="id" value="<?php echo $form_fields_data['record'][$id];?>">
                                      <?php } ?>
                                       
                          </div>
                          <?php if($form_fields['form_field_type'] == 'multiRows'){ ?>
                        <!--form start-->
                        <div class="row with_tabs">
                            <div class="col-lg-12">
                                	<div class="create_menu_wrap">
									    <div class="row">
									        <div class="col-lg-12">
									            <div class="row">
									                <?php foreach($form_fields['field_data'] as $field){ ?>
                                                    <?php if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                                        <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                            <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                            <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                        </div>
                                                    <?php }else if($field['field_type'] == 'date'){ $field_name = $field['field_name']; ?>
                                                        <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                            <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                            <input type="date"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                        </div>
                                                    
                                                    <?php } else if($field['field_type'] == 'dropdown'){  $field_name = $field['field_name']; ?>
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label><?php echo str_replace("_"," ",$field_name) ?></label>
                                                            <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>" required id="<?php echo $field_name; ?>">
                                                                <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                
                                                                <?php if($field['field_content'] != ''){ $listOptName = $field['field_content'];?>
                                                                    <?php foreach($form_fields[$listOptName] as $row){ 
                                                                        if( $row->id == $form_fields_data['record']['sub_category']){
                                                                    ?>
                                                                        <option value="<?php echo $row['id']; ?>" selected><?php echo $row['name']; ?></option>
                                                                       <?php } else{ ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                                    <?php } } ?>
                                                                
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>
                                                        
                                                    <?php }else{} ?>
                                                    
                                                    
                                                <?php } ?>
									            </div>
									        </div>
									        <div class="col-lg-7 col-md-12 mb-3 border-right">
									            
                                        
                                               <div class="">
                                                 <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                   
                                                    <tbody>
                                                        <?php if(!empty($form_fields_data['record']['content'])){ $i=1;
                                                        foreach($form_fields_data['record']['content'] as $row ){ ?>
                                           
                                                        <tr class="menurow">
                                                           
                                                           <?php foreach($form_fields['field_data_repeat'] as $field){ ?>
                                                            <?php if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]" value="<?php echo $row[$field_name]; ?>" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                                </td>
                                                            <?php }else if($field['field_type'] == 'date'){ $field_name = $field['field_name']; ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <input type="date"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]" value="<?php echo $row[$field_name]; ?>" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                                </td>
                                                                
                                                            <?php }else if($field['field_type'] == 'number'){ $field_name = $field['field_name']; ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <input type="number"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]" value="<?php echo $row[$field_name]; ?>" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                                </td>
                                                            
                                                            <?php } else if($field['field_type'] == 'dropdown'){  $field_name = $field['field_name']; ?>
                                                               <td class="menuinput-width">
                                                                    <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>[]" required id="<?php echo $field_name; ?>">
                                                                        <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                        
                                                                        <?php if($field['field_content'] != ''){ $listOptName = $field['field_content'];?>
                                                                            <?php foreach($form_fields[$listOptName] as $row1){ 
                                                                                if( $row1['id'] == $row[$field_name]){
                                                                            ?>
                                                                                <option value="<?php echo $row1['id']; ?>" selected><?php echo $row1['name']; ?></option>
                                                                               <?php } else{ ?>
                                                                                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                                                                            <?php } } ?>
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <?php } else if( $field['field_type'] == 'dropdownautocomplete' && $form_type == 'view'){  $field_name = $field['field_name']; 
                                                                    
                                                                ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                     <?php if($row[$field_name] != ''){
                                                                        $field_name = 'input_'.$field_name;
                                                                    } ?>
                                                                    <input type="text"  <?php echo $disabled; ?> class="form-control <?php echo $field_name; ?>"  value="<?php echo $row[$field_name]; ?>" placeholder="Supplier Name">
                                                                </td>
                                                                <?php } else if($field['field_type'] == 'dropdownautocomplete'){  $field_name = $field['field_name']; ?>
                                                               <td class="menuinput-width dropdownautocomplete">
                                                                    <label><?php echo str_replace("_"," ",$field_name) ?> </label><span class="fieldChange rightfloat fieldChangeinput" onclick="fieldChangeinput(this)">Add supplier manually</span><span class="fieldChange rightfloat fieldChangeselect" onclick="fieldChangeselect(this)">Select manually</span>
                                                                    <select  <?php echo $disabled; ?> class="form-control selectdropdown" name="<?php echo $field_name; ?>[]" data-rel="<?php echo str_replace("_"," ",$field_name) ?>" id="<?php echo $field_name; ?>">
                                                                        <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                        
                                                                        <?php if($field['field_content'] != ''){ $listOptName = $field['field_content'];?>
                                                                            <?php foreach($form_fields[$listOptName] as $row1){ 
                                                                                if( $row1['id'] == $row[$field_name]){
                                                                            ?>
                                                                                <option value="<?php echo $row1['id']; ?>" selected><?php echo $row1['name']; ?></option>
                                                                               <?php } else{ ?>
                                                                                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                                                                            <?php } } ?>
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                    </select>
                                                                    <input type="text"  <?php echo $disabled; ?> class="form-control input_selectdropdown" name="input_<?php echo $field_name; ?>[]" value="<?php echo $row[$field_name]; ?>" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" style="display:none;">
                                                                </td>
                                                                
                                                            <?php }else{} } ?>
                                                           
                                                            
                                                               <?php if($form_type != 'view'){  ?>
                                                            <td class="menubtns-width">
                                                                <div class="ct-btns">
                                                                         <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                        <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                         </div>
                                                            </td>
                                                           <?php } ?>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php } else{ ?>
                                                        <tr class="menurow">
                                                           <?php foreach($form_fields['field_data_repeat'] as $field){ ?>
                                                            <?php if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                                </td>
                                                            <?php }else if($field['field_type'] == 'date'){ $field_name = $field['field_name']; ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <input type="date"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                                </td>
                                                                 <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                            <?php }else if($field['field_type'] == 'number'){ $field_name = $field['field_name']; ?>
                                                                <td class="menuinput-width">
                                                                     <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <input type="number"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                                </td>
                                                            
                                                            <?php } else if($field['field_type'] == 'dropdown' ){  $field_name = $field['field_name']; ?>
                                                               <td class="menuinput-width">
                                                                    <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                    <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>[]" required id="<?php echo $field_name; ?>">
                                                                        <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                        
                                                                        <?php if($field['field_content'] != ''){ $listOptName = $field['field_content'];?>
                                                                            <?php foreach($form_fields[$listOptName] as $row){ 
                                                                               
                                                                            ?>
                                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                                            <?php }  ?>
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <?php } else if($field['field_type'] == 'dropdownautocomplete'){  $field_name = $field['field_name']; ?>
                                                               <td class="menuinput-width dropdownautocomplete">
                                                                    <label><?php echo str_replace("_"," ",$field_name) ?> </label><span class="fieldChange rightfloat fieldChangeinput" onclick="fieldChangeinput(this)">Add supplier manually</span><span class="fieldChange rightfloat fieldChangeselect" onclick="fieldChangeselect(this)">Select manually</span>
                                                                    <select  <?php echo $disabled; ?> class="form-control selectdropdown" name="<?php echo $field_name; ?>[]" data-rel="<?php echo str_replace("_"," ",$field_name) ?>" id="<?php echo $field_name; ?>">
                                                                        <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                        
                                                                        <?php if($field['field_content'] != ''){ $listOptName = $field['field_content'];?>
                                                                            <?php foreach($form_fields[$listOptName] as $row1){ 
                                                                                if( $row1['id'] == $row[$field_name]){
                                                                            ?>
                                                                                <option value="<?php echo $row1['id']; ?>" selected><?php echo $row1['name']; ?></option>
                                                                               <?php } else{ ?>
                                                                                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                                                                            <?php } } ?>
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                    </select>
                                                                    <input type="text"  <?php echo $disabled; ?> class="form-control input_selectdropdown" name="input_<?php echo $field_name; ?>[]" value="<?php echo $row[$field_name]; ?>" placeholder="<?php echo str_replace("_"," ",$field_name) ?>" style="display:none;">
                                                                </td>
                                                            <?php }else{} } ?>
                                                            
                                                            <td class="menubtns-width">
                                                                <div class="ct-btns">
                                                                         <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                        
                                                                         </div>
                                                            </td>
                                                           
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                                    
									        </div>
									        
									        <!--bottom form-->
                                            
									        <div class="col-lg-5 ">
									            <?php foreach($form_fields['field_data_bottom'] as $field){ ?>
									            <?php if($field['field_type'] == 'dropdown_table'){ ?>
									                    <table style="max-width:100%;width:100%;">
									                    <thead>
									                        <tr>
									                        <th style="width:50%">
									                                <?php $field_name = $field['field_name']; ?>
                                                                                <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>" required id="<?php echo $field_name; ?>" onchange="fetchData(this)">
                                                                                <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                                
                                                                                <?php if($field['field_content'] != ''){ ?>
                                                                                <?php $listData =$field['field_content']; ?>
                                                                                    <?php foreach($form_fields[$listData] as $list){ 
                                                                                        if($list['id'] == $form_fields_data['record']['main_category_id']){
                                                                                    ?>
                                                                                        <option value="<?php echo $list['id']; ?>" selected><?php echo $list['name']; ?></option>
                                                                                        <?php }else{ ?>
                                                                                        <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                                                                                    <?php  } } ?>
                                                                                
                                                                                <?php } ?>
                                                                                
                                                                            </select>
                                                                       
									                        </th>
									                        <th style="width:50%">
									                                
                                                                <select <?php echo $disabled; ?> <?php if($form_fields_data['record']['supplier_id'] == '' ){ echo "disabled"; } ?> class="form-control" name="supplier_id" id="supplier_id" >
                                                                    <option value="">Supplier</option>
                                                                    <?php if($form_fields_data['record']['supplier_id'] != ''){
                                                                    foreach($form_fields['suppliers'] as $row){ 
                                                                        if(in_array($row['id'],$form_fields_data['record']['associated_supplier'])){
                                                                        if($row['id'] == $form_fields_data['record']['supplier_id']){
                                                                    ?>
                                                                    <option value="<?php echo $row['id']; ?>" selected><?php echo $row['name']; ?></option>
                                                                    <?php }else{ ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                                    <?php } } } } ?>
                                                                </select>
                                                                       
									                        </th>
									                        
									                        </tr>
									                        <tr><th><div class="customTableCell bg-black">Category Name</div></th><th><div class="customTableCell bg-black">Bill</div></th></tr>
									                    </thead>
									                    <tbody id="dataWrap">
									                        <?php if(!empty($form_fields_data['record']['sub_category'])){ 
									                            $total = 0;
                                                                $price = 0;
									                            foreach($form_fields_data['record']['sub_category'] as $tablerow){
									                                
                                                                    if($tablerow['price'] != 0 && $tablerow['price'] != '' && $tablerow['price'] != null){
                                                                         $total=$total+$tablerow['price'];
                                                                         $price = $tablerow['price'];
                                                                     }else{
                                                                        $price = 0;
                     }
									                            ?>
									                            <tr><td><div class="customTableCell"><?php echo $tablerow['sub_category_name']; ?></div></td><td><input type="hidden" name="price_id[]" value="<?php echo $tablerow['supplier_sub_category_id']; ?>"><input class="form-control category_cost" type="number" <?php echo $disabled; ?> name="price[]" onclick="addCost(this)" id="<?php echo $tablerow['supplier_sub_category_id']; ?>" value="<?php echo $price; ?>"></td></tr>
									                            <?php } ?>
									                            <tr><td><div class="customTableCell highlightedCell">Total</div></td><td><input class="form-control highlightedCell" type="number" <?php echo $disabled; ?> name="total_cost" id="totalCost" value="<?php echo $total; ?>" readonly></td></tr>
									                        <?php } ?>
									                    </tbody>
									                </table>
									            
									            <?php }else if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                                    <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                    
                                                <?php }else if($field['field_type'] == 'date'){ $field_name = $field['field_name']; ?>
                                                    <input type="date"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  placeholder="<?php echo str_replace("_"," ",$field_name) ?>" required >
                                                
                                                
                                                <?php } else if($field['field_type'] == 'dropdown'){  $field_name = $field['field_name']; ?>
                                                            <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>" required id="<?php echo $field_name; ?>" onchange="fetchData(this)">
                                                            <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                            
                                                            <?php if($field['field_content'] != ''){ ?>
                                                            <?php $listData =$field['field_content']; ?>
                                                                <?php foreach($form_fields[$listData] as $list){ 
                                                                    
                                                                ?>
                                                                    <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                                                                <?php  } ?>
                                                            
                                                            <?php } ?>
                                                            
                                                        </select>
                                                   
                                                <?php }else{} ?>
									                
									                
                                                    
                                                    
                                                <?php } ?>
									         
									        </div>	
									        <!--bottom form-->
									    
									</div>
                            </div>
                           
                        </div>
                        </div>
                        <!--form end-->
                        <?php }else if($form_fields['form_field_type'] == 'tabs'){ ?>
                        <!--form start-->
                        <div class="row with_tabs">
                            <div class="col-lg-12">
                                	<div class="create_menu_wrap">
									    <div class="row">
									        <div class="col-lg-12">
									            <div class="row">
									                <?php foreach($form_fields['field_data'] as $field){ ?>
                                                    <?php if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                                        <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                            <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                            <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  required >
                                                        </div>
                                                    <?php }else if($field['field_type'] == 'date'){ $field_name = $field['field_name']; ?>
                                                        <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                            <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                            <input type="date"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  required >
                                                        </div>
                                                    
                                                    <?php } else if($field['field_type'] == 'dropdown'){  $field_name = $field['field_name']; ?>
                                                        <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                            <label><?php echo str_replace("_"," ",$field_name) ?></label>
                                                            <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>" required id="<?php echo $field_name; ?>">
                                                                <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                
                                                                <?php if($field['field_content'] != ''){ ?>
                                                                    <?php foreach($form_fields['supplier_categories'] as $supplier_category){ 
                                                                        if( $supplier_category->category_id == $form_fields_data['record']['sub_category']){
                                                                    ?>
                                                                        <option value="<?php echo $supplier_category->category_id; ?>" selected><?php echo $supplier_category->category_name; ?></option>
                                                                       <?php } else{ ?>
                                                                        <option value="<?php echo $supplier_category->category_id; ?>"><?php echo $supplier_category->category_name; ?></option>
                                                                    <?php } } ?>
                                                                
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>
                                                        
                                                    <?php }else{} ?>
                                                    
                                                    
                                                <?php } ?>
									            </div>
									        </div>
									        <div class="col-lg-12">
									            <ul class="tabs">
                                                      <li class="active" rel="Mon">Supplier</li>
                                                    </ul>
                                                    <div class="tab_container">
                                                        <!-- #Mon -->
                                                      <h3 class="d_active tab_drawer_heading" rel="Mon">Supplier</h3>
                                                      <div id="Mon" class="tab_content">
                                                           <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    <tr class="menurow">
                                                                       <?php foreach($form_fields['field_data_repeat'] as $field){ ?>
                                                                        <?php if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                                                            <td class="menuinput-width">
                                                                                <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                                <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  required >
                                                                            </td>
                                                                        <?php }else if($field['field_type'] == 'date'){ $field_name = $field['field_name']; ?>
                                                                            <td class="menuinput-width">
                                                                                <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                                                                <input type="date"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  required >
                                                                            </td>
                                                                        
                                                                        <?php } else if($field['field_type'] == 'dropdown'){  $field_name = $field['field_name']; ?>
                                                                           <td class="menuinput-width">
                                                                                <label><?php echo str_replace("_"," ",$field_name) ?></label>
                                                                                <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>" required id="<?php echo $field_name; ?>">
                                                                                    <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                                                                    
                                                                                    <?php if($field['field_content'] != ''){ ?>
                                                                                        <?php foreach($form_fields['supplier_categories'] as $supplier_category){ 
                                                                                            if( $supplier_category->category_id == $form_fields_data['record']['sub_category']){
                                                                                        ?>
                                                                                            <option value="<?php echo $supplier_category->category_id; ?>" selected><?php echo $supplier_category->category_name; ?></option>
                                                                                           <?php } else{ ?>
                                                                                            <option value="<?php echo $supplier_category->category_id; ?>"><?php echo $supplier_category->category_name; ?></option>
                                                                                        <?php } } ?>
                                                                                    
                                                                                    <?php } ?>
                                                                                    
                                                                                </select>
                                                                            </td>
                                                                            
                                                                        <?php }else{} } ?>
                                                                        
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                      </div>
                                                      <!--tab panel ends-->
                                                    </div>
									        </div>
									    </div>
									</div>
                            </div>
                           
                        </div>
                        <!--form end-->
                        <?php }else{ ?> 
                        <div class="row without_tabs">
                            <?php foreach($form_fields['field_data'] as $field){ ?>
                             <?php if($field['field_type'] == 'text'){ $field_name = $field['field_name']; ?>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                        <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  >
                                        <?php if($field['helping_text'] != ''){ echo "<span class='helpingText'>".$field['helping_text']."</span>"; }?>
                                    </div>
                                    
                                <?php } else if($field['field_type'] == 'text_multiple'){ $field_name = $field['field_name']; ?>
                                    <?php if($form_type != 'view'){ ?>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label><?php echo str_replace("_"," ",$field_name) ?> </label>
                                        <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($form_fields_data['record'][$field_name])){ echo $form_fields_data['record'][$field_name]; } ?>"  >
                                        <?php if($field['helping_text'] != ''){ echo "<span class='helpingText'>".$field['helping_text']."</span>"; }?>
                                    </div>
                                    <?php } ?>
                                    <?php if($field['field_type'] == 'text_multiple' && ($form_type == 'edit' || $form_type == 'view')){ ?>
                                    <?php if($field['table_name'] != ''){ 
                                        
                                    foreach($form_fields_data['record']['sub_category'] as $row){
                                    ?>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label><?php echo str_replace("_"," ",$field_name); ?> </label>
                                        <input type="hidden" name="sub_category_id[]" value="<?php echo $row['supplier_sub_category_id']; ?>"  >
                                        <input type="text"  <?php echo $disabled; ?> class="form-control" id="<?php echo $row['supplier_sub_category_id']; ?>" name="sub_category[]" value="<?php echo $row['sub_category_name']; ?>"  >
                                       
                                    </div>
                                    <?php } } }  ?>
                                
                                <?php } else if($field['field_type'] == 'dropdown'){  $field_name = $field['field_name']; ?>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label><?php echo str_replace("_"," ",$field_name) ?></label>
                                        <select  <?php echo $disabled; ?> class="form-control" name="<?php echo $field_name; ?>" required id="<?php echo $field_name; ?>">
                                            <option value="">Select <?php echo str_replace("_"," ",$field_name) ?></option>
                                            
                                            <?php if($field['field_content'] != ''){ $listOptName = $field['field_content'];?>
                                                <?php foreach($form_fields[$listOptName] as $row){ 
                                                    if( $row->id == $form_fields_data['record']['sub_category']){
                                                ?>
                                                    <option value="<?php echo $row['id']; ?>" selected><?php echo $row['name']; ?></option>
                                                   <?php } else{ ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } } ?>
                                            
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                    <?php } else if($field['field_type'] == 'multiple_dropdown_opt'){  $field_name = $field['field_name']; ?>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label><?php echo str_replace("_"," ",$field_name) ?></label>
                                        <?php if($form_type == 'view'){ $listOptName = $field['field_content']?>
                                        
                                        <?php foreach($form_fields[$listOptName] as $row){ 
                                            if( in_array($row['id'],$form_fields_data['record']['associated_supplier'])){
                                            ?>
                                                <div class="form-check form-radio-success">
                                                    <input class="form-check-input" type="radio" checked="" disabled=""><label><?php echo $row['name']; ?></label>
                                                </div>
                                                       
                                                
                                                <?php } } ?>
                                        
                                        
                                        <?php }else{ ?>
                                        <select <?php echo $disabled; ?> required multiple="multiple" name="associated_supplier[]" id="multiselect-header">
                                            
                                            <?php if($field['field_content'] != ''){ $listOptName = $field['field_content']; ?>    
                                            <?php foreach($form_fields[$listOptName] as $row){ 
                                                if( in_array($row['id'],$form_fields_data['record']['associated_supplier'])){
                                            ?>
                                                    <option value="<?php echo $row['id']; ?>" selected><?php echo $row['name']; ?></option>
                                                    <?php } else{ ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } } ?>
                                            <?php } ?>
                                        </select>
                                        <?php } ?>
                                    </div>
                                <?php }else{} ?>
                                
                                
                            <?php } ?>
                            
                           
                        </div>
                        <?php } ?>
                  </div>
                 
                
                  
                                </div>
                             
                              
                        </div>
                       
                       
                    </div>
                    </form>
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<script>
    $(document).ready(function(){
        $('.non-selected-wrapper').find('.header').html('Suppliers');
        $('.selected-wrapper').find('.header').html('Selected Suppliers');
    });
    function create_custom_dropdowns() {
    $('.selectdropdown').each(function (i, select) {
        if (!$(this).next().hasClass('dropdown-select')) {
            $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
            var dropdown = $(this).next();
            var options = $(select).find('option');
            var selected = $(this).find('option:selected');
            dropdown.find('.current').html(selected.data('display-text') || selected.text());
            options.each(function (j, o) {
                var display = $(o).data('display-text') || '';
                dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
            });
        }
    });

    $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter(this)" class="dd-searchbox" type="text"></div>');
}

// Event listeners

// Open/close
$(document).on('click', '.dropdown-select', function (event) {
    if($(event.target).hasClass('dd-searchbox')){
        return;
    }
    $('.dropdown-select').not($(this)).removeClass('open');
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
        $(this).find('.option').attr('tabindex', 0);
        $(this).find('.selected').focus();
    } else {
        $(this).find('.option').removeAttr('tabindex');
        $(this).focus();
    }
});

// Close when clicking outside
$(document).on('click', function (event) {
    if ($(event.target).closest('.dropdown-select').length === 0) {
        $('.dropdown-select').removeClass('open');
        $('.dropdown-select .option').removeAttr('tabindex');
    }
    event.stopPropagation();
});

function filter(obj){
    var valThis = $(obj).val();
    var srchbxlist = $(obj).closest('.list').find('li');
    // $(srchbxlist'.dropdown-select ul > li').each(function(){
    $(srchbxlist).each(function(){
     var text = $(this).text();
        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
   });
};
// Search

// Option click
$(document).on('click', '.dropdown-select .option', function (event) {
    $(this).closest('.list').find('.selected').removeClass('selected');
    $(this).addClass('selected');
    var text = $(this).data('display-text') || $(this).text();
    $(this).closest('.dropdown-select').find('.current').text(text);
    $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
});

// Keyboard events
$(document).on('keydown', '.dropdown-select', function (event) {
    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
    // Space or Enter
    //if (event.keyCode == 32 || event.keyCode == 13) {
    if (event.keyCode == 13) {
        if ($(this).hasClass('open')) {
            focused_option.trigger('click');
        } else {
            $(this).trigger('click');
        }
        return false;
        // Down
    } else if (event.keyCode == 40) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            focused_option.next().focus();
        }
        return false;
        // Up
    } else if (event.keyCode == 38) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            focused_option.prev().focus();
        }
        return false;
        // Esc
    } else if (event.keyCode == 27) {
        if ($(this).hasClass('open')) {
            $(this).trigger('click');
        }
        return false;
    }
});

$(document).ready(function () {
    create_custom_dropdowns();
});
</script>
<script>
 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	/* Extra class "tab_last" 
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");


$(document).on("click", ".add_field_button" , function() {
        
         var thisRow = $( this ).closest( 'tbody' )[0];
        $(this).closest('.menurow').clone().appendTo(thisRow).find( 'input:text,textarea' ).val( '' );
        var labelselect = $(this).closest('.menurow').next('.menurow').find( 'select' ).attr('data-rel');
        $(this).closest('.menurow').next('.menurow').find( '.selectdropdown .current' ).html("Select "+labelselect);
        $(this).closest('.menurow').next('.menurow').find( 'input[type=number]' ).val('');
        $(this).closest('.menurow').next('.menurow').find('.selectdropdown').css('display','block');
        $(this).closest('.menurow').next('.menurow').find('.input_selectdropdown').css('display','none');
        $(this).closest('.menurow').next('.menurow').find('.fieldChangeselect').css('display','none');
        $(this).closest('.menurow').next('.menurow').find('.fieldChangeinput').css('display','block');
        var thisRowAddbtn = $(this).closest('.menurow').next('.menurow').find( '.add_field_button' );
        
        if (!$(thisRow).has(".remove_field_button").length) {
            console.log('no btn');
            $('<a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
        } 
            
          
    });
    
    $(document).on("click", ".remove_field_button" , function() {
    
    $(this).parent().parents('.menurow').remove();
});

function fetchData(obj){
    console.log('data');
    var id = $(obj).val();
    var form_type = $('#form_type').val();
    console.log(id);
    if(id != ''){
    $.ajax({
		type: "POST",
		enctype: 'multipart/form-data',
	    url: "<?php echo base_url(); ?>index.php/records/fetchSuppliers",
	    data: {"id":id},
	    success: function(data){
	        
            //  console.log("data2");
            //  console.log(data);
             if(data != 'Norecord'){
                 var suppOptions = '';
                 var data2=JSON.parse(data)
                 suppOptions+='<option value="">Select Supplier</option>'; 
             $.each(data2, function(i, value) {
                
                 suppOptions+='<option value="'+value.id+'">'+value.name+'</option>';
                 
                 
            });
                 
             }
             else{
                 suppOptions+='<option value="">No Supplier Found</option>';
             }
            //  console.log(suppOptions);
            
            $('#supplier_id').html(suppOptions);
             $('#supplier_id').removeAttr('disabled');
	    }
	});
    $.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/records/fetchData",
		    data: {"id":id},
		    success: function(data){
		        
                //  console.log("data2");
                //  console.log(data);
                 if(data != 'Norecord'){
                     var menuOptions = '';
                     var data1=JSON.parse(data)
                     var total = 0;
                     var price = 0;
                    //  menuOptions+='<tr><td><div class="customTableCell">Category Name</div></td><td><div class="customTableCell">Bill</div></td></tr>';
                 $.each(data1, function(i, value) {
                    //  if(value.price != 0 && value.price != '' && value.price != null && form_type != 'add'){
                    //      total=total+parseFloat(value.price);
                    //      price = value.price;
                    //  }else{
                    //     price = 0;
                    //  }
                     menuOptions+='<tr><td><div class="customTableCell">'+value.name+'</div></td><td><input type="hidden" name="price_id[]" value="'+value.id+'"><input class="form-control category_cost" type="number" name="price[]" onclick="addCost(this)" id="'+value.id+'" value="0"></td></tr>';
                     
                     
                });
                 menuOptions+='<tr><td><div class="customTableCell highlightedCell">Total</div></td><td><input class="form-control highlightedCell" type="number" name="total_cost" id="totalCost" value="0" readonly></td></tr>';
                     
                 }
                 else{
                     menuOptions+='<tr><td colspan="2">No Category</td><tr>';
                 }
                //  console.log(menuOptions);
                
                $('#dataWrap').html(menuOptions);
		    }
		});
    }else{
        
         $('#dataWrap').html('');
    }
}

    // $('input').keyup(function(){
function addCost(obj){
    
    console.log('clicked');
    $(obj).keyup(function(){
        var sum=0;
    console.log('loop2');
    $(".category_cost").each(function() {
            console.log($(this).val());
            if($(this).val() == ''){
                sum= sum+0;
            }else{
                sum= sum+parseFloat($(this).val()) || 0;
            }
        });
        $('#totalCost').val(sum);
   });
   
        
        // var value1 = parseFloat($('#value1').val()) || 0;
        // var value2 = parseFloat($('#value2').val()) || 0;
        
}
function fieldChangeinput(obj){
    
    $(obj).closest('.menurow').find('.selectdropdown').css('display','none');
    $(obj).closest('.menurow').find('.input_selectdropdown').css('display','block');
    $(obj).closest('.menurow').find('.fieldChangeinput').css('display','none');
    $(obj).closest('.menurow').find('.fieldChangeselect').css('display','block');
   
}
function fieldChangeselect(obj){
    
    $(obj).closest('.menurow').find('.selectdropdown').css('display','block');
    $(obj).closest('.menurow').find('.input_selectdropdown').css('display','none');
   $(obj).closest('.menurow').find('.fieldChangeselect').css('display','none');
    $(obj).closest('.menurow').find('.fieldChangeinput').css('display','block');
}
</script> 

