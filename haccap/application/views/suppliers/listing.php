<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<style>
    .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}
.dataTables_wrapper ul.pagination {
    justify-content: end;
}
.active>.page-link, .page-link.active {
    background-color: rgb(47,156,219);
    border-color: rgb(47,156,219);
}
table.dataTable > thead .sorting:before, table.dataTable > thead .sorting_asc:before, table.dataTable > thead .sorting_asc_disabled:before, table.dataTable > thead .sorting_desc:before, table.dataTable > thead .sorting_desc_disabled:before {
    right: 0.8rem;
}
table.dataTable > thead .sorting:after, table.dataTable > thead .sorting_asc:after, table.dataTable > thead .sorting_asc_disabled:after, table.dataTable > thead .sorting_desc:after, table.dataTable > thead .sorting_desc_disabled:after {
    right: 0.8rem;
}
.dataTables_length select.form-select {
    width: 77px;
    margin: 0 5px;
}      
@media(min-width: 600px){
    #customerTable_length label {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    div#customerTable_filter label {
        display: flex;
        align-items: center;
    }
    input.form-control.form-control-sm {
        width: 200px;
        margin: 0 5px;
    }
    div#customerTable_wrapper>.row:first-child {
        flex-direction: row-reverse;
    }
}
@media(min-width:1024px){
    .table-responsive {
        overflow-x: hidden;
    }
    
}
@media(max-width:767px){
    table#customerTable {
        width: 780px;
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
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Suppliers</h5>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="card-body mt-4">
                        <div>
                            <div class="table-responsive table-card mb-1" id="contactList">
                                
                                <table class="table align-middle" id="customerTable">
                                    <thead class="table-dark text-white">
                                         <tr>
                    						<th class="sort text-left">Supplier Name</th>
                    				        <th class="no-sort text-left">Contact Person Name</th>
                    				        <th class="no-sort text-left">Contact Number</th>
                    				        <th class="sort text-left">Email</th>
                    				        <th class="sort text-left">HACCP Expiry Date</th>
                    				        <th class="sort text-left">CFR Expiry Date</th>
                    				    </tr>
            					    </thead>
                                    <?php $i = 0; if(!empty($suppliers)){ ?>
                                        <tbody class="list form-check-all" id="formRow">
                                            <?php foreach($suppliers as $row){  	?>
            		                            <tr class="tr" style="height: 49px !important;">
            		                                <td class="cafe_name"><?php echo $row->supplier_name; ?></td>
            		                                <td class="cafe_name"><?php echo $row->first_name; ?></td>
            		                                <td class="cafe_name"><?php echo $row->mobile; ?></td>
            		                                <td class="cafe_name"><?php echo $row->email; ?></td>
            		                                <td class="cafe_name"><?php echo date('d-m-Y', strtotime($row->haccp_expiry_date)); ?></td>
            		                                <td class="cafe_name"><?php echo date('d-m-Y', strtotime($row->cfr_expiry_date)); ?></td>
            		                            </tr>
            		                            <?php } ?>
    						            </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($suppliers)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We did not find any record for you search.</p>
                                    </div>
                                </div>
                               
                            </div>
                            
                        </div>
                     
                    </div>
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
<input type="hidden" value="<?php echo $table_name ?>" id="table_name">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<?php if(empty($suppliers)){ ?>
<script>
    $(document).ready(function () {
    $('#customerTable').DataTable({
        paging: false,
        info: false,
        "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false
            }]
    });
});
</script>
<?php }else{ ?>
<script>
    $(document).ready(function () {
    $('#customerTable').DataTable({
        "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false
            }]
    });
});
</script>
<?php } ?>