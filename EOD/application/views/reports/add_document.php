<?php if(isset($form_type) && $form_type == 'view'){ $disabled='disabled'; } else{ $disabled = ''; }
    $id=$table_name.'_id'; 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.cafeadmin.com.au/assets/css/dropzone.css">
<script type="text/javascript" src="https://www.cafeadmin.com.au/assets/js/dropzone.js"></script>
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
    padding-left: 1.4rem !important;
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
                    
                    <form enctype='multipart/form-data' action="<?php echo base_url() ?>index.php/reports/upload_doc" method="post" class="form-horizontal" >    
                    
                        <div class="card-header border-bottom-dashed">
    
                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0 txt-uppercase">Add Document</h5>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div>
                               
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                  
                                                <div class="row">    
                                                    <div class="col-lg-12">
                                                       
                                                        <div class="row">
                                                            <div class="col-lg-8 ">
                                                                <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr><td width="40%"><div class="customTableCell bg-black">Document Name</div></td><td width="60%"><div class="customTableCell bg-black">Upload File </div></td><td></td></tr>
                                                                    </thead>
                                                                   
                                                                    <tbody class="dataWrap">
                                                                        <tr class="menurow">
                                                                            <th><div class="customTableCell"><input type="text" <?php echo $disabled; ?> class="form-control" id="document_name" name="document_name[]"></div></th>
                                                                            <th><div class="customTableCell"><input type="file" class="form-control" id="document_file" name="document_file[]" multiple="multiple"></div></th>
                                                                            <td class="menubtns-width">
                                                                                <div class="ct-btns">
                                                                                    <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody> 
                                                                        
                                                                </table>
                                                                        
                                                                    
                                                                   
                                                            </div>
                                                            
                                                            <div class="col-lg-12 mt-4">
                                                                <input type="submit" class="btn btn-primary" value="Upload">
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

</script> 

