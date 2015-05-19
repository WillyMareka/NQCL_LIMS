	<html>	
		<form class = "methods" id = "<?php echo $formname ?>" >
		<!--fieldset-->
			<h3>Add New User</h3>
			<ul>
				<li>
			<fieldset>
				<legend>Personal Info</legend>
				<li>
					<label>
						<span>Title</span>
						<select class = "validate[required]" name = "title" >
							<option>Choose Title</option>
							<option value = "Mr." >Mr.</option>
							<option value = "Mrs." >Mrs.</option>
							<option value = "Dr." >Dr.</option>
							<option value = "Ms" >Ms</option>
							<option value = "Prof" >Prof.</option>
						</select>
					</label>
				</li>		
				<li>
					<label>
						<span>First Name</span>
						<input name="fName" value= "<?php echo set_value('fName');?>" class ="validate[required]" placeholder ="e.g Daniel" type="text" />
					</label>
				</li>
				<li>
					<label>
						<span>Second Name</span>
						<input name="sName" value= "<?php echo set_value('fName');?>" class ="validate[required]" placeholder ="e.g Daniel" type="text" />
					</label>
				</li>
				<li>
					<label>	
						<span>Phone</span>
						<input name="tPhone" value= "<?php echo set_value('tPhone');?>" class ="validate[required]" placeholder ="e.g BD" type="text" />
					</label>	
				</li>
				<li>
					<label>
						<span>Email Address</span>
						<input name="email" value= "<?php echo set_value('email');?>" placeholder ="e.g dmburu@nqcl.go.ke" type="email" id = "email_address" />			
					</label>
				</li>	
			</fieldset>
		</li>
				<li>
					<fieldset>
						<legend>Id Info</legend>
						<li>
							<label>
								<span>Id Type</span>
									<select name="id_type" id = "idtypes" >
										<option value="">-Select Id Type-</option>
										<option value = "Id">Id</option>
										<option value = "Passport">Passport</option>
				 					</select>
		 					</label>
						</li>
						<li>
							<label>
								<span id = 'idtype'></span>
								<input name = 'id_no' type = "text" placeholder = "2789898" />
							</label>
						</li>
					</fieldset>				
				</li>

				<li>
					<input value="Save" type="submit" class = "submit-button leftie" />
				</li>
			</ul>
		<!--/fieldset-->
	</form>
		<script type="text/javascript">
		$('#idtypes').live('change', function(){
			$('#idtype').text($(this).val());
		})

		$('#<?php echo $formname; ?>').submit(function(e) {
            e.preventDefault();
            var href = '<?php echo base_url()."finance_management/coaCollectionSave/$reqid"; ?>';
            $.ajax({
                type: 'POST',
                url: href,
                data: $('#<?php echo $formname; ?>').serialize()
            }).done(function() {
                parent.$.fancybox.open({
                    href: href,
                    type: 'iframe',
                    autoSize: false,
                    height: 842,
                    width: 595
                    //content: '<embed src = "'+href2+'#nameddest=self&page=1&view=FitH, 0&zoom=80,0,0" type="application/pdf" height="99%" width="100%" />', 
                });
            }).fail(function(){

            })

        })


		</script>
	</html>