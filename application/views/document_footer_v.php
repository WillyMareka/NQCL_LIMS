		<?php if($method == "printQuotation") {
			$colspan = 5;
			$cspan = 1;
		}
		else if ($method == "printProforma"){
			$colspan = 6;	
			$cspan = 2;
		}
		else if($method == "showInvoiceBeforePrint" || "printInvoice"){
			$colspan = $discount_cols;
			$cspan = $discount_csp;
		}
		?>

		<tr><td colspan = "<?php echo $colspan; ?>">&nbsp;</td></tr>
		<?php if($method != "showInvoiceBeforePrint") {?>
			<tr class = "plain_bold_inline">
				<td><?php echo $signatory_title ?></td>
				<td><?php echo $signatory ?></td>
				<td colspan = "<?php echo $cspan; ?>" ><hr></td>
				<td>DATE:</td>
				<td><?php echo date('j<\s\u\p>S</\s\u\p> F Y'); ?></td>
			</tr>
		<?php } else {?>
			<tr class = "plain_bold_inline">
				<td>Signatory</td>
				<td>
					<select id = "signatory_name" name = "signatory_name">
						<?php foreach($signatories as $s) { ?>
							<option value = "<?php echo $s["fname"].' '.$s["lname"]; ?>" data-title = "<?php echo $s["Users_types"][0]["User_type"][0]["name"]; ?>" ><?php echo $s["fname"].' '.$s["lname"]; ?></option>
						<?php } ?>	
					</select>
				</td>
				<td>DATE:</td>
				<td><?php echo date('j<\s\u\p>S</\s\u\p> F Y'); ?></td>
			</tr>
			<tr>
				<td colspan = "<?php echo $colspan; ?>" ><hr></td>
			</tr>
		<?php }?>


		<tr><td colspan = "<?php echo $colspan; ?>">&nbsp;</td></tr>
		<?php if($method != 'printInvoice') {?>	
			<tr class = "smalltext">
				<td colspan = "<?php echo $colspan; ?>"><span>Note that these costs may change depending on the actual tests carried out.</span>
				</td>
			</tr>
		<?php } ?>
		<tr class = "smalltext" >
			<td colspan = "<?php echo $colspan; ?>"><span>All cheques should be made payable to:</span>
				<span class = "plain_bold_inline" >NATIONAL QUALITY CONTROL LABORATORY.</span>
			</td>
		</tr>

		<?php if($method == "showInvoiceBeforePrint") {?>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td><input type = "submit" id = "print_invoice" class = "submit-button leftie" value = "Print"/></td>
			</tr>
			</form>	
		<?php }?>

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

		.zebra_striping{
			background-color: #fafafa;
		}
		.reducedtext{
			font-size: 0.9em;
		}

	</style>

	<?php if($method == "showInvoiceBeforePrint"){ ?>
		<script type="text/javascript">
			$('#invoice_before_print').submit(function(e){
				e.preventDefault();
				signatory_title = $('#signatory_name').attr('data-title');
				signatory = $('#signatory_name').val();
				var pdf_ibr_url = '<?php echo base_url()."quotation/printInvoice/$reqid/$table/$table2/$table3/$client_id/"; ?>' + signatory_title + "/" + signatory
				var pdf_url = '<?php echo base_url()."invoices/Invoice_".$reqid.".pdf"; ?>'
				console.log(pdf_url);
				$.ajax({
					type:'POST',
					url:pdf_ibr_url
				}).done(function(response){
					console.log(response);
					parent.$.fancybox.open({
						href:pdf_url,
						type: 'iframe',
						autoSize: false,
						height: 842,
						width: 595
					})
				})
			})
		</script>
	<?php } ?>	
