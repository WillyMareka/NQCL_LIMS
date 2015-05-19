<html>
<body>
	<form id = "systems_wizard" >
	<?php foreach($multi_tests as $id => $test_name) { ?>
		<?php if(in_array($id, $tests_checked)) { ?>   
			<fieldset>
					<legend><?php echo $test_name ?></legend>
					<span class = "smalltext" >Choose System for <?php echo $test_name ?></span>
					<hr>
					<ul class = "no_style">
						<li><input type = "radio" name = "system_<?php echo $id; ?>" value = "1" >Batch</li>
						<li><input type = "radio" name = "system_<?php echo $id; ?>" value = "2" >Individual</li>
					</ul>
					<?php if($id == '2') {?>
					<span class = "smalltext" >Enter no. of stages.</span>
					<hr>
					<label><span>No. of Stages</span>
					<input name = "no_of_stages" type = "text" >
					</label>
					<?php } ?>	
			</fieldset>
	<?php } } ?>
			<fieldset>
				<legend>Save</legend>
			</fieldset>		
	</form>
	<script type="text/javascript">
		
		//Have wizard to loop through Assay and Dissolution
		$("#systems_wizard").jWizard({
				menu:false,
				finishButtonType: 'submit'		
		});

			//On submitting the wizard form
			$('#systems_wizard').submit(function(e){
				e.preventDefault();
				$('.fancybox-inner').unwrap();
					var systems_href = '<?php echo base_url()."quotation/updateSystem/$reqid/$table/$table2/$table3/$client_id" ?>';
					var table = '<?php echo $table; ?>';
				//POST via ajax
				$.ajax({
					type:'POST',
					url: systems_href,
					data:$("#systems_wizard").serialize(),
					dataType:"json"
					}).done(function(response){
						console.log(table);
						if(table != 'invoice'){
							href = '<?php echo base_url()."client_billing_management/showBillPerTest/$reqid/$table/$table2/$table3/$client_id" ?>'
								parent.$.fancybox.open({
		                            href:href,
		                            type: 'iframe',
		                            autoSize:false,
		                            autoDimensions:false,
		                            width:700,
		                            height:490,
		                            'beforeClose':function(){
		                                //getData();
		                            }
	                         })
						}
						else{
							parent.$.fancybox.close();
						}
					}).fail(function(response){
						console.log(response);
					})
				})



	</script>
	</body>
</html>