<html>
	<title>User Details</title>
	<head></head>
	<!--body-->
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
						<span>Surname</span>
						<input name="lName" value= "<?php echo set_value('lName');?>" class ="optional" placeholder ="e.g Mburu" type="text" />
					</label>
				</li>
				<li>
					<label>
						<span>Other Names</span>
						<input name="oNames" value= "<?php echo set_value('lName');?>" class ="optional" placeholder ="e.g Mburu" type="text" />
					</label>
				</li>

				<li>
					<label>	
						<span>Telephone</span>
						<input name="tPhone" value= "<?php echo set_value('tPhone');?>" class ="validate[required]" placeholder ="e.g BD" type="text" />
					</label>	
				</li>
				<li>
					<label>
						<span>Email Address</span>
						<input name="email" value= "<?php echo set_value('email');?>" class ="validate[required, custom[email]]" placeholder ="e.g dmburu@nqcl.go.ke" type="email" id = "email_address" />			
					</label>
				</li>	
			</fieldset>
		</li>
				<li>
					<fieldset>
						<legend>Unit Details</legend>
						<li>
							<label>
								<span>Division</span>
									<select name="deptID" id = "depts" >
										<option value="">-Select Division-</option>
										<?php foreach($depts as $dept) {?>
											<option value = "<?php echo $dept -> id ?>" ><?php echo $dept -> Name ?></option>
										<?php }?>
				 					</select>
		 					</label>
						</li>
						<li><hr></li>
						<li>
							<label id = "units_label" >
								<span id = "units_span" ></span>
									<select id = "units" class = "hidden2" name="unit" class = "validate[required]" ></select>
							</label>
						</li>
						<li>
								<label id = "roles" ></label>
						</li>
					</fieldset>				
				</li>

				<li>
					<input value="Save" type="submit" class = "submit-button leftie" />
				</li>

			</ul>
		<!--/fieldset-->
	</form>
	<!--/body-->

	<script type = "text/javascript">
	<?php 
		$userarray = $this->session->userdata;
		$user_type = $userarray['usertype_id'];
	?>
	var utype = "<?php echo (int)$user_type ?>"

	if(utype == '2'){
		$('.Tier3').toggle(false);
	}
	else{
		$('.Tier3').toggle(true);
	}
	

	$('#depts').on('change', function(){
		var dept = $(this).val();
		var units_url = '<?php echo base_url()."user_registration/getUnits/" ?>' + dept;
		var user_type_url = '<?php echo base_url()."user_registration/getRoles/" ?>' + dept;					
			$.ajax({
					type: 'POST',
					url: units_url,
					dataType: "json"
					}).done(function(response){
						if(response.length){
										var opts = [];
										opts.push("<option value = '' ></option>");
										for(i=0;i<response.length;i++){
											opts.push("<option class = 'unit' value = '"+response[i].id+"' >"+response[i].name+"</option>");
									}
									$("#units").toggle(true).html(opts);
									$('#units_span').text('Unit');
								}
								else {
									$("#units").toggle(false).html('');
									$('#units_span').text('');
								}

								$.ajax({
									type:'POST',
									url:user_type_url,
									dataType: "json"
								}).done(function(response2){
									console.log(response2)
									var checkbox_array = [];
									for(i=0;i<response2.length;i++){
										checkbox_array.push("<li data-unit = '"+response2[i].unit+"' class='Tier"+response2[i].tier+"'><input type = 'checkbox' data-unit = '"+response2[i].unit+"' class='Tier"+response2[i].tier+"' name='userType[]' value='"+response2[i].id+"' /><span class = 'unit_name'>"+response2[i].name+"</span></li>");
									}
									$('#roles').toggle(true).html(checkbox_array);
								})

					}).fail({
				})
			})	

$("#units").on('click', 'option', function(){
	var unit_id = $(this).val();
	var $this = $(this);
	if($this.is(":selected")){
		$('#roles li[class = "Tier2"][data-unit = '+unit_id+']').toggle(true);
		$('#roles li[class = "Tier2"]').not('[data-unit = '+unit_id+']').not('[data-unit = 0]').toggle(false);
	}
	else{
		$('#roles li[class = "Tier2"][data-unit = '+unit_id+']').toggle(false);
		$('#roles li[class = "Tier2"]').not('[data-unit = '+unit_id+']').not('[data-unit = 0]').toggle(true);
	}
})



$('#roles').on('click', 'input', function(){
    var $this = $(this);
    console.log($this);
    if ($this.is(".Tier1")) {
        if ($(".Tier1:checked").length > 0) {
            $(".Tier3,.Tier4,.Tier5").prop({ disabled: true, checked: false });
        } else {
            $(".Tier3, .Tier4, .Tier5").prop({ disabled: false, checked: false });
        }
    } else if ($this.is(".Tier2")) {
        if ($this.is(":checked")) {
            $(".Tier2").not($this).prop({ disabled: true, checked: false });
            $(".Tier3, .Tier4, .Tier5").prop({ disabled: true, checked: false });
            $(".Tier1").prop("checked", true);
        }
        else {
            $(".Tier2").not($this).prop({ disabled: false, checked: false });
            $(".Tier3, .Tier4, .Tier5").prop({ disabled: false, checked: false });
            $(".Tier1").prop("checked", false);
        } 
    }
      else if($this.is(".Tier3")) {
      	if($this.is(":checked")){
            $(".Tier2").prop({ disabled: true, checked: false });
            $(".Tier1").prop({ disabled: true, checked: false });  
    	}
    	else {
            $(".Tier2").prop({ disabled: false, checked: false });
            $(".Tier1").prop({ disabled: false, checked: false});
        }
    }
       else if($this.is(".Tier4")) {
      	if($this.is(":checked")){
            $(".Tier2").prop({ disabled: true, checked: false });
            $(".Tier1").prop({ disabled: true, checked: false });
            $(".Tier4").not($this).prop({ disabled: true, checked: false });
 
    	}
    	else {
    		$(".Tier4").not($this).prop({ disabled: false, checked: false });
            $(".Tier2").prop({ disabled: false, checked: false });
            $(".Tier1").prop({ disabled: false, checked: false});
        }
    }
     /*else if($this.is(".Tier5")) {
      	if($this.is(":checked")){
            $('input[class^="Tier"]').not($this).not('.Tier4, .Tier3').prop({disabled: true, checked: false });
    	}
    	else {
            $('input[class^="Tier"]').prop({disabled: false, checked: false });
    	}
    }*/
});
	


		$('#<?php echo $formname ?>').validationEngine();
		

			$('#<?php echo $formname ?>').submit(function(e){

				e.preventDefault();

				var empty_inputs = false;

				$("form input").not('.optional').each(function(){
					if($(this).val() == ''){
						empty_inputs = true;
						console.log(empty_inputs);
					}
				});

				if(empty_inputs){

					alert("Please fill empty fields to continue.")
				}

				else {
		
						$.ajax({
							type: 'POST',
							url: '<?php echo site_url() . $save_url."/save" ?>',
							data: $('#<?php echo $formname ?>').serialize(),
							dataType: "json",
							success:function(response){
								if(response.status === "success"){

									//$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
									parent.$.fancybox.close();
									document.location.reload();	
								}
								else if(response.status === "error"){
										alert(response.message);
								}
							},
							error:function(){
							}
						})

				 	}

				})

	</script>

</html>