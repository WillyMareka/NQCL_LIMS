<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NQCL Login</title>
<link href="<?php echo base_url().'CSS/style.css'?>" type="text/css" rel="stylesheet"/>

<?php if(isset($script_urls)){
foreach ($script_urls as $script_url){
echo "<script src=\"".$script_url."\" type=\"text/javascript\"></script>";
}
}?>

<?php if(isset($scripts)){
foreach ($scripts as $script){
echo "<script src=\"".base_url()."Scripts/".$script."\" type=\"text/javascript\"></script>";
}
}?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

 
<?php if(isset($styles)){
foreach ($styles as $style){
echo "<link href=\"".base_url()."CSS/".$style."\" type=\"text/css\" rel=\"stylesheet\"></link>";
}
}?> 
<style type="text/css">
#signup_form{ 
background-color:whiteSmoke; 
border: 1px solid #E5E5E5;
padding: 20px 25px 15px;
width:500px;
margin:0 auto;
}
#signup_form input[type="submit"] {
margin: 0 1.5em 1.2em 0;
height: 32px;
font-size: 13px;
}
#signup_form label{
display: block;
margin: 0 auto 1.5em auto;
width:300px;
 
}
.label {
font-weight: bold;
margin: 0 0 .5em;
display: block;
-webkit-user-select: none;
-moz-user-select: none;
user-select: none;
}
.remember-label {
font-weight: normal;
color: #666;
line-height: 0;
padding: 0 0 0 .4em;
-webkit-user-select: none;
-moz-user-select: none;
user-select: none;
}
#system_title{ 
	position: absolute;
	top: 40px;
	left: 110px;
	text-shadow: 0 1px rgba(0, 0, 0, 0.1);
	letter-spacing: 1px;
}

</style>
</head>

<body>
<div id = "content_view" >
<div id="wrapper">
	<div id="top-panel" style="margin:0px;">

		<div class="logo">
<a class="logo" href="<?php echo base_url();?>" ></a> 

</div>
<div id="system_title">
<span style="display: block; font-weight: bold; font-size: 13px; margin:2px;">Ministry of Health</span>
 <span style="display: block; font-size: 11px;">National Quality Control Laboratory (NQCL)</span> 
</div>
 
</div>

<div id="inner_wrapper"> 


<div id="main_wrapper"> 

 
 <div align="center">
 	<?php
echo validation_errors('
<p class="error">','</p>
'); 
if(isset($invalid)){
	echo "<p class='error'>Invalid Credentials. Please try again</p>";
}
else if(isset($inactive)){
	echo "<p class='error'>The Account is not active. Seek help from the Administrator</p>";
}
?>

 </div>

<div id="signup_form">
	 <div class="short_title" >
<h1 class="banner_text" >Sign in</h1>
</div>

<form id = "login" >
<label id = "errors" ></label>
<label>
	<strong class="label">Username</strong>
	<input type="text" name="username" id="username" value="">
</label>
<label  id = "available" ></label>
<label  id = "unavailable" ></label>
<div class = "hidden2" id = "role-select-div" >
	<label>
		<strong class = "label" >Role</strong>
		<select name = "usertype" id = "role-select" ></select>
	</label>
</div>
<label>
	<strong class="label">Password</strong>
	<input type="password" name="password" id="password">
</label>

<input type="submit" class="button" name="register" id="register" value="Sign in" style="margin-left:100px;">
</form>
</div>

</div>  

  <!--End Wrapper div--></div>
    <div id="bottom_ribbon">
        <div id="footer">
 <?php $this->load->view("footer_v");?>
    </div>
    </div>
    </div>
</body>


<script type="text/javascript">
	$("#username").blur(function(){
	username = $(this).val();
	if(username){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url("user_management/usernameCheckAvailability"); ?>' + "/" + username ,
				dataType:"json"						
			}).done(function(response){
				//console.log(response)
				if(response.status == "non-existent" || username == ''){
					if(!$('#unavailablespan').length){
						$("<span id ='unavailablespan' class = 'misc-title small-text padded show_error' >X&nbsp;"+response.message+"</span>").appendTo('#unavailable');
					}
						$('#unavailable').slideUp(300).delay(200).fadeIn(4000).fadeOut('slow');
					
						$('.roleOptions').remove();

						$('#role-select-div').toggle(false);

						
					}
					else if(response.status == 'existent'){		

						$('.roleOptions').remove();

						$('#role-select-div').toggle(false);

						if(!$('#availablespan').length){
	
							$("<span id ='availablespan' class = 'misc-title small-text padded show_ok hidden2' >&#10003;&nbsp;"+response.message+"</span>").appendTo('#available').slideUp(300).delay(200).fadeIn(5000).fadeOut('4000');;
					    }
					    else{
							$("<span id ='availablespan' class = 'misc-title small-text padded show_ok hidden2' >&#10003;&nbsp;"+response.message+"</span>").appendTo('#available').slideUp(300).delay(200).fadeIn(5000).fadeOut('4000');
					    }

					    $.ajax({
					    	type:'POST',
					    	url:'<?php echo site_url("user_management/getUserTypes"); ?>' + "/" + username ,
					    	dataType:"json"
					        }).done(function(response){
					        	//console.log(response);
					        		for(i=0;i<response.length;i++){
					        			console.log(response[i].User_type[0].name)
					        				$('<option value = '+response[i].User_type[0].id+' class ="roleOptions" >'+response[i].User_type[0].name+'</option>').appendTo('#role-select');
					        		}
						        		if(response){
						        			$('#role-select-div').toggle(true);
						        		}
						        		else{
						        			$('#role-select-div').toggle(false);
						        		}
					        			
					        })
					 
					}
				}).fail();

		}	
})

$('#login').submit(function(e){
	e.preventDefault();

$.ajax({
		type: 'POST',
		url: '<?php echo site_url("user_management/test_login") ?>',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
				if(response.pwd_status == '1'){
						url = '<?php echo base_url()?>' + response.view
						document.location = url;	
				}
				else if(response.pwd_status == '0'){
					//$('.edit').live("click",function(e){
						//e.preventDefault();
						var href = '<?php echo base_url()."user_management/pwd_fancybox" ?>' +  "/"
						console.log(href);
						$.fancybox.open({
							href : href,
							type: 'iframe',
							autoSize: false,
							autoDimensions : false,
							width:400,
							height: 270
							//'beforeClose' : function(){
							//	getData();
							//}
						});
						return(false);
					//})

					}
					else if(response.pwd_status === 'acc_deactivated'){
						//$('<span class = "misc-title small-text padded show_error" >'+response.message+'</span>').appendTo('#errors');
						console.log(response.message)
					}	
						
				}
				else if(response.status === "acc_deactivated"){
					$('<span id = "deactiv_error" class = "misc-title small-text padded show_error" >'+response.message+'</span>').appendTo("#errors").fadeOut(6000);
				}
				else if(response.status === "wrong_pwd_usrnm"){
					$('<span id = "wrong_pwd_usrnm" class = "misc-title small-text padded show_error" >'+response.message+'</span>').appendTo("#errors").fadeOut(6000);
					console.log(response.message)
				}
		},
		error:function(){
		}
	})
})

</script>



</html>
