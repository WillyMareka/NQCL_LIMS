</head>
<style type="text/css">
input[type=text]{
	width: auto;
	border: 1px solid #000;
}
input[type=textarea]{
	border: 1px solid #000;
}
table{
	margin:auto;
	border:none;
}
</style>
</head>
<p><h4><strong><center>ASSAY</center></strong><h4></p>
        <p><strong><?php echo "NQCL/WKS/".date('Y')."/". $lastworksheet;?></strong></p>
<hr />
<body>
<form action="" method="post">
<table width="703" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="265">Column No:</td>
    <td width="166"><input type="text" name="column_no" width="150" id="column_no" required /></td>
    <td width="117">Type of Column:</td>
    <td width="155"><input type="text" name="column_type" id="column_type" width="150" required /></td>
    </tr>
  <tr>
    <td>Column Temp(degrees )</td>
    <td><input type="text" name="column_temp" id="column_temp" width="150" required /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Detection<strong> </strong>(nm)</td>
    <td><input type="text" name="detection" id="column_detection" width="150" required /></td>
    <td>Injection Vol(µL):</td>
    <td><input type="text" name="injection_vol" id="column_injection" width="150" required /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Mobile Phase:Composition (%v /v)&amp;Ratios:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td rowspan="2"><textarea name="textarea" id="textarea" cols="35" rows="4" required></textarea></td>
    <td>&nbsp;</td>
    <td>Flow Rate(mL/Min):</td>
    <td><input type="text" name="flow_rate" id="column_flow" width="150"  required/></td>
    </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td>Pump Pressure(bars)</td>
    <td><input type="text" name="column_no2" id="column_no2" width="150"  required/></td>
    </tr>
</table>
<p><input type="submit" value="Save Assay" class="submit-button" id="FormSubmit"></input></p>
</form>
</body>
</html>
