<html>
	<title>Change Password</title>
	<head></head>
	<!--body-->
		<form class = "methods" id = "<?php echo $formname ?>" >
		<!--fieldset-->
			<h3>Change Password</h3>
			<ul>
			<li>
			<fieldset>
				<legend>Change Password</legend>		
				<li>
					<label>
						<span>User Name</span>
						<input name="username" class ="validate[required]" value = "<?php echo $this -> session -> userdata('username') ?>" readonly type="text"  />
					</label>
				</li>
				<li>
					<label>
						<span>Password</span>
						<input name="pwd1" id = "pwd1" class ="validate[required]" type="password" title ="Password must contain at least a special character, a letter in Caps and a digit." />
					</label>
				</li>

				<li>
					<label>	
						<span>Confirm Password</span>
						<input name="pwd2" id = "pwd2" class ="validate[required, equals[pwd1]]" type="password" title ="Password must contain at least a special character, a letter in Caps and a digit." />
					</label>	
				</li>	
				<li>
					<label>
						<span id ="pwd_strength"></span>
					</label>	
				</li>
			</fieldset>
		</li>
		<li>
			<input name="submit-pwd" value= "Save" type="submit" id = "submit-pwd" class = "submit-button" />
		</li>
	</ul>
	</form>
		<script type="text/javascript">
			$('#changepwd').validationEngine();

			$('#changepwd').submit(function(e){
				e.preventDefault();
				if($('#pwd1').val() == $('#pwd2').val()){
					var pass = $('#pwd1').val()
					function scorePassword(pass) {
						    var score = 0;
						    if (!pass)
						        return score;

						    // award every unique letter until 5 repetitions
						    var letters = new Object();
						    for (var i=0; i<pass.length; i++) {
						        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
						        score += 5.0 / letters[pass[i]];
						    }

						    // bonus points for mixing it up
						    var variations = {
						        digits: /\d/.test(pass),
						        lower: /[a-z]/.test(pass),
						        upper: /[A-Z]/.test(pass),
						        nonWords: /\W/.test(pass),
						    }

						    variationCount = 0;
						    for (var check in variations) {
						        variationCount += (variations[check] == true) ? 1 : 0;
						    }
						    score += (variationCount - 1) * 10;

						    return parseInt(score);
					}
					var score = scorePassword(pass);
					if(score > 60){
					//if(md5($('#pwd2').val()) != '<?php echo $this -> session -> userdata('pwd'); ?>' ){
						$.ajax({
							type: 'POST',
							url: '<?php echo site_url() . $save_url."/changePwd/". $this -> session -> userdata('username') ?>',
							data: $('#<?php echo $formname ?>').serialize(),
							dataType: "json",
							success:function(response){
								if(response.status === "success"){

									//$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
									parent.$.fancybox.close();
									var url_segment;
										
									for(i=0;i<response.views.length;i++){
										if(response.views[i].User_type[0].id == response.utype){
											url_segment = response.views[i].User_type[0].view
										}
									}
									
									redirect_url = '<?php echo base_url() ?>' + url_segment
									parent.window.location.href = redirect_url
								

								}
								else if(response.status === "error"){
										alert(response.message);
								}
							},
							error:function(){
							}
					})
				  }
				  else{
				  	$('#pwd1, #pwd2').val('').attr('placeholder','e.g W*123ax');
				  	$('#pwd_strength').html('<span class = "show_error padded" >Weak Password</span>').fadeIn('slow').fadeOut('slow');

				  }
				}
			})

		</script>
	</html>	