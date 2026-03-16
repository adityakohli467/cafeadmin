	<html>
<head>
	<title>Purchase Order</title>

<style>
  


body {font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 9pt;
}
h2, h4, h5, h6 {
	margin:4px 0;
}

.bold{
	font-weight:bold;
	text-align:right;
	font-size:15px;
}

p {	
	margin: 0pt;
	line-height:1.5em;
	}
table.items{
	border: 2px solid black;
    border-collapse: collapse;
}
td { 
	vertical-align: top;
}
.items td {
	border-top: 0.3mm solid black ;
	border-right: 0.1mm solid black;
	padding: 5px;
    text-align: center;
    border: 2px solid black;
    border-collapse: collapse;
}
table thead td { 
	background-color: #FFFFFF;
	padding: 5px;
    line-height: 1em;
	border: 2px solid black;
	border-top:none;
	color: black;
}

table thead tr { 
	margin-bottom:-20pt;
	
}

.bot-thead{
	color:black;
	/*font-size:9pt;*/
}

input{
	height:40pt;
}

.right{
	text-align:right;
}
h1{
	font-weight:normal;
}
.abc{
	width: 300px;
    padding: 5px;
    border: 2px solid black;
    margin: auto;
    text-align:left;
    margin-right: 0px;
    margin-left: auto;
}
</style>
</head>
<body>
<!--<div>
		<img src="images/1.png" >
</div>-->
<div class="bold">
	<p>PURCHASE ORDER</p>
</div>
	<div class="col-md-6">
					<img src="images/1.png" width=40% height="20%" align="left">
      				<input class="input" type="text" value="PURCHASE NO: &nbsp;&nbsp; 123456" size="40" readonly>
      				<p>	ZOUKI CAFÉ-SUNSHINE HOSPITAL<br>
						C/O 226-227/ 55 FLEMINGTON RD.<br><br>
						NORTH MELBOURNE VIC 3051<br>
      				</p>
      				<p> ABN: &nbsp;&nbsp;&nbsp; 41 311 261 841<br>
      					PHONE: &nbsp;&nbsp; 03 9320 9600
      				</p>
    </div>
    <!--<div class="col-md-6 abc">
      	<p> SHIP TO:<br>
			Ms. Fiona Davis<br><br>
			04 14857504<br>
			EmailID
      	</p>
    </div>-->
<br /><br />
<table class="abc" >
  <tr>
    <td>SHIP TO:<br>
		Ms. Fiona Davis<br><br>
		04 14857504<br>
		EmailID
    </td>
  </tr>
</table>
<table class="items" width="100%"  cellpadding="8">
	<tr>
		<td width="15%" align="center" colspan="3">COST CENTRE</td>
		<td width="15%" align="center" colspan="3">ORDER DATE</td>
		<td width="12%" align="center" colspan="3">DELIVERY DATE</td>
	</tr>
	<tr>
		<td colspan="3">TFN</td>
		<td>13</td>
		<td>02</td>
		<td>2018</td>
		<td>14</td>
		<td>02</td>
		<td>2018</td>
	</tr>
	<tr>
		<td>QTY</td>
		<td colspan="5">DESCRIPTION</td>
		<td>UNIT RATE</td>
		<td colspan="2">TOTAL AMOUNT</td>
	</tr>
	<tr>
		<td ></td>
		<td colspan="5"></td>
		<td></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="5"></td>
		<td></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="5"></td>
		<td></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="5"></td>
		<td></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="6">COMMENTS/NOTES</td>
		<td colspan="2">SALES AMOUNT($)</td>
		<td> $ 270.00 </td>
	</tr>
</table>
</body>
</html>