<!-- Get Lab Ref Number, Worksheet Name, Test Id -->

<?php 
	$reqid = $this -> uri -> segment(3);
	$worksheet_name = $this -> uri -> segment(5);
	$test_id = $this -> uri -> segment(4);
 ?>

<html>
	<form id = "items" class = "method">
		<fieldset>
			<legend>Equipment</legend>
			<span><a id = "add_e" href = "#" data-table = "equipment" data-plchldr = "e.g Dry Fog Machine" class ="add" data-id = "e" data-unique = "e1" title = "Add New Equipment" >+</a></span>
			<ol data-id = "e">
				<li class = "item_list" id = "equipment">
					<label>
						<input type = "text" data-column = "name" id = "equipment" data-no = "1" class = "item_name" name = "e_name[]" data-column = "name" placeholder = "e.g Dry Fog Machine" />
						<input type = "hidden" class = "item_id" name = "e_id[]" id = "equipment_item" />
					</label>
				</li>

			</ol>			
			<span class = "e_details" ></span>
		</fieldset>	
		<fieldset>
			<legend>Reagents</legend>
			<span><a id = "add_r" href = "#" data-table = "reagents" data-plchldr = "e.g Methanol 2.5L" class ="add" data-id = "r" data-unique = "r1" title = "Choose Reagent" >+</a></span>
			<ol data-id = "r">
				<li class = "item_list" id = "reagents">
					<label>
						<input type = "text" id = "reagents" data-column = "name" data-no = "1" class = "item_name" name = "r_name[]" placeholder = "e.g Methanol 2.5L" />
						<!--input type = "text" name = "reagents_qty[]" placeholder = "e.g 50 " /-->
						<input type = "hidden" class = "item_id" name = "r_id[]" id = "reagents_item" />
					</label>
				</li>
			</ol>
		</fieldset>
		<fieldset>
			<legend>Standards</legend>
			<span><a id = "add_s" data-table = "refsubs" href = "#" data-plchldr = "e.g Aceclofenac" class ="add" data-id = "s" data-unique = "s1" title = "Choose Standard" >+</a></span>
			<ol data-id = "s">
				<li class = "item_list" id = "refsubs">
					<label>
						<input type = "text" id = "refsubs" data-column = "name" data-no = "1" class = "item_name" name = "s_name[]" placeholder = "e.g Methanol 2.5L" />
						<!--input type = "text" name = "standards_qty[]" placeholder = "e.g 50 " /-->
							<select name = "s_components[]">
								<?php foreach($components as $component) {?>
									<option value = "<?php echo $component -> name ?>"><?php echo $component -> name ?></option>	
								<?php }?>
							</select>
						<input type = "hidden" class = "item_id" name = "s_id[]" id = "refsubs_item" />
					</label>
				</li>
			</ol>
		</fieldset>
	</form>

<script type="text/javascript">
	$("#items").jWizard();

		$(function() {

				var i;

        
        $('.add').live('click', function() {
        		var table_n = $(this).attr("data-table");
        		console.log(table_n)
        		var column = $(this).attr("column");
        		var u_id = $(this).attr("data-id");	
        		var item_inputs = $('[name = '+u_id+'_name]');
        		var eqp = $(this).attr("data-plchldr");
        		var i = $('[name="'+u_id+'_name[]"]').length + 1;
        		var class_name = $(this).attr("data-class");
        		console.log(i);
        		
        		//If wizard is on any other tab other than the reference standards one, do not include the components select.
        		if(table_n == 'equipment' || table_n == 'columns' || table_n == 'reagents'){
                	$('<li><label for="'+u_id+'_name" id = "label'+i+'" ><input class = "items" type="text" id='+table_n+' data-uniq = '+table_n+i+' data-column = '+column+' data-no = '+i+'  size="20" name="'+u_id+'_name[]" placeholder="'+eqp+'" /><input type="hidden" data-no = '+u_id+i+' id="'+u_id+'_item" name="'+u_id+'_id[]" /></label><a href="#" class = "remove" id="remItem" data-no = "'+i+'" data-prefix = "'+u_id+'" data-uniq = "'+table_n+i+'" >&nbsp;&nbsp;-</a></li>').appendTo($('ol[data-id = "'+u_id+'"]'));
	            }
	            else{
	            	$('<li><label for="'+u_id+'_name" id = "label'+i+'" ><input class = "items" type="text" id='+table_n+' data-uniq = '+table_n+i+' data-column = '+column+' data-no = '+i+'  size="20" name="'+u_id+'_name[]" placeholder="'+eqp+'" /><select name = "'+u_id+'_components[]"><?php foreach($components as $component) {?><option value = "<?php echo $component -> name ?>"><?php echo $component -> name ?></option>	<?php }?></select><input type="hidden" data-no = '+u_id+i+' id="'+u_id+'_item" name="'+u_id+'_id[]" /></label><a href="#" class = "remove" id="remItem" data-no = "'+i+'" data-prefix = "'+u_id+'" data-uniq = "'+table_n+i+'" >&nbsp;&nbsp;-</a></li>').appendTo($('ol[data-id = "'+u_id+'"]'));
				}	

				/*if(table_n != 'equipment' && table_n != 'columns'){
	            			$('&nbsp;&nbsp;<input type = "text" data-uniq = "'+table_n+i+'" placeholder = "Quantity e.g 50g / 50ml" name = "'+table_n+'_qty[]" >').insertAfter('input[data-uniq = "'+table_n+i+'"]');
	            		}*/	
               		$('[data-no="'+i+'"]').autocomplete({
								source: function(request, response) {
									console.log(request);
									$.ajax({
									url: "<?php echo site_url('chroma_conditions/suggestions'); ?>" + "/" + $('[name="'+u_id+'_name[]"]').attr('id') + "/" + $('[name="'+u_id+'_name[]"]').attr('data-column') + "/" + $('[name="'+u_id+'_name[]"]').attr('data-no') ,
									data: { term: request.term},
									dataType: "json",
									type: "POST",
									success: function(data){
										response(data);
									}
								});
							},
							minLength: 2,
							select: function(e, ui){
								var table_name =  $(this).attr('id');
								console.log(table_name)
								var html_array = table_name +"_info";
								var html_array = [];
								var hidden_input_counter = i - 1;
								console.log(table_name)
								$.getJSON("<?php echo site_url('chroma_conditions/getItems'); ?>" + "/" + ui.item.value + "/" + $('[name="'+u_id+'_name[]"]').attr('id') ,function(items){
									var details_array = items;
									//console.log(details_array);
									for(var j = 0; j < details_array.length; j++){
											var object = details_array[j];

												if(table_name == 'equipment'){
		 											html_array.push("<option value = "+object["id"]+">"+object["serial_no"]+"-"+object["model"]+"-"+object["nqcl_no"]+"</option>")
												}
												else if(table_name == 'reagents'){
													html_array.push("<option value = "+object["id"]+">"+object["batch_no"]+"-"+object["manufacturer"]+"</option>")
												}
												else if(table_name == 'refsubs' ){
													html_array.push("<option value = "+object["id"]+">"+object["rs_code"]+"-"+object["batch_no"]+"-"+object["source"]+"</option>")
												}

											for(var key in object){
												var attrName = key;
												var attrValue = object[key];
													switch(attrName) {
													case 'id':
													$('[data-no = '+u_id+hidden_input_counter+'][type = "hidden"]').val(attrValue);
													break;
												}
											}				
										}
										
										console.log(html_array)
										
										//Insert select containing selected suggestion options after corresponding text input
										if($('select[name = "'+table_name+'_select[]"][id = "select_'+hidden_input_counter+'"]').length == 0){
											console.log($('<select name = "'+table_name+'_select[]" id = "select_'+hidden_input_counter+'" ></select>').html(html_array).insertAfter('input[id = "'+table_name+'"][data-uniq = "'+table_name+hidden_input_counter+'"]'));
											console.log($(".items").after(" "));
										}
										else{
											console.log($('select[name = "'+table_name+'_select[]"][id = "select_'+hidden_input_counter+'"]').html(html_array).insertAfter('input[id = "'+table_name+'"][data-uniq = "'+table_name+hidden_input_counter+'"]'));
										}
									})
								},
					        Delay : 200
							})

            			 i++;
                //return false;
        });



        
        $('.remove').live('click', function() { 
             var data_uniq = $(this).attr("data-uniq");
             var data_no = $(this).attr("data-no");
             var table_prefix = $(this).attr("data-prefix");
                       $(this).parent().remove();
                       console.log($('[type = "hidden"][data-no ="'+table_prefix+data_no+'"],[data-uniq2 = "'+data_uniq+'"]').remove());
                       //console.log($(this).parent());
                        i--;
                
                return false;
        });



		
		//$().on("autocomplete", )
	//function AutoC(){
		$('[data-no = "1"]').autocomplete({
			source: function(request, response) {
				$.ajax({
				url: "<?php echo site_url('chroma_conditions/suggestions'); ?>" + "/" + $(this.element).attr('id') + "/" + $(this.element).attr('data-column'),
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
			var html_array = table_name +"_info";
			var html_array = [];
			console.log(table_name)
			$.getJSON("<?php echo site_url('chroma_conditions/getItems'); ?>" + "/" + ui.item.value + "/" + $(this).attr('id') , function(items){
				var details_array = items;
				//console.log(details_array);
				for(var i = 0; i < details_array.length; i++){
						var object = details_array[i];

						//Depending on table, define parameters to be used to construct select statement
							if(table_name == 'equipment'){
		 						html_array.push("<option value = "+object["id"]+">"+object["serial_no"]+"-"+object["model"]+"-"+object["nqcl_no"]+"</option>")
							}
							else if(table_name == 'reagents'){
								html_array.push("<option value = "+object["id"]+">"+object["batch_no"]+"-"+object["manufacturer"]+"</option>")
							}
							else if(table_name == 'refsubs' ){
								html_array.push("<option value = "+object["id"]+">"+object["rs_code"]+"-"+object["batch_no"]+"-"+object["source"]+"</option>")
							}

						//Foreach object in array assign element to variable*
						for(var key in object){
							var attrName = key;
							var attrValue = object[key];
							//console.log(object["id"])
								switch(attrName) {
								case 'id':
								$('[id = '+table_name+'_item]').val(attrValue);
								break;
							}
						}				
					}
					//Insert select containing selected suggestion options after corresponding text input


					//if the select exists, replace options else add new select

					if($('select[name = "'+table_name+'_select[]"][id = "select_1"]').length == 0){
						$('&nbsp;&nbsp;<select name = "'+table_name+'_select[]" id = "select_1"></select>').html(html_array).insertAfter('input[id = "'+table_name+'"][data-no = "1"]');		
						$(".item_name").after(" ");
					}
					else{
						$('select[name = "'+table_name+'_select[]"][id = "select_1"]').html(html_array).insertAfter('input[id = "'+table_name+'"][data-no = "1"]');		
					}
				})
			},
        Delay : 200
		})
	   //}
	   //AutoC();	
	})


$('#items').submit(function(e){
e.preventDefault();
var href = '<?php echo base_url() . "chroma_conditions/save_items/" . $reqid ."/".$test_id ?>';
console.log(href);
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url() . "chroma_conditions/save_items/" . $reqid ."/".$test_id ?>',
		data: $('#items').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
				//$.parent.fancybox.close();
				//var wksht_url = '<?php echo base_url().$worksheet_name."/"."worksheet"."/".$reqid."/".$test_id ?>'
				var this_page = '<?php echo base_url()."analyst_controller" ?>'
				//console.log(wksht_url)
				parent.document.location = this_page;
			}

			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

})

</script>
</html>