<html>
<?php $balance = $this -> uri -> segment(6); ?>
	<div>
			<form class = "methods" id = "fpayment<?php echo $cid ?>" >
					<legend><h3>Payments&nbsp;&rarr;&nbsp;<?php echo $client_credit[0]['Name'] ?></h3></legend>
					    <ul>
					    	<fieldset>
					    		<li class = "plain_bold"><span class = "misc-title" >Total Balance:</span><span class = "money" id = "balance" ></span></li>
					    	</fieldset>
					    	 <fieldset>
					    	 	 	<legend>Transaction Details</legend>					    	 	 
							<li>
									<label>
										<span>Amount To Pay</span>
										<input id = "amount_to_pay" name = "amount_paid" class = "validate[required]" type = "text" />
									</label>
							</li>
							<li>
									<label>
										<span>Receipt No.<span class = "smalltext" >(Book)</span></span>
										<input name = "receipt_no" class = "validate[required]" type = "text" />
									</label>
							</li>
							<li>
									<label>
										<span class = "smalltext" >Client Paid For</span>
										<input name = "client_paid_for" class = "validate[required]" title = "Client Paid For (optional)" type = "text" placeholder = "e.g Harleys" />
									</label>
							</li>
							</fieldset>
							<fieldset>
									<legend>Payer Details</legend>					    	 	 
							<li>
									<label>
										<span>Name</span>
										<input name = "name" class = "validate[required]" type = "text" value = "<?php echo $client_credit[0]['Contact_person'] ?>" />
									</label>
							</li>
							<li>
									<label>
										<span>ID No.</span>
										<input name = "id_no" class = "validate[required]" type = "text" />
									</label>
							</li>
							<li>
									<label>
										<span>Phone No.</span>
										<input name = "phone_no" class = "validate[required]" type = "text" value = "<?php echo $client_credit[0]['Contact_phone'] ?>" />
									</label>
							</li>
							</fieldset>	
							<li>
									<input value="Save" type="submit" class = "submit-button leftie" />
							</li>
						</ul>
				</form>
		</fieldset>
	</div>
	<div id = "confirm_payment" class = "hidden2" title = "Confirm Transaction">
		<span>Save payments?</span>
	</div>

<script type = "text/javascript">
$(document).ready(function(){

	$('#fpayment<?php echo $cid ?>').submit(function(e){
		//console.log(accounting.unformat($('#amount_to_pay').val()));
		e.preventDefault();
		var submit_url = '<?php echo base_url(). "finance_management/payment"."/".$cid ?>'
		$('#confirm_payment').dialog({
			resizable:false,
			height:140,
			width: 100,
			modal:false,
			buttons:{
				"Yes":function() {

					//Unformat input value
					
			//Run ajax post
			$.ajax({
				type: 'POST',
				url: submit_url,
				data: $('#fpayment<?php echo $cid ?>').serialize(),
				dataType: "json"
			}).done(function(response){
					if(response.status === "success"){
						console.log(response.status);
						parent.$.fancybox.close();
						parent.document.location.reload();	
					}
					else if(response.status === "error"){
						console.log(response.status);
					}
			}).fail(function(){

			})
			$(this).dialog("close");
		},
				"No":function(){
					$(this).dialog("close");
				}
			}
		})

	})

	
	//Format values as currency
	formattedMoney = accounting.formatMoney("<?php echo $balance; ?>",{ symbol:"KES", format: "%s %v" } );
	$('#balance').text(formattedMoney);
	
	//Format value of input.
	/*$('#amount_to_pay').live('blur', function (e) {
                $(this).val(function () {
                    return accounting.formatMoney($(this).val(), {format: "%v"});
                });
            });*/

})
</script>

</html>