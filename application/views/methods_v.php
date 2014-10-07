<html>
	<form id = "methods_wizard" >	   
		<fieldset>
				<legend>State components</legend>
					<table id = "multicomponent_table">
						<tr><td><label>Single Component</label></td><td><input type = "radio" name ="multicomponent" value = "0"  /></td></tr>
						<tr id = "multicomponent" ><td><label>Multi Component</label></td><td><input type = "radio" name ="multicomponent"  value = "1" /></td></tr>
					</table>
		</fieldset>
		
		<fieldset>
			<legend>Save Components</legend>
		</fieldset>
	
</form>

	<script type = "text/javascript" >
		$(function(){


			//If test is not dissolution, disable checkbox, set title to alert user. 	
			$('input[name ="multistage"]').filter(".disable_checkbox").attr("disabled", true); 
			$('input[name ="multistage"]').filter(".disable_checkbox").attr("title", "Applicable for Dissolution only.");
			console.log($('input[name ="multistage"]').filter(".disable_checkbox").length)
			
			
			$('.jw-button-next').on("click", function(){
							console.log();

				})
			
			$("#methods_wizard").jWizard({
				menu:false,
				finishButtonType: 'submit'		
			});


			$(".add_component_a").live("click", function(){	
				console.log($(this).parent().parent());
				var c_no = $('tr[class = "added_multicomponents"]').length;
				$(this).parent().parent().attr("id", 'component'+c_no);

				if($(this).text() == '+'){
					console.log(c_no)	
					$(this).parent().parent().clone().appendTo("#multicomponent_table");
					//$("#methods_div").remove();
					//$("<div title = 'Choose method for Component "+c_no+"'></div>").insertAfter("#multicomponent_div");
					$(this).text('-');
				}
				else{
					$('tr[id = "component'+c_no+'"]').remove();
					console.log(c_no)	
					$(this).text('+');
					}
			})


			
			//On clicking Multicomponent provide input to enter Number of Components
			$("[name = 'multicomponent']").on("click", function(){
				
				if($(this).is(':checked') && $(this).val() == 1){
					if($('#addcomponents').length == 0){
						$('.addsinglecomponents, .added_singlecomponent').remove();	
						$("#multicomponent_table").append('<tr class = "added_multicomponents" ><td class = "addcomponents"><span>Each&nbsp;</span><input size = "4" type ="text" placeholder = "e.g 200" title = "Volume of Component" name ="volume1[]" />&nbsp;<select name = "unit1[]" ><option value = "ml" >ml</option><option value = "gm" >g</option><option value = "mg" >mg</option><option value = "vial" >vial</option><option value = "tablet" >Tablet</option><option value = "capsule" >Capsule</option><option value = "sachet" >sachet</option></select>&nbsp;contains&nbsp;<input type ="text" size = "4" placeholder = "e.g 200" title = "Weight/Volume/Density" name ="volume2[]" />&nbsp;<select name = "unit2[]" ><option value = "mg" >mg</option></select>&nbsp;of&nbsp;<input  name = "component[]" placeholder = "e.g Ritonavir" title = "Name of Component" title = "Name of Component" /></td><td id = "add_button_td"><a class = "add_component_a" href="#" title = "Add Component" >+</a></td></tr>');
					}
				}
				else if ($(this).val() == 0) {
						$('.addcomponents, .added_multicomponents').remove();
						$("#multicomponent_table").append('<tr class = "added_singlecomponent" ><td class = "addsinglecomponent"><span>Each&nbsp;<input size = "4" type ="text" placeholder = "e.g 200" title = "Volume of Component" name ="volume1[]" />&nbsp;<select name = "unit1[]"><option value = "ml">ml</option><option value = "mg">mg</option><option value = "g" >g</option><option value = "vial" >vial</option><option value = "tablet" >tablet</option><option value = "capsule" >capsule</option><option value = "sachet" >sachet</option></select>&nbsp;contains&nbsp;<input type ="text" size = "4" placeholder = "e.g 100" title = "Weight/Volume/Density" name ="volume2[]" />&nbsp;<select name = "unit1[]" ><option value = "mg" >mg</option></select>&nbsp;of&nbsp;<input    name = "component[]" placeholder = "e.g Atanazavir" title = "Unit e.g Atanazavir" title = "Name of Component" /></td></tr>');
					}
			})



			//On checking Multistage provide input to enter Number of Stages
			$("[name = 'multistage']").on("click", function(){
				if($(this).is(':checked')){		

					console.log($(this).val());

					if($("#addmultistage").length == 0 ){
						$('<td id = "addmultistage" ><input type ="text" name = "multistage_no" placeholder = "No. of Stage e.g 3" class = [validate = "required"] /></td>').appendTo("tr[id = 'multistage']");
					}	
				}

				else {
				
					$('#addmultistage').remove();

				}
			})
			
			//On submitting the wizard form
			$('#methods_wizard').submit(function(e){
				e.preventDefault();
				$('.fancybox-inner').unwrap();
					var methods_href = '<?php echo base_url()."request_management/showComponents/$reqid/$test_id" ?>'
					var redirect_href = '<?php echo base_url()."chroma_conditions/" ?>' + $("[name='method']").val();
					var components_href = '<?php echo base_url()."request_management/setComponents/$reqid/$test_id"?>';
				console.log(methods_href);
				console.log(components_href);
				$.ajax({
					type:'POST',
					url: components_href,
					data:$("#methods_wizard").serialize(),
					dataType:"json"
					}).done(function(response){
						methodsData = $.parseJSON(response.array);
						console.log(methodsData.multicomponent);
						parent.$.fancybox({
							href:methods_href + "/" + methodsData.multicomponent,
							type:'iframe',
							autosize:true,
							beforeClose:function(){
								//Close fancyBox and redirect to Method Worksheet
								$('.fancybox-inner').unwrap();
								href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text(); + "/" + $('#test_id').text() ;
								//window.location.href = href1;
								}	
							})
					}).fail(function(response){
							
							console.log(response);
					})
					
				//window.location.href = redirect_href;
				
			})
			
		})
	</script>
</html>