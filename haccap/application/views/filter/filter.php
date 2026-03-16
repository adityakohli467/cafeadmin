
  <style>
      .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}
      .form-control.disabled {
                cursor: text;
            }
            select.form-control.disabled {
                appearance: none;
            }
            .field-row{
        display:flex;
    }
    .field-row label {
        word-break: break-all;
        white-space: nowrap;
        padding: 8px 0px;
        margin-right: 13px;
        font-weight: 600;
        margin-bottom: 0 !important;
    }
    .field-row .form-control {
        padding: 5px 0px;
        height: 30px;
        font-size: 13px;
    }
     input[type=checkbox], input[type=radio] {
        margin: 9px 10px 9px 0;
    }
    .field-row textarea.form-control,
    .field-row textarea.form-control:focus{
        height: auto;
        box-shadow: none;
        border-radius: 0;
        border: 1px solid #d3d1d1 !important;
        padding:5px;
    }
    
    input.disabled {
    pointer-events: none;
}
.parent_table td {
    padding: 5px !important;
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
                    
                        <form action="<?php echo base_url() ?>index.php/<?php echo $controller_name; ?>" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php echo $page_heading; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    
                                    <input type="submit" class="btn btn-primary" value="Generate">
                                
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
                                    
                          
                  <div class="row">
                    <div class="form-group col-lg-6 mb-2">
							<label class="col-sm-3 control-label text-right">Date From</label>
							
								<input type="date" class="form-control" name="date_from" required>
							
						</div>
						<div class="form-group col-lg-6 mb-2">
							<label class="col-sm-3 control-label text-right">Date To</label>
							
								<input type="date" class="form-control" name="date_to" required>
						</div>
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
 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();
    
 var table = $( '.parent_table' );
       $( table ).delegate( '.add_field_button', 'click', function () {
    var thisRow = $( this ).closest( 'tr' )[0];
    
    $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text' ).val( '' );
    var thisRowAddbtn = $( thisRow ).next('tr').find( '.add_field_button' );
    if (!$(thisRow).has(".remove_field_button").length) {
   $('<a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
    } 
    });
    
  

</script> 

<script>

    $(document).on("click", ".remove_field_button" , function() {
    
    $(this).parent().parents('.menurow').remove();
});
</script>