<?php if(isset($form_type) && $form_type == 'view'){ $disabled='disabled'; } else{ $disabled = ''; }
    $id=$table_name.'_id'; 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dropzone.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/dropzone.js'); ?>"></script>
<style>
    	.dropzone{
    		min-height:70px;
    		padding:0px 0px;
    	}
      .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.catering_hide{
    display:none;
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
.form-control::placeholder{
    font-size: 12px;
}
.form-icon .form-control-icon {
    padding-left: 0.9rem !important;
}
.form-icon i {
    font-size: 16px;
    top: 1px;
    bottom: 0;
    left: 4px;
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
select.disabled+.dropdown-select {
    cursor: text;
    pointer-events: none;
}
select.disabled+.dropdown-select:after{
    display:none;
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
.ct-btns {
    display: flex;
}
.mainCafeCheckbox{
    pointer-events: none;
}
.mainCafeCheckbox:disabled{
    pointer-events: none;
    opacity: 1;
}

@media(max-width: 1400px){
    label {
        font-weight: 600;
        text-transform: capitalize;
        font-size: 11px;
    }
    [data-layout=horizontal] .container-fluid, [data-layout=horizontal] .layout-width {
    max-width: calc(100% - 15px);
    margin: 0 auto;
}
}
input.form-control{
    font-size: 9px !important;
}
.form-icon i{
   font-size: 12px !important; 
}
input[readonly] {
background-color: #8fb8e0 !important;
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
                    
                    <form enctype='multiaart/form-data' action="<?php echo base_url() ?>index.php/reports/submit_<?php echo $table_name;?>" method="post" id="addEODReports" class="form-horizontal" >    
                    
                        <div class="card-header border-bottom-dashed">
    
                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0 txt-uppercase">
                                             <?php if($form_type == 'edit'){ echo "Edit "; } else if($form_type == 'add'){ echo "Add "; }else if($form_type == 'view'){ echo "View  "; }else if($form_type == 'recreate'){ echo "Re-create  "; }else{} echo $form_fields['page_name']; ?>
                                        </h5>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div>
                               
                                <div class="row">
                                        <input type="hidden" name="table_name" value="<?php echo $table_name;?>">
                                        <input type="hidden" id="form_type" name="form_type" value="<?php echo $form_type;?>">
                                         <?php if($form_type == 'edit'){  ?>
                                              <input class="form-control" type="hidden" name="id" value="<?php echo $record[$id];?>">
                                          <?php } ?>
                                           
                                </div>
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                                <label>eod name </label>
                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="eod_name" name="eod_name" value="<?php echo (isset($record['eod_name']) && $record['eod_name'] !='' && $form_type != 'recreate' ? $record['eod_name'] :  date('d-m-Y')); ?>" placeholder="eod name" required>
                                                            </div>
                                                                                                            
                                                        
                                                            <div class="col-12 col-lg-2 col-md-3 mb-3">
                                                                <label>eod date </label>
                                                                <input type="date" <?php echo $disabled; ?> class="form-control" id="eod_date" name="eod_date" value="<?php echo (isset($record['eod_date']) && $record['eod_date'] !='' && $form_type != 'recreate' ? $record['eod_date'] :  date('Y-m-d')); ?>" placeholder="eod date" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/reports/list/<?php echo $table_name;?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                           
                                                            <?php if($form_type == 'edit'){?>
                                                                <input type="submit" class="btn btn-primary" value="Update">
                                                            
                                                           <?php }else if($form_type == 'add' || $form_type == 'recreate'){?>
                                                            <input type="submit" class="btn btn-primary" value="Save">
                                                            <?php }?>
                                                           
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-12">
                                                        <div class="">
                                                             <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                               
                                                                <thead class="bg-primary text-white">
                                                                    <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <label>Location/Till </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <label>Main Cafe </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <label>Cash Read </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>CC Read </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Total Sales</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Cash Collected </label>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                                 <label>AMEX </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>CR/DR Collected</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Efptos Collected </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>+/- Over </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>CC +/- Over </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Acc/Smart Cards </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>GST Read </label>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                            </td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                    <?php if(!empty($record['content'])){
                                                                        $i=1;
                                                                    foreach($record['content'] as $row ){ ?>
                                                                    
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <select  <?php echo $disabled; ?> class="form-control till_name selectdropdown selectdropdown_<?php echo $i; ?> <?php echo $disabled; ?>" name="till_name[]" data-rel="Location/Till" id="till_name">
                                                                                    <option value="">Select Location/Till</option>
                                                                                    
                                                                                        <?php foreach($location_till as $row1){ 
                                                                                            if( $row1->location_till_id == $row['location_till_id']){
                                                                                        ?>
                                                                                            <option value="<?php echo $row1->location_till_id; ?>" selected><?php echo $row1->till_name; ?></option>
                                                                                           <?php } else{ ?>
                                                                                            <option value="<?php echo $row1->location_till_id; ?>"><?php echo $row1->till_name; ?></option>
                                                                                        <?php } } ?>
                                                                                </select>
                                                                                
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-check form-check-success mb-3">
                                                                                    <input <?php echo $disabled; ?> class="form-check-input mainCafeCheckbox" <?php if($row['main_cafe'] == 1) echo "checked"; ?> value="<?php if($row['main_cafe'] == 1){ echo $row['location_till_id']; } ?>" name="main_cafe[]" type="checkbox" >
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cash_read_input totalSalesN1" id="cash_read" name="cash_read[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo round($row['cash_read'], 2); ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cc_read_input totalSalesN2" id="cc_read" name="cc_read[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo (isset($row['cc_read']) ? $row['cc_read'] : ''); ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales totalSales_read_input" id="totalSales" name="totalSales[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo (isset($row['totalSales']) ? $row['totalSales'] : ''); ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cash_collected_input" id="cash_collected" name="cash_collected[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo $row['cash_collected']; ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                     <div class="form-icon">
                                                                                        <input type="number" step="any"  <?php echo $disabled; ?> class="form-control amexCost form-control-icon" id="amex_cost" name="amex_cost[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo $row['amex_cost']; ?>"<?php } ?>  >
                                                                                        <i class="bx bx-dollar"></i>
                                                                                     </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                     <div class="form-icon">
                                                                                        <input type="number" step="any"  <?php echo $disabled; ?> class="form-control crdrCost form-control-icon" id="CRDR_Cost" name="CRDR_Cost[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo $row['CRDR_Cost']; ?>"<?php } ?>  >
                                                                                        <i class="bx bx-dollar"></i>
                                                                                     </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon efptos_collected_input" id="efptos_collected" name="efptos_collected[]" <?php if($form_type != 'recreate'){ ?> value="<?php echo round($row['efptos_collected'], 2); ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                 <?php if($row['over'] != ''){ $over = $row['over']; }else{ $over = $row['cash_collected'] - $row['cash_read']; } ?>
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon over_input" id="over" readonly name="over[]"  <?php if($form_type != 'recreate'){ ?>value="<?php echo round($over, 2); ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                 <?php if($row['cc_over'] != ''){ $cc_over = $row['cc_over']; }else{ $cc_over = $row['efptos_collected'] - $row['cc_read']; } ?>
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cc_over_input" id="cc_over" readonly name="cc_over[]"  <?php if($form_type != 'recreate'){ ?>value="<?php echo round($cc_over, 2); ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon smart_cards_input" id="smart_cards" name="smart_cards[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo $row['smart_cards']; ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon gst_read_input" id="gst_read" name="gst_read[]" <?php if($form_type != 'recreate'){ ?>value="<?php echo $row['gst_read']; ?>"<?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <?php if($form_type != 'view'){  ?>
                                                                                                                                        
                                                                            <td class="menubtns-width">
                                                                                <div class="ct-btns">
                                                                                         <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                        <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                </div>
                                                                            </td>
                                                                           <?php } ?>
                                                                        </tr>
                                                                    <?php $i++; } }else{?>
                                                                    <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <select  <?php echo $disabled; ?> class="form-control till_name selectdropdown selectdropdown_<?php echo $i; ?>" name="till_name[]" data-rel="Location/Till" id="till_name">
                                                                                    <option value="">Select Location/Till</option>
                                                                                   <?php foreach($location_till as $row1){ 
                                                                                            if( $row1->location_till_id == $row['location_till_id']){
                                                                                        ?>
                                                                                            <option value="<?php echo $row1->location_till_id; ?>" selected><?php echo $row1->till_name; ?></option>
                                                                                           <?php } else{ ?>
                                                                                            <option value="<?php echo $row1->location_till_id; ?>"><?php echo $row1->till_name; ?></option>
                                                                                        <?php } } ?>
                                                                                </select>
                                                                                
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-check form-check-success mb-3 text-center">
                                                                                    <input <?php echo $disabled; ?> class="form-check-input mainCafeCheckbox"  name="main_cafe[]" type="checkbox" style="float: unset;">
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cash_read_input totalSalesN1" id="cash_read" name="cash_read[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cc_read_input totalSalesN2" id="cc_read" name="cc_read[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                             <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales totalSales_read_input" id="totalSales" name="totalSales[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cash_collected_input" id="cash_collected" name="cash_collected[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                     <div class="form-icon">
                                                                                        <input type="number" step="any"  <?php echo $disabled; ?> class="form-control amexCost form-control-icon" id="amex_cost" name="amex_cost[]">
                                                                                        <i class="bx bx-dollar"></i>
                                                                                     </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                     <div class="form-icon">
                                                                                        <input type="number" step="any"  <?php echo $disabled; ?> class="form-control crdrCost form-control-icon" id="CRDR_Cost" name="CRDR_Cost[]" >
                                                                                        <i class="bx bx-dollar"></i>
                                                                                     </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon efptos_collected_input" id="efptos_collected" name="efptos_collected[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon over_input" id="over" readonly name="over[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon cc_over_input" id="cc_over" readonly name="cc_over[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon smart_cards_input" id="smart_cards" name="smart_cards[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon gst_read_input" id="gst_read" name="gst_read[]" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <?php if($form_type != 'view'){  ?>                                                        
                                                                            <td class="menubtns-width">
                                                                                <div class="ct-btns">
                                                                                         <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                        
                                                                                </div>
                                                                            </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tbody>
                                                                    <?php if($form_type != 'view'){  ?>
                                                                    <tr class="menurow">
                                                                            <td class="menuinput-width" colspan="12">
                                                                                <input type="button" class="btn btn-primary mt-3 mb-3" onclick="calculate_total()" value="Calculate">
                                                                            </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <tr class="menurow">
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Main Cafe Total </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN1" id="main_cafe_cash_read_total" name="main_cafe_cash_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_cash_read_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN2" id="main_cafe_cc_read_total" name="main_cafe_cc_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_cc_read_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                             <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales" id="main_cafe_totalSales_total" name="main_cafe_totalSales_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo (isset($record['content_total_cash']['main_cafe_totalSales_total']) ? $record['content_total_cash']['main_cafe_totalSales_total'] : ''); ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_cash_collected_total" name="main_cafe_cash_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_cash_collected_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                             <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_amex_total" name="main_cafe_amex_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_amex_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_crdr_total" name="main_cafe_crdr_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_crdr_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_efptos_collected_total" name="main_cafe_efptos_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_efptos_collected_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_over_total" name="main_cafe_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_over_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_cc_over_total" name="main_cafe_cc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_cc_over_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_smart_cards_total" name="main_cafe_smart_cards_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_smart_cards_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="main_cafe_gst_read_total" name="main_cafe_gst_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['main_cafe_gst_read_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            
                                                                    </tr>
                                                                    <tr class="menurow catering_hide">
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Catering on the same day </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN1" id="catering_cash_read_total" name="catering_cash_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cash_read_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN2" id="catering_cc_read_total" name="catering_cc_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cc_read_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                             <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales" id="catering_totalSales_total" name="catering_totalSales_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo (isset($record['content_total_cash']['catering_totalSales_total']) ? $record['content_total_cash']['catering_totalSales_total'] : ''); ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_cash_collected_total" name="catering_cash_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cash_collected_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_amex_total" name="catering_amex_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_amex_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_crdr_total" name="catering_crdr_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_crdr_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_efptos_collected_total" name="catering_efptos_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_efptos_collected_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_cash_over_total" name="catering_cash_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cash_over_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_cash_cc_over_total" name="catering_cash_cc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cash_cc_over_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_cash_smart_cards_total" name="catering_cash_smart_cards_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cash_smart_cards_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="catering_cash_gst_read_total" name="catering_cash_gst_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['catering_cash_gst_read_total']; ?>" <?php } ?>>
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                        
                                                                    <tr class="menurow">
                                                                        <td class="menuinput-width" colspan="2">
                                                                            <label>Cafeonline </label>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN1" id="cafeonline_cash_read_total" name="cafeonline_cash_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_cash_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN2" id="cafeonline_cc_read_total" name="cafeonline_cc_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_cc_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                         <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales" id="cafeonline_totalSales_total" name="cafeonline_totalSales_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo (isset($record['content_total_cash']['cafeonline_totalSales_total']) ? $record['content_total_cash']['cafeonline_totalSales_total'] : ''); ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_cash_collected_total" name="cafeonline_cash_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_cash_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                         <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_amex_total" name="cafeonline_amex_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_amex_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_crdr_total" name="cafeonline_crdr_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_crdr_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_efptos_collected_total" name="cafeonline_efptos_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_efptos_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                       <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_over_total" name="cafeonline_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_cc_over_total" name="cafeonline_cc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_cc_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_smart_cards_total" name="cafeonline_smart_cards_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_smart_cards_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="cafeonline_gst_read_total" name="cafeonline_gst_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['cafeonline_gst_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                       
                                                                        
                                                                    </tr>
                                                                    <tr class="menurow catering_hide">
                                                                            <td class="menuinput-width" colspan="2">
                                                                            <label>Hospital catering/1800 </label>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN1" id="Hc_cash_read_total" name="Hc_cash_read_total"  <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_cash_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN2" id="Hc_cc_read_total" name="Hc_cc_read_total"  <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_cc_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div> 
                                                                        </td>
                                                                         <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales" id="Hc_totalSales_total" name="Hc_totalSales_total"  <?php if($form_type != 'recreate'){ ?> value="<?php echo (isset($record['content_total_cash']['Hc_totalSales_total']) ? $record['content_total_cash']['Hc_totalSales_total'] : ''); ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div> 
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_cash_collected_total" name="Hc_cash_collected_total"  <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_cash_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_amex_total" name="Hc_amex_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_amex_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_crdr_total" name="Hc_crdr_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_crdr_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_efptos_collected_total" name="Hc_efptos_collected_total"  <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_efptos_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                       <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_over_total" name="Hc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_cc_over_total" name="Hc_cc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_cc_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_smart_cards_total" name="Hc_smart_cards_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_smart_cards_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Hc_gst_read_total" name="Hc_gst_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Hc_gst_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <tr class="menurow">
                                                                        <td class="menuinput-width" colspan="2">
                                                                            <label>Other Specify </label>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN1" id="Other_specify_cash_read_total" name="Other_specify_cash_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specify_cash_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN2" id="Other_specify_cc_read_total" name="Other_specify_cc_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specify_cc_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales" id="Other_specify_totalSales_total" name="Other_specify_totalSales_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo (isset($record['content_total_cash']['Other_specify_totalSales_total']) ? $record['content_total_cash']['Other_specify_totalSales_total'] : ''); ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specify_cash_collected_total" name="Other_specify_cash_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specify_cash_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specify_amex_total" name="Other_specify_amex_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specify_amex_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specify_crdr_total" name="Other_specify_crdr_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specify_crdr_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specify_efptos_collected_total" name="Other_specify_efptos_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specify_efptos_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specifyover_total" name="Other_specifyover_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specifyover_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specifycc_over_total" name="Other_specifycc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specifycc_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specifysmart_cards_total" name="Other_specifysmart_cards_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specifysmart_cards_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="Other_specifygst_read_total" name="Other_specifygst_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['Other_specifygst_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                        
                                                                    </tr>
                                                                    <tr class="menurow">
                                                                        <td class="menuinput-width" colspan="2">
                                                                            <label>Total </label>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN1" id="total_cash_read_total" name="total_cash_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_cash_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSalesN2" id="total_cc_read_total" name="total_cc_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_cc_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input readonly type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon totalSales" id="total_totalSales_total" name="total_totalSales_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo (isset($record['content_total_cash']['total_totalSales_total']) ? $record['content_total_cash']['total_totalSales_total']: ''); ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_cash_collected_total" name="total_cash_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_cash_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                         <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_amex_total" name="total_amex_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_amex_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_crdr_total" name="total_crdr_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_crdr_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_efptos_collected_total" name="total_efptos_collected_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_efptos_collected_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                       <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_over_total" name="total_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_cc_over_total" name="total_cc_over_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_cc_over_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_smart_cards_total" name="total_smart_cards_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_smart_cards_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td class="menuinput-width">
                                                                            <!--<label>Efptos Collected </label>-->
                                                                            <div class="form-icon">
                                                                            <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_gst_read_total" name="total_gst_read_total" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_total_cash']['total_gst_read_total']; ?>" <?php } ?>>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                         
                                                        <hr />
                                                        <div class="row">
                                                            <div class="col-lg-9 ">
                                                                <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                                   <thead>
                                                                       <tr><td width="33.33%"><div class="customTableCell bg-black">Invoices Paid Cash</div></td><td width="33.33%"><div class="customTableCell bg-black">Total Inc GST</div></td><td width="33.33%"><div class="customTableCell bg-black">Upload</div></td><td></td></tr>
                                                                   </thead>
                                                                   
                                                                    <tbody>
                                                                         <?php $totalPidBillCash = 0; if(!empty($record['content_invoice_paid_cash'])){$i=1;
                                                                            foreach($record['content_invoice_paid_cash'] as $row ){ 
                                                                            $totalPidBillCash = $totalPidBillCash + $row['total_inc_gst'];
                                                                            ?>
                                                                            <tr class="menurow">
                                                                                <td class="menuinput-width" colspan="3" >
                                                                                   <table style="max-width:100%;width:100%;">
                                                                                       
                                                                                        <tbody class="dataWrap">
                                                                                           <tr><th width="33.33%"><div class="customTableCell"><input type="text"  <?php echo $disabled; ?> class="form-control" id="invoice_paid_cash" name="invoice_paid_cash[]" <?php if($form_type != 'recreate'){ ?> value="<?php echo $row['invoice_paid_cash']; ?>" <?php } ?>  ></div></th>
                                                                                           <th width="33.33%"><div class="customTableCell"><div class="form-icon"><input type="number" step="any" <?php echo $disabled; ?> class="form-control category_cost form-control-icon" onkeyup="addCost(this)" id="total_inc_gst" name="total_inc_gst[]" <?php if($form_type != 'recreate'){ ?> value="<?php echo $row['total_inc_gst']; ?>" <?php } ?>  ><i class="bx bx-dollar"></i></div></div></th>
                                                                                            <?php if($form_type == 'view' ){ ?>
                                                                                            <?php if(isset($row['uploaded_file_name']) && $row['uploaded_file_name'] !='') {  ?>
                                                                                            <th width="33.33%"><div class="customTableCell"><a href="<?php echo base_url();?>uploaded_files_inv_paid/<?php echo $row['uploaded_file_name']; ?>" target="_blank">View file</a></div></th>
                                                                                            <?php }else { ?>
                                                                                            <th width="33.33%"></th>
                                                                                            <?php }  ?>
                                                                                            <?php }else { ?>
                                                                                      <th width="33.33%"><div class="customTableCell"><input type="file" class="form-control" id="invoice_doc" name="invoice_doc[]" multiple="multiple"></div></th>
            
                                                                                            <?php } ?>
                                                                                           </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    
                                                                                        
                                                                                </td>
                                                                                <?php if($form_type != 'view'){  ?>
                                                                                <td class="menubtns-width">
                                                                                    <div class="ct-btns">
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                        <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                    </div>
                                                                                </td>
                                                                                <?php } ?>
                                                                            </tr>
                                                                        <?php } }else{ ?>
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width" colspan="3">
                                                                               <table style="max-width:100%;width:100%;">
                                                                                   
                                                                                    <tbody class="dataWrap">
                                                                                       <tr><th width="33.33%"><div class="customTableCell"><input type="text" <?php echo $disabled; ?> class="form-control" id="invoice_paid_cash" name="invoice_paid_cash[]"></div></th>
                                                                                       <th width="33.33%"><div class="customTableCell"><div class="form-icon"><input type="number" step="any" <?php echo $disabled; ?> class="form-control category_cost form-control-icon" onkeyup="addCost(this)" id="total_inc_gst" name="total_inc_gst[]" value="0"><i class="bx bx-dollar"></i></div></div></th>
                                                                                       <th width="33.33%"><div class="customTableCell"><input type="file" class="form-control" id="invoice_doc" name="invoice_doc[]" multiple="multiple"></div></th>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                
                                                                                    
                                                                            </td>
                                                                            <td class="menubtns-width">
                                                                                <div class="ct-btns">
                                                                                    <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                        </tbody> 
                                                                        <tbody>
                                                                            <tr><td width="33.33%"><div class="customTableCell highlightedCell">Total Bills Paid Cash</div></td><td width="33.33%"><div class="form-icon"><input class="form-control form-control-icon highlightedCell" type="number" step="any" <?php echo $disabled; ?> name="total_cost" id="totalCashBill" readonly <?php if($form_type != 'recreate'){ ?> value="<?php echo $totalPidBillCash; ?>" <?php } ?>><i class="bx bx-dollar text-white"></i></div></td><td width="33.33%"></td><td></td></tr>
                                                                        </tbody>
                                                                        </table>
                                                                        <?php if($form_type != 'view'){  ?>
                                                                    <tr class="menurow">
                                                                        <td class="menuinput-width" colspan="12">
                                                                            <input type="button" class="btn btn-primary mt-3 mb-3" onclick="calculate_total_cost()" value="Calculate Total">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                            </div>
                                                            
                                                                </div>
                                                        
                                                        <hr />
                                                        <div class="">
                                                             
                                                             <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                   
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <label>Staff Name </label>
                                                                                
                                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="staff_name" name="staff_name" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['staff_name']; ?>" <?php } ?>>
                                                                                
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <label>Reciept </label>
                                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="reciept" name="reciept" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['reciept']; ?>" <?php } ?>>
                                                                                
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Amount deposited </label>
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any"  <?php echo $disabled; ?> class="form-control form-control-icon" id="amount_deposited" name="amount_deposited" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['amount_deposited']; ?>" <?php } ?> placeholder="0" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <label>Bank Branch </label>
                                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="bank_branch" name="bank_branch" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['bank_branch']; ?>" <?php } ?>>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Time </label>
                                                                                    <input type="time" <?php echo $disabled; ?> class="form-control" id="time" name="time" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['time']; ?>" <?php } ?>>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Last Month Safe total</label>
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control" id="last_month_safe_total" name="last_month_safe_total" placeholder="0" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['last_month_safe_total']; ?>" <?php } ?> >
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Total Income </label>
                                                                                 <div class="form-icon">
                                                                                 
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_income" readonly name="total_income" placeholder="0" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['total_income']; ?>" <?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Total in Safe </label>
                                                                                 <div class="form-icon">
                                                                                    <input type="number" step="any" <?php echo $disabled; ?> class="form-control form-control-icon" id="total_in_Safe" name="total_in_Safe" placeholder="0" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['total_in_Safe']; ?>" <?php } ?> >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                        </tr>
                                                                
                                                                </tbody>
                                                                
                                                            </table>
                                                            
                                                        </div>
                                                        <hr />
                                                        <div class="row">
                        <div class="col-md-6">
                         <div class="form-icon">
                           <input type="text"  class="form-control form-control-icon" id="comment" name="comment" placeholder="Comments" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['comment']; ?>" <?php } ?> >
                              
                        </div>                     				
                           </div>
                           
                           <div class="col-md-6">
                         <div class="form-icon">
                           <input type="text" class="form-control form-control-icon" id="manager_comment" name="manager_comment" placeholder="manager comments" <?php if($form_type != 'recreate'){ ?> value="<?php echo $record['content_banking']['manager_comment']; ?>" <?php } ?> >
                            
                        </div>                     				
                           </div>
                       </div>
                         <hr />
                         <div class="row">
                            <div class="col-md-6">
                                <?php if(!empty($eod_documents)){  ?>
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th colspan="2">Uploaded Docs</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($eod_documents as $doc){
                                    ?>
                                        <tr>
                                            <td><label><?php echo $doc->uploaded_document_name; ?></label></td>
                                            <td width="150px" class="text-end">
                                                <?php if($form_type == 'view'){  ?>
                                                <?php if(isset($doc->uploaded_file_name) && $doc->uploaded_file_name !='') {  ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo base_url();?>uploaded_files/<?php echo $doc->uploaded_file_name; ?>" target="_blank">View file</a>            
                                                <?php }  ?>
                                                    
                                                <?php } else if($form_type == 'edit'){ ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteFile(this)" data-rel-id="<?php echo $doc->eod_documents_id; ?>">Delete</button>
                                                <?php }else{} ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                                <?php if($form_type != 'view'){  ?>
                                <div class="ct-btns">
                                <a href="<?php echo base_url() ?>index.php/reports/add_document" target="_blank" class="btn" style="background-color:#16b708;color:#fff;">Upload documents</a>
                                </div>
                                <?php } ?>
                                    
                             </div>
                        </div>
                                                    
                                                </div>
                                                   
                                            </div>
                                   
                                    </div>
                                </div>
                                <!--form end-->
                               
                            </div>
                        </div>
                    </form>         
                    
                    </div>    
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
    </div>
     </div>
  
</div>
<script>
    $(document).ready(function(){
        $('.non-selected-wrapper').find('.header').html('Suppliers');
        $('.selected-wrapper').find('.header').html('Selected Suppliers');
        
        
      $('#addEODReports').on('submit', function() {
      // Trigger the click event of both calculate buttons before submitting the form
      calculate_total();
      calculate_total_cost();
      
      // Additional form submission logic can go here
    });  
        
        
        
        
        
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


$(document).on("click", ".add_field_button" , function() {
        
         var thisRow = $( this ).closest( 'tbody' )[0];
        $(this).closest('.menurow').clone().appendTo(thisRow).find( 'input:text,textarea' ).val( '' );
        var labelselect = $(this).closest('.menurow').next('.menurow').find( 'select' ).attr('data-rel');
        $(this).closest('.menurow').next('.menurow').find( '.selectdropdown .current' ).html("Select "+labelselect);
        $(this).closest('.menurow').next('.menurow').find( 'input[type=number]' ).val('');
        $(this).closest('.menurow').next('.menurow').find( 'select' ).val('');
        $(this).closest('.menurow').next('.menurow').find('.selectdropdown').css('display','block');
        $(this).closest('.menurow').next('.menurow').find('.input_selectdropdown').css('display','none');
        $(this).closest('.menurow').next('.menurow').find('.fieldChangeselect').css('display','none');
        $(this).closest('.menurow').next('.menurow').find('.fieldChangeinput').css('display','block');
        var thisRowAddbtn = $(this).closest('.menurow').next('.menurow').find( '.add_field_button' );
        
        if (!$(thisRow).has(".remove_field_button").length) {
            // console.log('no btn');
            $('<a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
        } 
            var datacount = $(this).closest('.menurow').find( '#main_category' ).attr('data-count');
         if(datacount != ''){
             var tempRow = $(this).closest('.menurow').nextAll('.menurow');
             datacountnext = parseInt(datacount) + 1;
           tempRow.each(function() {
            $(this).find( '#main_category' ).attr('data-count',datacountnext);
            datacountnext = parseInt(datacountnext) + 1;
            });
         }
    });
    
    $(document).on("click", ".remove_field_button" , function() {
    
    $(this).parent().parents('.menurow').remove();
});



    // $('input').keyup(function(){
function addCost(obj){
     console.log("ck1340=",obj);
    
        var sum=0;
        var totalCashBill=0;
        console.log("ck1344=");
    $('.category_cost').each(function() {
            console.log("clicked==",$(this).val());
            if($(this).val() == ''){
                totalCashBill= sum+0;
            }else{
                totalCashBill= totalCashBill+parseFloat($(this).val()) || 0;
            }
        });
        $('#totalCashBill').val(totalCashBill.toFixed(2));
  
   
        
}

function fieldChangeinput(obj){
    
    $(obj).closest('.menurow').find('.selectdropdown').css('display','none');
    $(obj).closest('.menurow').find('.input_selectdropdown').css('display','block');
    $(obj).closest('.menurow').find('.fieldChangeinput').css('display','none');
    $(obj).closest('.menurow').find('.fieldChangeselect').css('display','block');
   $(obj).closest('.menurow').find('.input_selectdropdown').val('');
}
function fieldChangeselect(obj){
    
    $(obj).closest('.menurow').find('.selectdropdown').css('display','block');
    $(obj).closest('.menurow').find('.input_selectdropdown').css('display','none');
    $(obj).closest('.menurow').find('.input_selectdropdown').val('');
   $(obj).closest('.menurow').find('.fieldChangeselect').css('display','none');
    $(obj).closest('.menurow').find('.fieldChangeinput').css('display','block');
}

function calculate_total_cost(){
    var totalMainCafeCashRead = 0;
    var totalMainCafeCCRead = 0;
    var totalMainCafeTotalSales = 0;
    var totalMainCafecashCollected = 0;
    var totalMainCafeAmexCost = 0;
    var totalMainCafeCRDRCost = 0;
    var totalMainCafeefptos = 0;
    var totalMainCafeOver = 0;
    var totalMainCafeCCOver = 0;
    var totalMainCafesmartCards = 0;
    var totalMainCafegstRead = 0;
    
    
    let notMaincafe_totalMainCafeCashRead = 0;
    let notMaincafe_totalMainCafeCCRead = 0;
    let notMaincafe_totalMainCafeTotalSales = 0;
    let notMaincafe_totalMainCafecashCollected = 0;
    let notMaincafe_totalMainCafeAmexCost = 0;
    let notMaincafe_totalMainCafeCRDRCost = 0;
    let notMaincafe_totalMainCafeefptos = 0;
    let notMaincafe_totalMainCafeOver = 0;
    let notMaincafe_totalMainCafeCCOver = 0;
    let notMaincafe_totalMainCafesmartCards = 0;
    let notMaincafe_totalMainCafegstRead = 0;
    
   
    
    $('.mainCafeCheckbox').each(function() {
            if($(this).is(":checked")){
                let cashReadValue = $(this).closest('.menurow').find('.cash_read_input').val();
                (cashReadValue != '' ? '' : cashReadValue=0);
                totalMainCafeCashRead = totalMainCafeCashRead+parseFloat(cashReadValue);
 
                let CCReadValue = $(this).closest('.menurow').find('.cc_read_input').val();
                (CCReadValue != '' ? '' : CCReadValue=0);
                totalMainCafeCCRead = totalMainCafeCCRead+parseFloat(CCReadValue);
                
               
                totalMainCafeTotalSales = parseFloat(totalMainCafeCashRead)+parseFloat(totalMainCafeCCRead);
                
                let cashCollectedValue = $(this).closest('.menurow').find('.cash_collected_input').val();
                (cashCollectedValue != '' ? '' : cashCollectedValue=0);
                totalMainCafecashCollected = totalMainCafecashCollected+parseFloat(cashCollectedValue);
                
                let amexCostValue = $(this).closest('.menurow').find('.amexCost').val();
                (amexCostValue != '' ? '' : amexCostValue=0);
                totalMainCafeAmexCost = totalMainCafeAmexCost+parseFloat(amexCostValue);
                
                let CRDRCostValue = $(this).closest('.menurow').find('.crdrCost').val();
                (CRDRCostValue != '' ? '' : CRDRCostValue=0);
                totalMainCafeCRDRCost = totalMainCafeCRDRCost+parseFloat(CRDRCostValue);
               
                
                let efptosValue = $(this).closest('.menurow').find('.efptos_collected_input').val();
                (efptosValue != '' ? '' : efptosValue=0);
                totalMainCafeefptos = totalMainCafeefptos+parseFloat(efptosValue);
                
                let overValue = $(this).closest('.menurow').find('.over_input').val();
                (overValue != '' ? '' : overValue=0);
                totalMainCafeOver = totalMainCafeOver+parseFloat(overValue);
                
                let CCOverValue = $(this).closest('.menurow').find('.cc_over_input').val();
                (CCOverValue != '' ? '' : CCOverValue=0);
                totalMainCafeCCOver = totalMainCafeCCOver+parseFloat(CCOverValue);
                
                let smartCardsValue = $(this).closest('.menurow').find('.smart_cards_input').val();
                (smartCardsValue != '' ? '' : smartCardsValue=0);
                totalMainCafesmartCards = totalMainCafesmartCards+parseFloat(smartCardsValue);
                
                let gstReadValue = $(this).closest('.menurow').find('.gst_read_input').val();
                (gstReadValue != '' ? '' : gstReadValue=0);
                totalMainCafegstRead = totalMainCafegstRead+parseFloat(gstReadValue);
            }
            else{
                
                let cashReadValue = $(this).closest('.menurow').find('.cash_read_input').val();
                (cashReadValue != '' ? '' : cashReadValue=0);
                notMaincafe_totalMainCafeCashRead = notMaincafe_totalMainCafeCashRead+parseFloat(cashReadValue);
                
                let CCReadValue = $(this).closest('.menurow').find('.cc_read_input').val();
                (CCReadValue != '' ? '' : CCReadValue=0);
                notMaincafe_totalMainCafeCCRead = notMaincafe_totalMainCafeCCRead+parseFloat(CCReadValue);
                
                
                notMaincafe_totalMainCafeTotalSales = parseFloat(notMaincafe_totalMainCafeCashRead)+parseFloat(notMaincafe_totalMainCafeCCRead);
                
                let cashCollectedValue = $(this).closest('.menurow').find('.cash_collected_input').val();
                (cashCollectedValue != '' ? '' : cashCollectedValue=0);
                notMaincafe_totalMainCafecashCollected = notMaincafe_totalMainCafecashCollected+parseFloat(cashCollectedValue);
                
                let amexCostValue = $(this).closest('.menurow').find('.amexCost').val();
                (amexCostValue != '' ? '' : amexCostValue=0);
                notMaincafe_totalMainCafeAmexCost = notMaincafe_totalMainCafeAmexCost+parseFloat(amexCostValue);
                
                let CRDRCostValue = $(this).closest('.menurow').find('.crdrCost').val();
                (CRDRCostValue != '' ? '' : CRDRCostValue=0);
                notMaincafe_totalMainCafeCRDRCost = notMaincafe_totalMainCafeCRDRCost+parseFloat(CRDRCostValue);
               
                
                let efptosValue = $(this).closest('.menurow').find('.efptos_collected_input').val();
                (efptosValue != '' ? '' : efptosValue=0);
                notMaincafe_totalMainCafeefptos = notMaincafe_totalMainCafeefptos+parseFloat(efptosValue);
                
                let overValue = $(this).closest('.menurow').find('.over_input').val();
                (overValue != '' ? '' : overValue=0);
                notMaincafe_totalMainCafeOver = notMaincafe_totalMainCafeOver+parseFloat(overValue);
                
                let CCOverValue = $(this).closest('.menurow').find('.cc_over_input').val();
                (CCOverValue != '' ? '' : CCOverValue=0);
                notMaincafe_totalMainCafeCCOver = notMaincafe_totalMainCafeCCOver+parseFloat(CCOverValue);
                
                let smartCardsValue = $(this).closest('.menurow').find('.smart_cards_input').val();
                (smartCardsValue != '' ? '' : smartCardsValue=0);
                notMaincafe_totalMainCafesmartCards = notMaincafe_totalMainCafesmartCards+parseFloat(smartCardsValue);
                
                let gstReadValue = $(this).closest('.menurow').find('.gst_read_input').val();
                (gstReadValue != '' ? '' : gstReadValue=0);
                notMaincafe_totalMainCafegstRead = notMaincafe_totalMainCafegstRead+parseFloat(gstReadValue);
            }
        });
       
        $('#main_cafe_cash_read_total').val(totalMainCafeCashRead.toFixed(2));
        $('#main_cafe_cc_read_total').val(totalMainCafeCCRead.toFixed(2));
        $('#main_cafe_totalSales_total').val(totalMainCafeTotalSales.toFixed(2));
        $('#main_cafe_cash_collected_total').val(totalMainCafecashCollected.toFixed(2));
        $('#main_cafe_crdr_total').val(totalMainCafeCRDRCost.toFixed(2));
        $('#main_cafe_amex_total').val(totalMainCafeAmexCost.toFixed(2));
        $('#main_cafe_efptos_collected_total').val(totalMainCafeefptos.toFixed(2));
        $('#main_cafe_over_total').val(totalMainCafeOver.toFixed(2));
        $('#main_cafe_cc_over_total').val(totalMainCafeCCOver.toFixed(2));
        $('#main_cafe_smart_cards_total').val(totalMainCafesmartCards.toFixed(2));
        $('#main_cafe_gst_read_total').val(totalMainCafegstRead.toFixed(2));
        
        var totalMainCafeCashRead1 = 0;
        var totalMainCafeCCRead1 = 0;
        var totalMainCafeTotalSales1 = 0;
        var totalMainCafecashCollected1 = 0;
        var totalMainCafeefptos1 = 0;
        var totalMainCafeOver1 = 0;
        var totalMainCafeCCOver1 = 0;
        var totalMainCafesmartCards1 = 0;
        var totalMainCafegstRead1 = 0;
        var totalIncome = 0;
        // calculate total income
        $('.till_name').each(function() {
            if($(this).val()){
                var cashReadValue = $(this).closest('.menurow').find('.cash_read_input').val();
                (cashReadValue != '' ? '' : cashReadValue=0);
                totalMainCafeCashRead1 = totalMainCafeCashRead1+parseFloat(cashReadValue);
                
                var CCReadValue = $(this).closest('.menurow').find('.cc_read_input').val();
                (CCReadValue != '' ? '' : CCReadValue=0);
                totalMainCafeCCRead1 = totalMainCafeCCRead1+parseFloat(CCReadValue);
                
                
                 
                totalMainCafeTotalSales1 = parseFloat(totalMainCafeCashRead1)+parseFloat(totalMainCafeCCRead1);
                
                
                var overValue = $(this).closest('.menurow').find('.over_input').val();
                (overValue != '' ? '' : overValue=0);
                totalMainCafeOver1 = totalMainCafeOver1+parseFloat(overValue);
                
                var CCOverValue = $(this).closest('.menurow').find('.cc_over_input').val();
                (CCOverValue != '' ? '' : CCOverValue=0);
                totalMainCafeCCOver1 = totalMainCafeCCOver1+parseFloat(CCOverValue);
                
                var smartCardsValue = $(this).closest('.menurow').find('.smart_cards_input').val();
                (smartCardsValue != '' ? '' : smartCardsValue=0);
                totalMainCafesmartCards1 = totalMainCafesmartCards1+parseFloat(smartCardsValue);
                
                var gstReadValue = $(this).closest('.menurow').find('.gst_read_input').val();
                (gstReadValue != '' ? '' : gstReadValue=0);
                totalMainCafegstRead1 = totalMainCafegstRead1+parseFloat(gstReadValue);
            }
        });
        
        totalIncome = (parseFloat(totalMainCafeCashRead1)+parseFloat(totalMainCafeCCRead1)+parseFloat(totalMainCafeTotalSales1)+parseFloat(totalMainCafeOver1)+parseFloat(totalMainCafeCCOver1)+parseFloat(totalMainCafesmartCards1))-parseFloat(totalMainCafegstRead1);
        
        
             const arrayOfCashReadTotalNames = [
             'main_cafe_cash_read_total',
             'catering_cash_read_total',
             'cafeonline_cash_read_total',
             'Hc_cash_read_total',
             'Other_specify_cash_read_total'
            ];
             const arrayOfCChReadTotalNames = [
             'main_cafe_cc_read_total',
             'catering_cc_read_total',
             'cafeonline_cc_read_total',
             'Hc_cash_cc_total',
             'Other_specify_cc_read_total'
            ];
            
            
             const arrayOfCashCollectedTotalNames = [
             'main_cafe_cash_collected_total',
             'catering_cash_collected_total',
             'cafeonline_cash_collected_total',
             'Hc_cash_collected_total',
             'Other_specify_cash_collected_total'
            ];
             const arrayOfefptosCollectedTotalNames = [
             'main_cafe_efptos_collected_total',
             'catering_efptos_collected_total',
             'cafeonline_efptos_collected_total',
             'Hc_efptos_collected_total',
             'Other_specify_efptos_collected_total'
            ];
             const arrayOfoverTotalNames = [
             'main_cafe_over_total',
             'catering_cash_over_total',
             'cafeonline_over_total',
             'Hc_over_total',
             'Other_specifyover_total'
            ];
             const arrayOfcc_overTotalNames = [
             'main_cafe_cc_over_total',
             'catering_cc_over_total',
             'cafeonline_cc_over_total',
             'Hc_cc_over_total',
             'Other_specifycc_over_total'
            ];
             const arrayOfsmart_cardsTotalNames = [
             'main_cafe_smart_cards_total',
             'catering_smart_cards_total',
             'cafeonline_smart_cards_total',
             'Hc_smart_cards_total',
             'Other_specifysmart_cards_total'
            ];
             const arrayOfgst_readTotalNames = [
             'main_cafe_gst_read_total',
             'catering_gst_read_total',
             'cafeonline_gst_read_total',
             'Hc_gst_read_total',
             'Other_specifygst_read_total'
            ];
             const arrayOfAmexTotalNames = [
             'main_cafe_amex_total',
             'catering_amex_total',
             'cafeonline_amex_total',
             'Hc_amex_total',
             'Other_specify_amex_total'
            ];
             const arrayOfCrdrTotalNames = [
             'main_cafe_crdr_total',
             'catering_crdr_total',
             'cafeonline_crdr_total',
             'Hc_crdr_total',
             'Other_specify_crdr_total'
            ];
            
            let arrayOfAllColumnTotals = [
                arrayOfCashReadTotalNames,
                arrayOfCChReadTotalNames,
                arrayOfCashCollectedTotalNames,
                arrayOfAmexTotalNames,
                 arrayOfCrdrTotalNames,
                arrayOfefptosCollectedTotalNames,
                arrayOfoverTotalNames,
                arrayOfcc_overTotalNames,
                arrayOfsmart_cardsTotalNames,
                arrayOfgst_readTotalNames
                
               
                
                ]
                let totalFieldIndex = ['total_cash_read_total_lastRowTotal','total_cc_read_total_lastRowTotal','total_CashCollected_total_lastRowTotal',
                'total_Amex_total_lastRowTotal','total_Crdr_total_lastRowTotal','total_efptos_total_lastRowTotal','total_over_total_lastRowTotal','total_cc_over_total_lastRowTotal','total_smart_cards_total_lastRowTotal',
                'total_gst_read_total_lastRowTotal']
                

       
        let totalOfUncheckedmainCafe = [notMaincafe_totalMainCafeCashRead,notMaincafe_totalMainCafeCCRead,notMaincafe_totalMainCafecashCollected,notMaincafe_totalMainCafeAmexCost,
       notMaincafe_totalMainCafeCRDRCost,notMaincafe_totalMainCafeefptos,notMaincafe_totalMainCafeOver,notMaincafe_totalMainCafeCCOver,notMaincafe_totalMainCafesmartCards,notMaincafe_totalMainCafegstRead];
                
        arrayOfAllColumnTotals.forEach((Innervalue,index)=>{
              totalFieldIndex[index] = totalOfUncheckedmainCafe[index]
             Innervalue.forEach((value)=>{
               let inputVal = (isNaN($("#"+value).val()) || $("#"+value).val() == ''  ? 0 : $("#"+value).val())
               totalFieldIndex[index] = parseFloat(totalFieldIndex[index]) + parseFloat(inputVal);
           });
           });
           
           let total_cash_collected_totalAmount = parseFloat(totalFieldIndex[2]) - parseFloat($("#totalCashBill").val());
           $("#total_cash_read_total").val(totalFieldIndex[0].toFixed(2))
           $("#total_cc_read_total").val(totalFieldIndex[1].toFixed(2))
           let totalFieldIndextotalSales = parseFloat(totalFieldIndex[0]) + parseFloat(totalFieldIndex[1])
           $("#total_totalSales_total").val(totalFieldIndextotalSales.toFixed(2))
           $("#total_cash_collected_total").val(total_cash_collected_totalAmount.toFixed(2))
           $("#total_amex_total").val(totalFieldIndex[3].toFixed(2))
           $("#total_crdr_total").val(totalFieldIndex[4].toFixed(2))
           $("#total_efptos_collected_total").val(totalFieldIndex[5].toFixed(2))
           $("#total_over_total").val(totalFieldIndex[6].toFixed(2))
           $("#total_cc_over_total").val(totalFieldIndex[7].toFixed(2))
           $("#total_smart_cards_total").val(totalFieldIndex[8].toFixed(2))
           $("#total_gst_read_total").val(totalFieldIndex[9].toFixed(2))
           
           
          let cafeonline_totalSales_total = parseFloat($("#cafeonline_cash_read_total").val()) + parseFloat($("#cafeonline_cc_read_total").val());  
          let Other_specify_cash_read_total = parseFloat($("#Other_specify_cash_read_total").val()) + parseFloat($("#Other_specify_cc_read_total").val());
         $("#cafeonline_totalSales_total").val(cafeonline_totalSales_total.toFixed(2))
         $("#Other_specify_totalSales_total").val(Other_specify_cash_read_total.toFixed(2))
        $('#total_income').val(totalIncome.toFixed(2));
    
}
function calculate_total(){

    $('.till_name').each(function() {
        let totalover = 0;
        let totalCCover = 0;
        let totalEfptos = 0;
        if($(this).val() != ''){
            
            // Efptos calculate
            let amexCostValue = $(this).closest('.menurow').find('.amexCost').val();
            let crdrCostValue = $(this).closest('.menurow').find('.crdrCost').val();
            
            let totalSalesN2 = $(this).closest('.menurow').find('.totalSalesN2').val();
            let totalSalesN1 = $(this).closest('.menurow').find('.totalSalesN1').val();
             totalSales = parseFloat(totalSalesN1)+parseFloat(totalSalesN2);
            $(this).closest('.menurow').find('.totalSales').val(totalSales.toFixed(2));
            
            
            (amexCostValue != '' ? '' : amexCostValue=0);
            (crdrCostValue != '' ? '' : crdrCostValue=0);
            totalEfptos = parseFloat(amexCostValue)+parseFloat(crdrCostValue);
            $(this).closest('.menurow').find('.efptos_collected_input').val(totalEfptos.toFixed(2));
            
            
            // +/- over calculate
            var cashCollectedValue = $(this).closest('.menurow').find('.cash_collected_input').val();
            var cashReadValue = $(this).closest('.menurow').find('.cash_read_input').val();
            
            (cashCollectedValue != '' ? '' : cashCollectedValue=0);
            (cashReadValue != '' ? '' : cashReadValue=0);
            totalover = parseFloat(cashCollectedValue)-parseFloat(cashReadValue);
            $(this).closest('.menurow').find('.over_input').val(totalover.toFixed(2));
            
            // +/- cc over calculate
            var cashEfptosValue = $(this).closest('.menurow').find('.efptos_collected_input').val();
            var cashCcReadValue = $(this).closest('.menurow').find('.cc_read_input').val();
            
            (cashEfptosValue != '' ? '' : cashEfptosValue=0);
            (cashCcReadValue != '' ? '' : cashCcReadValue=0);
            totalCCover = parseFloat(cashEfptosValue)-parseFloat(cashCcReadValue);
            $(this).closest('.menurow').find('.cc_over_input').val(totalCCover.toFixed(2));
            
            
            
        }
    });
        
}
$(document).ready(function () {
    let allTills = <?php echo json_encode($location_till); ?>;
   
    $(document).on("change", "select.till_name" , function() {
    let locationId = $(this).val();
    var thisRow = $(this).parent().closest('.menurow').find('.mainCafeCheckbox');
    const res = allTills.filter((value)=>{
       return value.location_till_id ==  locationId;
     });
     if(res[0]?.main_cafe === '1'){
         $(thisRow).prop('checked',true);
         $(thisRow).attr('value',locationId);
     }else{
         $(thisRow).prop('checked',false);
         $(thisRow).attr('value','');
     }
     
     
});
});
Dropzone.options.invoice = {
	  maxFiles: 1,
	  paramName: "file",
	  accept: function(file, done) {
	    console.log("uploaded");
	    done();
	  },
	  init: function() {
	    this.on("maxfilesexceeded", function(file){
	        alert("No more files please!");
	    });
	  },
	  renameFile: function (file) {
	  	var ext = file.name.split('.').pop();
	        return file.name ="invoice-<?php echo trim($orders->order_number);?>." + ext;
	   },
	   dictDefaultMessage:"Drop invoice here",
	   acceptedFiles :"image/jpg,image/jpeg,image/png,application/pdf"
	};
// $(document).ready(function(){
// 	    var activeTab = localStorage.getItem('activeTab');
// 	    		$(".nav-tabs").find(".active").removeClass('active');
// 	    			$(".tab-content").find(".active").removeClass('active');
	    			
// 		$(".nav-tabs").find("."+activeTab).addClass('active');
// 		$(".tab-content").find("."+activeTab).addClass('active in');
		
		
// 	});  

function deleteFile(obj){
    var id = $(obj).attr('data-rel-id');
    Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: !0,
          confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
          cancelButtonClass: "btn btn-danger w-xs mt-2",
          confirmButtonText: "Yes, delete it!",
          buttonsStyling: !1,
          showCloseButton: !0,
      }).then(function (e) {
          if (e.value) {
              
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/reports/record_delete",
                data: 'id='+id+'&table_name=eod_documents',
               
                success: function(data){
                  if(data == 'deleted'){
                      Swal.fire({ 
                          title: "Deleted!", 
                          text: "Your record has been deleted.", 
                          icon: "success", 
                          confirmButtonClass: "btn btn-info w-xs mt-2", 
                          buttonsStyling: !1 
                      }).then(function (e) {
                            if (e.value) {
                                $(obj).closest('tr').remove();
                            }
                        });
                  }
                  
                }
            });
            
        
              
          }
      });
}
</script> 

