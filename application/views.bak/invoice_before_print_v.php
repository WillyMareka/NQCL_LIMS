<html>
<form id = "invoice_before_print">
<?php $this -> load -> view("document_header_v"); ?>
<p class = "centred"><h1>INVOICE</h1></p>
<p></p>

<table class = "plain_bold_inline" >
	<tr>
		<td colspan = "5" class = "plain_bold_inline"><hr></td>
	</tr>
	<tr>
		<td>
			INVOICE No:/<?php echo date('y'); ?>
		</td>
		<td class = "rightside" >
			Date: <?php echo date('j<\s\u\p>S</\s\u\p> F Y'); ?>
		</td>
	</tr>
</table>

<!-- Address Info -->
<table class = "plain_bold_inline" >
	<tr>
		<td>
			<?php foreach($invoice_data[0]["Clients"] as $key => $value) {
				if($key!='id'){
				  echo $value."<br><p>"; 
				}
			}?>
		</td>
	</tr>
</table>

<!--Reference / Subject Line -->
<h2 class = "centred plain_bold_inline" >Re: ANALYSIS OF LISTED PRODUCT</h2>

<?php var_dump($test_data); ?>

<!-- Select Sample Details -->
<table>
	<tr>
		<td colspan = "5" class = "plain_bold_inline"><hr></td>
	</tr>
	<?php foreach($invoice_data[0] as $key => $value) { if($key != 'id' && $key != 'Clients' && $key != 'Request_details' && $key != 'Coa_number' && $key != 'Coa_body') {?>
		<tr class = "<?php if($key == 'PRODUCT') { echo 'gray'; }  ?>">
			<td class = "plain_bold_inline" ><?php echo str_replace("_", " ", $key); ?></td>
			<td>&nbsp;</td>
			<td><?php echo $value; ?></td>
		</tr>
	<?php } } ?>
	<tr>
		<td colspan = "5" class = "plain_bold_inline"><hr></td>
	</tr>
</table>

<!-- Cost table title -->
<h2 class = "centred plain_bold_inline" >COST OF ANALYSIS:</h2>

<!-- Table of costs -->
<table class = "centered">
	<thead >
		<tr class = "plain_bold_inline" >
			<td class = "gray" >TEST</td>
			<td>METHOD</td>
			<td>COMPENDIA</td>
			<td>COST(KES)</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($test_data as $test){ ?>
		<tr>
			<td class = "plain_bold_inline gray" ><?php echo $test["tests"][0]["Name"] ?></td>
			<td><?php if($test["test_methods"] != null){echo $test["test_methods"][0]["name"];} else { echo $test["tests"][0]["Name"]; } ?></td>
			<td><?php if($test["coa_body"]["compedia"] != ""){echo $test["coa_body"]["compedia"];} else{ echo "N/A"; } ?></td>
			<td class = "plain_bold_inline"><?php echo $test["method_charge"] + $test["test_charge"] ?></td>
		</tr>
		<?php }?>
		<?php foreach($tr_array as $k => $v) {?>
		<tr>
			<td colspan = "2" >&nbsp;</td>
			<td class = "plain_bold_inline"><?php echo $k;?></td>
			<td class = "plain_bold_inline" ><?php echo $v; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan = "5" class = "plain_bold_inline"><hr></td>
		</tr>
		<?php $this -> load -> view("document_footer_v"); ?>
	</tbody>
</table>




<style type="text/css">

.plain_bold_inline{
	font-weight:bold;
}

.centered{
	text-align: center;
}

.gray{
	background-color: #E5E4E2;
}


</style>
