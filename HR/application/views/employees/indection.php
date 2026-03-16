<form method="post" action="<?php echo base_url(); ?>index.php/employees/submit_save_exit_emp_indection_reg">
<table class="table table-bordered" border="1">
<thead>
  <tr>
	<th>DESCRIPTION</th>
	<th>SIZE</th>
	<th>QTY</th>
	<th>COST PRICE</th>
	<th>TOTAL VALUE</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td rowspan="5">Green Polo Shirt
    	<input type="hidden" class="form-control" name="itemname[]" value="Green Polo Shirt">
    </td>
	<td>S</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][S_qty]"></td>
	<td>$15.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][S_total]"></td>
  </tr>
  <tr>
	<td>M</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][M_qty]"></td>
	<td>$15.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][M_total]"></td>
  </tr>
  <tr>
	<td>L</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][L_qty]"></td>
	<td>$15.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][L_total]"></td>
  </tr>
  <tr>
	<td>XL</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][XL_qty]"></td>
	<td>$15.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][XL_total]"></td>
  </tr>
  <tr>
	<td>XXL</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][XXL_qty]"></td>
	<td>$15.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Green Polo Shirt'][XXL_total]"></td>
  </tr>
  <tr>
    <td rowspan="5">Contemporary Shirt(Choclate/Stone)
    	<input type="hidden" class="form-control" name="itemname[]" value="Contemporary Shirt"></td>
	<td>S</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][S_qty]"></td>
	<td>$16.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][S_total]"></td>
  </tr>
  <tr>
	<td>M</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][M_qty]"></td>
	<td>$16.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][M_total]"></td>
  </tr>
  <tr>
	<td>L</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][L_qty]"></td>
	<td>$16.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][L_total]"></td>
  </tr>
  <tr>
	<td>XL</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][XL_qty]"></td>
	<td>$16.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][XL_total]"></td>
  </tr>
  <tr>
	<td>XXL</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][XXL_qty]"></td>
	<td>$16.90 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Contemporary Shirt'][XXL_total]"></td>
  </tr>
  <tr>
    <td>Cap Suede Twill Brown
    <input type="hidden" class="form-control" name="itemname[]" value="Cap Suede Twill Brown"></td>
	<td>ONE SIZE</td>
	<td><input type="text" class="form-control" name="uniform['Cap Suede Twill Brown'][onesize_qty]"></td>
	<td>$6.24 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Cap Suede Twill Brown'][onesize_total]"></td>
  </tr>
  <tr>
    <td>Chef Hat Custom Brown
    <input type="hidden" class="form-control" name="itemname[]" value="Chef Hat Custom Brown"></td>
	<td>ONE SIZE</td>
	<td><input type="text" class="form-control" name="uniform['Chef Hat Custom Brown'][onesize_qty]"></td>
	<td>$6.15 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Chef Hat Custom Brown'][onesize_total]"></td>
  </tr>
  <tr>
    <td>Bib Apron Custom Brown
    <input type="hidden" class="form-control" name="itemname[]" value="Bib Apron Custom Brown"></td>
	<td>ONE SIZE</td>
	<td><input type="text" class="form-control" name="uniform['Bib Apron Custom Brown'][onesize_qty]"></td>
	<td>$13.06 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Bib Apron Custom Brown'][onesize_total]"></td>
  </tr>
  <tr>
    <td>Continental Apron Custom Brown
    <input type="hidden" class="form-control" name="itemname[]" value="Continental Apron Custom Brown"></td>
	<td>ONE SIZE</td>
	<td><input type="text" class="form-control" name="uniform['Continental Apron Custom Brown'][onesize_qty]"></td>
	<td>$10.75 + GST</td>
	<td><input type="text" class="form-control" name="uniform['Continental Apron Custom Brown'][onesize_total]"></td>
  </tr>
</tbody>
</table>
<input type="submit" name="submit" value="submit">
</form>