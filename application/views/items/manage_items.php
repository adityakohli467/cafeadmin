<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
}
.m-width{
    width: 84px;
}
.form-control {
    padding: 5px !important;
    height: 30px;
    line-height: normal;
}
select.form-control {
    padding: 5px 15px 5px 5px !important;
}
table.dataTable thead>tr>th {
    padding-left: 14px !important;
    padding-right: 15px !important;
    font-size: 12px;
}
</style>
		
<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		<div class="col-md-4"></div>
		<div class="col-md-2">
			<span class="text-center">
				<h3>Products</h3>
			</span>
		</div>
		<div class="btn-div col-md-4">
		    <a class="btn btn-success btn-ph" onclick="export_data()" style="position: relative !important;">Export Product</a>
		    <input type="hidden" value="" id="store_supp_id_forexport">
		    <button type="button" class="btn btn-success btn-ph" id="myBtn">Add Product</button>
			<button type="button" class="btn btn-success btn-ph" id="myBtn"onclick="updatePriceofallitem()">Update All Items</button>
		</div>
</div><!--.col-md-12 -->
	
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="contact_form" method="post" action="<?php echo base_url().'index.php/items/submit_items'; ?>">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
        <div class="modal-body">
		<div class="panel-group">
            <div class="panel panel-default">
            <div class="panel-heading">Product Details</div>
            <div class="panel-body">
			   <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Supplier<span>*</span></label>
	                <div class="col-sm-8">
					<input type="text" class="form-control supplier" >
				    <input type="hidden" name="supplier_id" >
					</div>
	             </div>
	             <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Product Code</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="item_code" onBlur="capitalize(this)"  autocomplete="off">
	                </div>
	              </div>
				<div class="form-group">
	                <label for="inputEmail3" class="col-sm-4 control-label">Product Name<span>*</span></label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="item_name" onBlur="capitalize(this)"  autocomplete="off">
	                </div>
	             </div>  
				<div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Category<span>*</span></label>
	                <div class="col-sm-8">
	                	
	                	<select class="form-control" name="category">
	                		<option value="">Select</option>
	                		<?php foreach($item_cat_dropdown as $item_cat){ ?>
	                		<option value="<?php echo $item_cat->category_id; ?>"><?php echo $item_cat->category_name; ?></option>
	                	    <?php } ?>
	                	</select>
	                	
                     					  
					</div>
	              </div>  
			     <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Pack Quantity</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="pack_qnty" onkeypress='validate(event)'  autocomplete="off">
	                </div>
	              </div>
				  <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Uom</label>
	                <div class="col-sm-8">
	                  <select class="form-control" name="uom">
					  <option value="">Select</option>
					  <option value="kg">kgs</option>
					  <option value="gms">gms</option>
					  <option value="ltrs">ltrs</option>
					  <option value="ml">ml</option>
					  <option value="pcs">pcs</option>
					  <option value="box">box</option>
					  <option value="ctn">Ctn</option>
					  <option value="ea">Ea</option>
					  </select>
	                </div>
	              </div>
				  <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Packs Per Case</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="packs_per_case" onBlur="capitalize(this)"  autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Price<span>*</span></label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="price" onkeypress='validate(event)'  autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Type</label>
	                <div class="col-sm-8">
	                 <select class="form-control" name="type">
					 <option value="">Select</option>
					 <option value="pack">Per Pack</option>
					 <option value="case">Per Case</option>
					 </select>
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Account</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="account" autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Account Name</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="account_name" autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Tax Code</label>
	                <div class="col-sm-8">
	                 <select class="form-control" name="tax_code">
					 <option value="">Select</option>
					 <option value="GST">GST</option>
					 <option value="FREE">FREE</option>
					 </select>
	                </div>
	              </div>
	              <!--<div class="form-group">-->
	              <!--  <label for="inputPassword3" class="col-sm-4 control-label">Description</label>-->
	              <!--  <div class="col-sm-8">-->
	              <!--    <textarea class="form-control" name="description"></textarea>-->
	              <!--  </div>-->
	              <!--</div>-->
			</div>
            </div>
			<div class="panel panel-default">
            <div class="panel-heading">Minimum Order</div>
            <div class="panel-body">
			     <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Quantity</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="min_order_qnty" onkeypress='validate(event)' autocomplete="off">
	                </div>
	              </div>
				  <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Type</label>
	                <div class="col-sm-8">
					  <select class="form-control" name="min_order_type">
					  <option value="">Select</option>
					  <option value="case">Case</option>
					  <option value="pack">Pack</option>
					  </select>
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
	                <div class="col-sm-8">
	                  <span><input type="radio"  name="status" value="1" checked>Active</span>
	                  <span><input type="radio" name="status" value="0">Disabled</span>
	                </div>
	              </div>
			</div>
            </div>
	    </div>
		
		
                 
        </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-success btncolor">Save</button>
          <button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      
    </div>
  </div>

<div style="background-color:#fff;" class="container-fluid main-container">
		
	<div class="col-md-12">
		
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
		
			<div class="panel-body">
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
			<select class="table-select app-select" onchange="getSupplierItems(this)" style="width:20%;">
				<option value="all">All Suppliers</option>
				<?php 
				if(!empty($item_suppliers)){
				foreach($item_suppliers as $supp){ ?>
				<?php if(isset($selectedSupplierId) && $selectedSupplierId == $supp->supplier_id) {  ?>
				<option value="<?php echo $supp->supplier_id;?>" selected ><?php echo $supp->supplier_name;?></option>
				<?php } else { ?>
				<option value="<?php echo $supp->supplier_id;?>"><?php echo $supp->supplier_name;?></option>
				<?php  } ?>
				
				<?php }} ?>
			</select>
		<!--.table-->
		<div class="table-up">
		<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-center">Approved</th>					   
						<th class="text-left">Item Code</th>
						<th class="text-left">Product Name</th>
						<th class="text-left">Price</th>
						<th class="text-left">Category</th>
						<th class="text-left">Supplier</th>
						<th class="text-left">Account</th>
						<th class="text-left">Account Name</th>
						<th class="text-left">Tax Code</th>
						<th class="text-left">Sort order</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					
					</tr>
				</thead>
				<tbody id="supplier_items">
				<?php foreach($items as $item){
					foreach($item as $row){
				if($user_group != 'Super Admin' && $row->group_name == 'Super Admin'){
				?>
					<tr class="tr">
						<td class="text-center"><input type="checkbox" onclick='itemsInsert(this,<?php echo  $row->itemId ?>);' id="checkbox1"  <?php if($row->user_access == "1"){ echo "checked";  } ?> ></td>
					    
					    
					    
					    <td class="text-left">	<span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span>
                        <input type="text" class="form-control m-width"  value="<?php echo $row->itemCode; ?>" ><span style="cursor:pointer" onclick="updatefieldofthisitem(this, <?php echo $row->itemId; ?>)"> Update</span><input type="hidden" value="itemCode"></td>
                        
                        
					    <td class="text-left"><?php echo $row->itemName ?></td>
						<td class="text-left">	<span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span>
                        <input type="text" class="form-control m-width"  value="<?php echo number_format($row->price,2,'.',''); ?>" ><span style="cursor:pointer" onclick="updatefieldofthisitem(this, <?php echo $row->itemId; ?>)"> Update</span><input type="hidden" value="price"></td>
						<td class="text-left"><?php echo $row->category_name; ?></td>
						<td class="text-left"><?php echo $row->supplier_name; ?></td>
						<td class="text-left">	<span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span>
                        <input type="text" class="form-control" value="<?php echo $row->account; ?>" ></td>
						
						<td class="text-left">	<span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span>
                        <input type="text" class="form-control" value="<?php echo $row->account_name;  ?>" ></td>
						
						<td class="text-left">	<span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span>
                        <select class="form-control m-width"> <option value="">Select</option><option value="GST" <?php if($row->tax_code == 'GST'){ echo 'selected'; }?> >GST</option><option value="FREE" <?php if($row->tax_code == 'FREE'){ echo 'selected'; }?> >FREE</option></select></td>
						
						<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong></span><input type="text"  value="<?php echo $row->product_sort_order; ?>" ><span style="cursor:pointer" onclick="updatefieldofthisitem(this, <?php echo $row->itemId; ?>)"> Update</span><input type="hidden" value="product_sort_order"></td>
						<td class="text-center"><?php if($row->status == "1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
					<td class="text-center">
							<a type="button" onClick="delete_row(<?php echo  $row->itemId ?>);"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
				<?php }else{ ?>
					<tr class="tr">
						<td class="text-center"><input type="hidden" name="itemId[]" value="<?php echo  $row->itemId ?>" ><input type="checkbox" onclick='itemsInsert(this,<?php echo  $row->itemId ?>);' id="checkbox1"  <?php if($row->user_access == "1"){ echo "checked";  } ?> ></td>
					    
					    <td class="text-left">	<span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span>
                        <input type="text" class="form-control m-width"  value="<?php echo $row->itemCode; ?>" ><span style="cursor:pointer" onclick="updatefieldofthisitem(this, <?php echo $row->itemId; ?>)"> Update</span><input type="hidden" value="itemCode"></td>
                        
					    <td class="text-left"><a type="button" onClick="edit_row('<?php echo $row->itemId ?>')" id="<?php echo $row->itemId ?>" class="update_user_button" ><?php echo $row->itemName ?></a></td>
					    <td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><input type="text" class="form-control m-width" id="item_unit_price" name="price[]" value="<?php echo number_format($row->price,2,'.',''); ?>" ><span style="cursor:pointer" onclick="updatefieldofthisitem(this, <?php echo $row->itemId; ?>)"> Update</span><input type="hidden" value="price"><input type="hidden" id="item_unique_id" value="<?php echo $row->itemId; ?>"></td>
						<td class="text-left"><?php echo $row->category_name; ?></td>
						<td class="text-left"><?php echo $row->supplier_name; ?></td>
						<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><input type="text"  class="form-control" id="account" name="account[]" value="<?php echo $row->account; ?>" ></td>
						
						<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><input type="text"  class="form-control" id="account_name" name="account_name[]" value="<?php echo $row->account_name; ?>" ></td>
						
						<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><select class="form-control m-width" id="tax_code" name="tax_code[]"> <option value="">Select</option><option value="GST" <?php if($row->tax_code == 'GST'){ echo 'selected'; }?> >GST</option><option value="FREE" <?php if($row->tax_code == 'FREE'){ echo 'selected'; }?> >FREE</option></select></td>
						
					<td class="text-left"><span class="update_alert" style="display:none;color:green;"> <strong> Field is Updated!</strong></span><input class="form-control m-width" type="text" name="product_sort_order[]"  value="<?php echo $row->product_sort_order; ?>" ><span style="cursor:pointer" onclick="updatefieldofthisitem(this, <?php echo $row->itemId; ?>)"> Update</span><input type="hidden" value="product_sort_order"></td>
						<td class="text-center"><?php if($row->status == "1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
						<td class="text-center">
							<a type="button" onClick="delete_row(<?php echo  $row->itemId ?>);"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
				<?php }}} ?>
					</tbody>
				</table>
				</div>
			</div>
			</div>
		</div>
	</div><!--.container-->
		
		<!--.table-->
		<br>
<div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="contact_form_edit" method="post" action="<?php echo base_url().'index.php/items/update_items'; ?>">
      
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
        <div class="modal-body">
             <input type="hidden" id="myText1" name="id">
            
			<div class="panel-group">
            <div class="panel panel-default">
            <div class="panel-heading">Product Details</div>
            <div class="panel-body">
			   <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Supplier<span>*</span></label>
	                <div class="col-sm-8">
					<input type="text" class="form-control supplier" id="supplierId" >
				    <input type="hidden" name="supplier_id" id="supplier_id">
					</div>
	              </div>
	            <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Product Code</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="item_code" id="itemCode" onBlur="capitalize(this)"  autocomplete="off">
	                </div>
	              </div>  
				<div class="form-group">
	                <label for="inputEmail3" class="col-sm-4 control-label">Product Name <span>*</span></label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="item_name" id="item_name" onBlur="capitalize(this)"  autocomplete="off">
	                </div>
	             </div>  
				<div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Category<span>*</span></label>
	                <div class="col-sm-8">
	                	<select class="form-control"  name="category" id="category_id">
	                		<option value="">Select</option>
	                		<?php foreach($item_cat_dropdown as $item_cat){ ?>
	                		<option value="<?php echo $item_cat->category_id; ?>"><?php echo $item_cat->category_name; ?></option>
	                	    <?php } ?>
	                	</select>
                     				  
					</div>
	              </div>  
			     <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Pack Quantity</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="pack_qnty" id="pack_quantity" onkeypress='validate(event)'  autocomplete="off">
	                </div>
	              </div>
				  <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Uom</label>
	                <div class="col-sm-8">
	                  <select class="form-control" name="uom" id="uom">
					  <option value="">Select</option>
					  <option value="kg">kgs</option>
					  <option value="gms">gms</option>
					  <option value="ltrs">ltrs</option>
					  <option value="ml">ml</option>
					  <option value="pcs">pcs</option>
					  <option value="box">box</option>
					   <option value="ctn">Ctn</option>
					  <option value="ea">Ea</option>
					  </select>
	                </div>
	              </div>
				  <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Packs Per Case</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="packs_per_case" id="packs_per_case"   autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Price<span>*</span></label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="price" id="price" onkeypress='validate(event)'  autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Type</label>
	                <div class="col-sm-8">
	                 <select class="form-control" name="type" id="type">
					 <option value="">Select</option>
					 <option value="pack">Per Pack</option>
					 <option value="case">Per Case</option>
					 </select>
	                </div>
	              </div>
	               <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Account</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" id="account-input" name="account" autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Account Name</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" id="account_name-input" name="account_name" autocomplete="off">
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Tax Code</label>
	                <div class="col-sm-8">
	                 <select class="form-control" name="tax_code" id="tax_code-input">
					 <option value="">Select</option>
					 <option value="GST">GST</option>
					 <option value="FREE">FREE</option>
					 </select>
	                </div>
	              </div>
	              <!--<div class="form-group">-->
	              <!--  <label for="inputPassword3" class="col-sm-4 control-label">Description</label>-->
	              <!--  <div class="col-sm-8">-->
	              <!--    <textarea class="form-control" name="description" id="description"></textarea>-->
	              <!--  </div>-->
	              <!--</div>-->
			</div>
            </div>
			<div class="panel panel-default">
            <div class="panel-heading">Minimum Order</div>
            <div class="panel-body">
			     <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Quantity</label>
	                <div class="col-sm-8">
	                  <input type="text" class="form-control" name="min_order_qnty" id="min_order_qnty" onkeypress='validate(event)' autocomplete="off">
	                </div>
	              </div>
				  <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Type</label>
	                <div class="col-sm-8">
					  <select class="form-control" name="min_order_type" id="min_order_type" >
					  <option value="">Select</option>
					  <option value="case">Case</option>
					  <option value="pack">Pack</option>
					  </select>
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
	                <div class="col-sm-8">
	                  <div class="status-radio">
						<div class="product_status">
						<span><input type="radio" name="status" value="1"  >Active</span>
						<span><input type="radio" name="status" value="0"  >Disabled</span>
						</div>
					  </div>
	                </div>
	              </div>
			</div>
            </div>
	    </div>
        </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-success btncolor">Save</button>
          <button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      
    </div>
  </div>
	<style>
	    


	</style>
   <script>
   
   function export_data(){
var Supp_id = $("#store_supp_id_forexport").val();

      $.ajax({
		url:"<?php echo base_url();?>index.php/items/export_product",
		method:"POST",
		data:{
		    supplier_id:Supp_id,
		    },
	    success: function () {
            window.open(this.url,'_blank' );
        }
        });
    
}
   function itemsInsert(str,res){
   	
   	   if(str.checked) {
            var user_access = 1;
		} else{
			var user_access = 0;
		}
		$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/items_update",
        data:'id='+res+'&access='+user_access,
        success: function(data){
          //location.reload();
        }
       });
    }
   </script>
		
	<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete item')){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/items/items_delete",
				data:'id='+str,
				success: function(data){
					location.reload();
				}
			});
		}	
	}
	</script>	


<script>
	function edit_row(str){
	    var HTMLopt = '';
    //alert(str);
		    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/edit_items",
        data:'id='+str,
        success: function(data){
        	//alert(data);
			var obj = jQuery.parseJSON(data);
			 document.getElementById("myText1").value = obj.itemId;
			 document.getElementById("item_name").value = obj.itemName;
			 document.getElementById("price").value = obj.price;
			 document.getElementById("category_id").value = obj.category_id;
			 document.getElementById("supplier_id").value = obj.supplier_id;
			 document.getElementById("supplierId").value = obj.supplier_name;
			 document.getElementById("uom").value = obj.uom;
			 document.getElementById("pack_quantity").value = obj.pack_quantity;
			 document.getElementById("packs_per_case").value = obj.packs_per_case;
		     document.getElementById("itemCode").value = obj.itemCode;
			 document.getElementById("type").value = obj.type;
			 document.getElementById("account-input").value = obj.account;
			 document.getElementById("account_name-input").value = obj.account_name;
			 if(obj.tax_code == "GST"){
			     HTMLopt = '<option value="">Select</option><option value="GST" selected>GST</option><option value="FREE">FREE</option>'
			 }else if(obj.tax_code == "FREE"){
			     HTMLopt = '<option value="">Select</option><option value="GST" >GST</option><option value="FREE" selected>FREE</option>'
			 }else{
			     HTMLopt = '<option value="">Select</option><option value="GST" >GST</option><option value="FREE">FREE</option>'
			 }
			 document.getElementById("tax_code-input").innerHTML = HTMLopt;
			 document.getElementById("min_order_qnty").value = obj.min_order_qnty;
			 document.getElementById("min_order_type").value = obj.min_order_type;
			 //document.getElementById("description").value = obj.description;
		     
			  if (obj.status == '1'){
			   $('.product_status').find(':radio[name=status][value="1"]').prop('checked', true);
			  }else{
			  $('.product_status').find(':radio[name=status][value="0"]').prop('checked', true);
			  }
			

        }
       });
		
	}
</script>
		<script type="text/javascript">
			
		$(document).ready(function(){
		    $('[data-toggle="popover"]').popover();   
		});

		</script>
<script>
	function getSupplierItems(e){
		var supId = $(e).val();
		$("#store_supp_id_forexport").val(supId);
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/items/getSupplierItems",
	        data:'supplier_id='+supId,
	        success: function(data){
	        	 //alert(data);
	        	$('#supplier_items').html(data);
	        	$(".update_user_button").click(function () {
				    $("#updateModal").modal();
				    var availTags = supplierTags();
					autoSuppliers(availTags,'updateModal');
				    var catTags = catIdTags();
					autocatId(catTags,'updateModal');
				});
	        }
        });
	}
		</script>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
		var availTags = supplierTags();
		autoSuppliers(availTags,'myModal');
		var catTags = catIdTags();
		autocatId(catTags,'myModal');
    });
});
</script>
<script>
$("#updateModal").modal({
    show: false
});

$(".update_user_button").click(function () {
    $("#updateModal").modal();
    var availTags = supplierTags();
	autoSuppliers(availTags,'updateModal');
    var catTags = catIdTags();
	autocatId(catTags,'updateModal');
});
</script>

<script type="text/javascript">
	$(document).ready(function() {
	    $("#contact_form").validate({
	        ignore: "input[type='text']:hidden",
		    rules: {
		    	supplier_id: {
	                required:true
	            },
				item_name: {
	                required:true
	            },
	            category: {
	                required:true
	            },
	            price: {
	                required:true
	            }
				
		},		
		messages: {
			supplier_id: {
                 required:"Please provide supplier"
            },
			item_name: {
                 required:"Please provide Product name"
            },
            category: {
                 required:"Please provide category"
            },
            price: {
                 required:"Please provide price"
            }
		},
	
	    });	
	});
</script>
<script type="text/javascript">
	$(document).ready(function() { 
    $("#contact_form_edit").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			supplier_id: {
	                required:true
	            },
				item_name: {
	                required:true
	            },
	            category: {
	                required:true
	            },
	            price: {
	                required:true
	            }									
			
	},		
	messages: {
			supplier_id: {
                 required:"Please provide supplier"
            },
			item_name: {
                 required:"Please provide Product name"
            },
            category: {
                 required:"Please provide category"
            },
            price: {
                 required:"Please provide price"
            }	
	},

    });	
});
</script>
    <script>

	function supplierTags(){
		var obj = JSON.parse('<?php echo json_encode($suppliers,JSON_HEX_APOS);?>');
	  	var availTags = $.map(obj, function (value, key) {
	                return {
	                    label: value.supplier_name,
	                    id: value.supplier_id
	                }
	              });
	 	return availTags;
	}
	function autoSuppliers(availTags,popupId){
  	    $(".supplier").autocomplete({
		    source: availTags,
		    change: function (event, ui){
				if (!ui.item){
					this.value = '';
				}else{
					var supplier_name = ui.item.label;
					this.value = supplier_name;
				}
		    },
	    	select: function (event, ui) {
	        	var supplier_name = ui.item.id;
	            $(this).siblings("input[type='hidden']").val(supplier_name);
	        },
	        appendTo: '#'+popupId
	    });
    }
	
  </script>	
  <script>
  function catIdTags(){
		var obj = JSON.parse('<?php echo json_encode($cat_result,JSON_HEX_APOS);?>');
	  	var catTags = $.map(obj, function (value, key) {
	                return {
	                    label: value.category_name,
	                    id: value.category_id
	                }
	              });
	 	return catTags;
	}
	function autocatId(catTags,popupId){
  	    $(".category").autocomplete({
		    source: catTags,
		    change: function (event, ui){
		      if (!ui.item){
		        this.value = '';
		      }else{
		        var category_name = ui.item.label;
		        this.value = category_name;
		      }
	    	},
	    select: function (event, ui) {
	        	var category_name = ui.item.id;
	            $(this).siblings("input[type='hidden']").val(category_name);
	        },
	        appendTo: '#'+popupId
	    });
    }
    
   function updatefieldofthisitem(obj,item_id){
        
        $fieldname = $(obj).next('input').val();
        if($fieldname == 'tax_code'){
            $field_new_value = $(obj).prev('select').val();
        }else{
            $field_new_value = $(obj).prev('input').val();
        }
      
        $.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/items/updatefieldofthisitem",
	        data:'item_id='+item_id+'&field_new_value='+$field_new_value+'&fieldname='+$fieldname,
	        success: function(data){
	            console.log(obj);
	      $(obj).prev().prev(".update_alert").css("display","block");
	       $(obj).prev().prev(".update_alert").delay(1000).fadeOut(500); 
	       
	        }
        });
        
        
    }
function updatePriceofallitem(){
 var productIdsAndPrice = {};
 var productData = {};

$("#supplier_items tr").each(function()
{
    var productData = {};
var item_unique_id = $(this).find("#item_unique_id").val();
var item_unit_price = $(this).find("#item_unit_price").val();
var account = $(this).find("#account").val();
var account_name = $(this).find("#account_name").val();
var tax_code = $(this).find("#tax_code").val();
// productIdsAndPrice[item_unique_id] = item_unit_price;
productData['item_unit_price'] = item_unit_price;
productData['account'] = account;
productData['account_name'] = account_name;
productData['tax_code'] = tax_code;
productIdsAndPrice[item_unique_id] = productData;

console.log("item_unique_id",item_unique_id);
console.log("item_unit_price",item_unit_price);
console.log("account",account);
console.log("tax_code",tax_code);
console.log("account_name",account_name);


});
         $.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/items/updatePriceofallitem",
	        data:'productIdsAndPrice='+JSON.stringify(productIdsAndPrice),
	        success: function(data){
	    alert("All Items Updated.");
	       
	        }
        });
        
        
    }
  </script>
<script>
// window.onscroll = function() {myFunction()};


// var sticky = $(".page-head").offset();

// console.log('header'+sticky.top);

// function myFunction() {
//     console.log(window.pageYOffset);
//   if (window.pageYOffset > sticky.top) {
//     $(".page-head").addClass("sticky");
//   } else {
//     $(".page-head").removeClass("sticky");
//   }
// }
</script>