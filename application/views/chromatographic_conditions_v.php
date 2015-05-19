<html style = "overflow-x: hidden">
	<title>Add Column</title>
	<head></head>
	<form class = "methods" id = "<?php echo $formname ?>" >
			<ul>
				<li>
					<fieldset>
						<legend>Choose Column</legend>
						<li>
							<?php if($test_id == "2"){  ?>
								<label>
									<span>Same as Assay</span>
									<input  id = "same_as_assay" name = "same_column" type = "checkbox" title = "Check if same column used in assay."  value = "1"  />
								</label>
								<hr>
							<?php }?>
							
							<label>
								<span>Column No.</span>
								<input type="text" id = "columns" data-column = "name" name="columns" class = "validate[required]" placeholder = "Column Number e.g 89" />
							</label>
						</li>
					</fieldset>
				</li>
				<li>
					<fieldset>
						<legend>Column Details</legend>
							<ul class = "smalltext" id = "column_detail_list" ></ul>
					</fieldset>
				</li>
				<li>
					<fieldset>
						<legend>Conditions</legend>			
						<li>
							<label>
								<span>Column Temp (ºC)</span>
								<input type="text" name="column_temp" class = "validate[required]" />
							</label>
						</li>
						<li>
							<label>
								<span>Detection λ (nm)</span>
								<input type="text" name="detection"  class = "validate[required]" />
							</label>
						</li>
						<li>
							<label>
								<span>Injection Vol (μL)</span>
								<input type="text" name="injection" class = "validate[required]"  />
							</label>
						</li>
						<li>
							<label>
								<span>Flow Rate (mL/min)</span>
								<input type="text" name="flow_rate" class = "validate[required]" />
							</label>
						</li>
						<li>
							<label>
								<span>Pump Pressure (bars)</span>
								<input type="text" name="pump_pressure" class = "validate[required]"  />
							</label>
						</li>
					</fieldset>
				</li>
				<li>
					<fieldset>
						<legend>Mobile Phase</legend>
							<label>
								<span>Details</span>
								<textarea name = "mobile_phase" class = "validate[required]" ></textarea>
							</label>
					</fieldset>
				</li>
						<input name = "request_id" type = "hidden" value = "<?php echo $reqid ?>" >
						<input name = "test_id" type = "hidden" value = "<?php echo $test_id ?>" >
						<input id = "column_id" name = "column_id" type = "hidden" >
			</li>
			<li>
				<input id = "submit" type = "submit" class = "submit-button leftie" value = "Save" >
			</li>
			</ul>
	</form>

	<script type="text/javascript">
	
	
	//If same as column used in assay checked
	$('#same_as_assay').on("change", function(){
		if(this.checked){
			
			//Assay Column Url
			assay_id = 5;
			assay_column_url = '<?php echo base_url()."chroma_conditions/getAssayColumn/".$reqid."/"?>' + assay_id
			
			//Check column used in assay
			$.ajax({
				type:'GET',
				url:assay_column_url
			}).done(function(response){
				//Convert returned JSON string to a JSON Object
				r = JSON.parse(response);
				
				//Check if success/error returned
				if(r.status == 'success'){
		
					//Initialize column info array
					var column_info2 = [];
					
					//Set column no.s and column ids
					column_no = r.details[0].column_no
					column_id = r.details[0].id
					serial_no = r.details[0].serial_no
					
					$('#columns').val(column_no)
					$('#column_id').val(column_id)
				
					//Push serial number into html array
					column_info2.push("<li>serial_no:<b>"+serial_no+"</b></li>");
				
					//Iterate through column types array, populate html array, append to column info list
					$.each(r.details[0].column_types, function(key, value){
						if(key != 'id'){
							column_info2.push("<li>"+key+":<b>"+value+"</b></li>")
						}
					})
					
					//Make column details visible by setting to html
					$('#column_detail_list').html(column_info2);
					
					//Set mobile phase and conditions 
					$.each(r.conditions[0], function(key, value){
						if(key != 'id'){
							$("[name="+key+"]").val(value);
						}
					})
				}
				else{
					noty({
						text: response.details,
						type: 'warning',
						modal:false,
						timeout:false
					})
				}
			}).error(function(){
			})
			
		}
		else{
		
			//Unset values on unchecking 'Same as Assay'
			
			//$('#columns').val('')
			//$('#column_id').val('');
			$('#column_detail_list').html('');
			//$('.conditions').val('');
			$('#<?php echo $formname; ?> input').val('');
			$('#<?php echo $formname; ?> textarea').text('');
		}
	})

	//Validate with Validation Engine (JS)
	$('#<?php echo $formname ?>').validationEngine({
		promptPosition : "topRight",
		'custom_error_messages' :{
			'required':{
				'message':"* Required."
			}
		},
		autoPositionUpdate:true,
		scroll:false
	});

	//Save
	$('#<?php echo $formname ?>').submit(function(e){
		e.preventDefault();

		//Check for empty inputs
		var inputs = $("#<?php echo $formname ?>").find('input').not(':hidden').filter(function(){
			return this.value === "";
		});


		//If there are empty inputs alert, if there are no such inputs go ahead with ajax submit
		if(inputs.length) {
			
			//Use Noty to notify user of empty fields
			noty({ 
				text: 'Please populate all fields.',
                type: 'warning',
                timeout: true,
                    animation: {
        				open: {height: 'toggle'},
        				close: {height: 'toggle'},
        				easing: 'swing',
        				speed: 1500 
    				}
            });

		}
		
		else {

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url() . $save_url."/save/" ?>',
			data: $('#<?php echo $formname ?>').serialize(),
			dataType: "json",
				success:function(response){
					if(response.status === "success"){
						//parent.$.fancybox.close();
						$('#submit').remove();
						var wksht_url = '<?php echo base_url().$worksheet_name."/"."worksheet"."/".$reqid."/".$test_id ?>'
						var this_page = '<?php echo base_url()."analyst_controller" ?>'
						console.log(this_page)
						parent.document.location = this_page;
						
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

	//Autocomplete column no. and feed other details into respective inputs 
		$('#columns').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
				url: "<?php echo site_url('chroma_conditions/suggestions'); ?>" + "/" + $(this.element).attr('id') + "/" + "column_no",
				data: { 
					term: request.term,
					featureClass: "P",
                    style: "full",

				},
				dataType: "json",
				type: "POST",
				success: function(data){
					response($.map(data, function(item){
						var label = item;
						console.log(label);
						return{
							label:item
						}
					}));
				}
			});
		},
		minLength: 2,
		select: function(e, ui){
			var table_name =  $(this).attr('id');
			var column_info = [];
			console.log(table_name)
			$.getJSON("<?php echo site_url('chroma_conditions/getItems'); ?>" + "/" + ui.item.value + "/" + $(this).attr('id') , function(items){
				var details_array = items;
				//console.log(details_array);
				for(var i = 0; i < details_array.length; i++){
						var object = details_array[i];
						for(var key in object){
							var attrName = key;
							var attrValue = object[key];


							//Set column id
							switch(attrName) {
								case 'id':
								$('#column_id').val(attrValue);
								break;
							}

							//Filter columns to be shown at column details
							 if(key == 'serial_no') {
								column_info.push("<li>"+key+": "+attrValue+"</li>")
							}
							//Include information from the column types table.
							else if(key == 'column_types'){
								$.each(attrValue, function(key, value){
									if(key != 'id'){
										column_info.push("<li>"+key+": "+value+"</li>")
									}
								})
							}

						}				
					}
					$('#column_detail_list').html(column_info);		
				})
			},
        Delay : 200
		})
	</script>

</html>