<html>
<script type="text/javascript" src="<?php echo base_url() . 'bower_components/accounting/accounting.js' ?>"></script>
<table>
	<col width = "720px">
	<tr>
		<td align ="center" >
			<h2>INVOICE</h2>
		</td>
	</tr>
</table>


<table class = "plain_bold_inline" >
<col width = "480px">
	<tr>
		<td>
			INVOICE No:&nbsp; <?php echo $invoice_number; ?>
		</td>
		<td align = "right">
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
					if($key != 'Client_Address'){
						echo "<p>".$value."<br /><p>"; 
				  }
				  else{
					echo str_replace(',',',<br /><p>', $value);
				  }
				}
			}?>
		</td>
	</tr>
</table>

<!--Reference / Subject Line -->
<table>
	<col width = "720px">
	<tr>
		<td align = "center">
			<p class = "centred plain_bold_inline underlined" >Re: ANALYSIS OF LISTED PRODUCT</p>
		</td>
	</tr>
</table>

<?php //echo json_encode($invoice_data[0]); ?>

<!-- Select Sample Details -->
<table>
	<?php foreach($invoice_data[0] as $key => $value) { if($key != 'id' && $key != 'Clients' && $key != 'Coa_number' && $key != 'Coa_body' && substr($key,0,7) != 'Clients') {?>
		<tr class = "<?php if($key == 'PRODUCT') { echo 'gray'; }  ?>">
		<?php if($key != 'Request_details'){ ?>
			<td class = "plain_bold_inline" ><?php echo str_replace("_", " ", $key).":"; ?></td>
			<td>&nbsp;</td>
			<td><?php echo $value; ?></td>
		<?php } else {?>
			<td class = "plain_bold_inline" >TEST(S) REQUESTED:</td>
			<td>&nbsp;</td>
			<td><?php 
				$counter = 1;
				$length = count($value);
				foreach($value as $v){
	
					if($counter < $length){
						echo $v['Tests'][0]['Name'].", ";
					}
					else{
						echo $v['Tests'][0]['Name'];
					}
					$counter++;
				}?>
			 </td>
		<?php } ?>
		</tr>
	<?php } } ?>
</table>

<!-- Cost table title -->
<table>
	<col width = "720px">
	<tr>
		<td align = "center">
			<p class = "centred plain_bold_inline" >COST OF ANALYSIS:</p>
		</td>
	</tr>
</table>


<!-- Table of costs -->
<table class = "centered border_collapse">
	<thead >
		<tr class = "plain_bold_inline bordered" >
			<td class = "gray bordered_right" >TEST</td>
			<td class = "bordered_right" >METHOD</td>
			<td class = "bordered_right" >COMPENDIA</td>
			<td class = "bordered_right" >COST(KShs)</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($test_data as $test){ ?>
		<tr class = "bordered" >
			<td class = "plain_bold_inline gray bordered_right" ><?php echo $test["tests"][0]["Name"] ?></td>
			<td class = "bordered_right" ><?php if($test["test_methods"] != null){echo $test["test_methods"][0]["name"];} else { echo $test["tests"][0]["Name"]; } ?></td>
			<td class = "bordered_right" ><?php echo $test["coa_body"]["compedia"]; ?></td>
			<td class = "plain_bold_inline bordered_right" id= "test_cost<?php echo $test["tests"][0]["id"]; ?>" ><?php echo $test["method_charge"] + $test["test_charge"] ?></td>
		</tr>
		<script>
			formattedMoney = accounting.formatMoney(<?php echo $test["method_charge"] + $test["test_charge"] ?>,{format: "%v" } );
			$('#test_cost<?php echo $test["tests"][0]["id"]; ?>').text(formattedMoney);
		</script>
		<?php }?>
		<?php foreach($tr_array as $k => $v) {?>
		<tr>
			<td colspan = "2" >&nbsp;</td>
			<td class = "plain_bold_inline bordered_all"><?php echo $k;?></td>
			<td class = "plain_bold_inline total bordered_all <?php if($k == "AMOUNT PAYABLE"){echo 'gray underlined';} ?>" ><?php echo $v; ?></td>
		</tr>
		<script>
			formattedTotal = accounting.formatMoney(<?php echo $v; ?>,{format: "%v" } );
			$('.total').text(formattedTotal);
		</script>
		<?php } ?>
	</tbody>
</table>

<!-- Spacer table -->
<table>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>

<!-- Signatory  -->
<table>
	<tr>
		<td><span class = "plain_bold_inline" ><?php echo strtoupper($signatory_title); ?>:</span></td>
		<td><span><?php echo strtoupper($signatory); ?></span></td>
		<td><span>________________</span></td>
		<td><span class = "plain_bold_inline" >DATE:</span></td>
		<td><?php echo date('d / m / Y'); ?></td>
	</tr>	
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

.underlined{
	text-decoration: underline;
}

.border_collapse{
	border-collapse:collapse;
}

.bordered{
	border: 1px solid black;
}

.bordered_right{
	border-right:1px solid black
}

.bordered_all{
	border:1px solid black
}

</style>

