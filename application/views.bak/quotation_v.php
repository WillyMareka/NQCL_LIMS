<html>
	<!-- Quotation header -->
	<!-- Address Info -->
<?php $this -> load -> view("document_header_v"); ?>

<?php //echo json_encode($i_data); ?>
<table>
<?php
			//Index holds position of key in array as would i in a for loop
			$index = 0; 


			//Loop through data
				foreach($i_data as $key => $value) {
					/*Do not display 'id' and values where index is greater than 5 i.e exclude info not relevant to
					header info*/
					if($key!='id' && $index < 5 ) {?>
	<tr>
		<td>
			<?php echo str_replace("_", " ", $key); ?>
		</td>
		<td class = "plain_bold_inline">

				<?php 
						//Echo value and append space
					  	echo $value;
					  	//Increment index for every iteration
				?>

		</td>
	</tr>
			<?php } $index++; } ?>
</table>

<table>
	<tr>
		<td>&nbsp;&nbsp;</td>
	</tr>
</table>

	<!-- Table with quotation details -->
	<table class = "centered" >
		<?php $count = count($invoice_data) + 1; $key1 = 1; ?>
		<?php for($i=0;$i<$count;$i++){ ?>
		<?php $index = 0; ?>
			<tr class = "<?php if($i == 0) { echo "gray plain_bold_inline"; } ?>">
				<?php foreach ($i_data as $key => $value) { if($index > 4) { ?>
						<td>
							<?php if($i == 0) { 
									if($key == 'Q_request_details'){ $key = 'Tests_Requested'; } echo str_replace("_", " ", $key); 
								 	}
								  else { 
								  	if($key == 'Q_request_details' || $key == 'Tests_Requested'){
								  		foreach($value as $v){
								  			if($key1%2){
												echo $v["Tests"][0]["Name"].", ";
											}
											else{
												echo $v["Tests"][0]["Name"]."<br />";
											}
										
											$key1++;
										}
								  	}
								  	else{
								  		echo $value;
								  	}
								  }
							?>
						</td>
				<?php } $index++; } ?>
			</tr>
			<?php } ?>
			<tr><td colspan = "5" ><hr></td></tr>
			<tr class = "plain_bold_inline" >
				<td colspan = "3" ></td>
				<td>Amount Payable (KES)</td>
				<td><?php echo $i_data['Total_Cost'] ?></td>
			</tr>
	</table>
	<table>
		<tr>
			<td class = "smalltext">Note that these costs may change depending on the actual tests carried out.</td>
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

.smalltext{
	font-size: 0.8em;
}


</style>


</html>