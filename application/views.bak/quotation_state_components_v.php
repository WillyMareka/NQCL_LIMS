<html>
<form id = "methods_wizard" class = "methods" >
	<h3><?php if($table == "request" && $proforma_no > 0 ){ echo "Proforma No. & Components"; } else { echo "Component Status"; } ?></h3>
	<ul>
		<?php if($table == "request" && $proforma_no > 0) { ?>
		
			<li>	   
				<fieldset>
						<legend>Select Proforma No.</legend>
						<select name = "proforma_no">
							<option value = "New" >New</option>
							<?php foreach($proforma_nos as $p_no) { ?>
								<option value = "<?php echo $p_no['proforma_no'] ?>" ><?php echo $p_no['proforma_no'] ?></option>
							<?php } ?>
						</select>
				</fieldset>
			</li>
		<?php  } ?>
		<li>	   
			<fieldset>
					<legend>State components</legend>
						<table id = "multicomponent_table">
							<tr><td><label>Single Component</label></td><td><input type = "radio" name ="multicomponent" value = "0"  /></td></tr>
							<tr id = "multicomponent" ><td><label>Multi Component</label></td><td><input type = "radio" name ="multicomponent"  value = "1" /></td></tr>
						</table>
			</fieldset>
		</li>
		<li>
			<input value = "Save" type = "submit" class = "submit-button leftie" >
		</li>
	</ul>
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
			
			$("#methods_wizards").jWizard({
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
						$("#multicomponent_table").append('<tr class = "added_multicomponents" ><td class = "addcomponents"><input name = "component[]" placeholder = "e.g Ritonavir" title = "Name of Component" title = "Name of Component" /></td><td id = "add_button_td"><a class = "add_component_a" href="#" title = "Add Component" >+</a></td></tr>');
					}
				}
				else if ($(this).val() == 0) {
						$('.addcomponents, .added_multicomponents').remove();
						$("#multicomponent_table").append('<tr class = "added_singlecomponent" ><td class = "addsinglecomponent"><input name = "component[]" placeholder = "e.g Atanazavir" title = "Unit e.g Atanazavir" title = "Name of Component" /></td></tr>');
					}
			})
			
			//On submitting the wizard form
			$('#methods_wizard').submit(function(e){
				e.preventDefault();
				$('.fancybox-inner').unwrap();
					var redirect_href = '<?php echo base_url()."chroma_conditions/" ?>' + $("[name='method']").val();

					//Assign POST action href to variable below
					var components_href = '<?php echo base_url()."quotation/setComponents/$reqid/$table/$table2/$table3/$client_id"?>';

					//Console log the components href
					console.log(components_href);

					//Assign url to redirect to after successful submit
					var methods_href = '<?php echo base_url()."tests_management/testsMethodsWizard/$reqid" ?>' + "/" + "<?php echo $table; ?>" + "/" + "<?php echo $table2; ?>" + "/" + "<?php echo $table3; ?>" + "/" + "<?php echo $client_id; ?>";

					console.log(methods_href);
					
					//POST via ajax
				$.ajax({
					type:'POST',
					url: components_href,
					data:$("#methods_wizard").serialize(),
					dataType:"json"
					}).done(function(response){
						console.log(methods_href);
						parent.$.fancybox({
							href:methods_href,
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