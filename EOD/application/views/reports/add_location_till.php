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
.form-control::placeholder{
    font-size: 12px;
}
.form-icon .form-control-icon {
    padding-left: 1.7rem !important;
}
.form-icon i {
    font-size: 16px;
    top: 1px;
    bottom: 0;
    left: 13px;
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
@media(max-width: 1400px){
    label {
        font-weight: 600;
        text-transform: capitalize;
        font-size: 11px;
    }
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
                    
                    <form action="<?php echo base_url() ?>index.php/reports/submit_<?php echo $table_name;?>" method="post" class="form-horizontal" >    
                    
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
                                        <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/reports/list/<?php echo $table_name;?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                       
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
                                              <input class="form-control" type="hidden" name="id" value="<?php echo $record[$id];?>">
                                          <?php } ?>
                                           
                                </div>
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                        	<div class="create_menu_wrap">
        									    <div class="row">
        									        <div class="col-lg-12">
        									            <div class="row">
        								                    <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Location name </label>
                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="till_name" name="till_name" value="<?php echo $record['till_name']; ?>" placeholder="Location Name" required="">
                                                            </div>
                                                                                                            
                                                        
                                                            <div class="col-12 col-lg-1 col-md-1 mb-3">
                                                                <label>Main Cafe </label>
                                                                <div class="form-check form-check-success mb-3">
                                                                    <input <?php echo $disabled; ?> class="form-check-input mainCafeCheckbox" value="1" name="main_cafe" type="checkbox" <?php if($record['main_cafe'] == 1) echo "checked"; ?>>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Account number  </label>
                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="account_number" name="account_number" value="<?php echo $record['account_number']; ?>" placeholder="Account Number">
                                                            </div>
                                                            <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Amex account number  </label>
                                                                <input type="text" <?php echo $disabled; ?> class="form-control" id="amex_account_number" name="amex_account_number" value="<?php echo $record['amex_account_number']; ?>" placeholder="Amex account number">
                                                            </div>
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


