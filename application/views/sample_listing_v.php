<html>
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url()."javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js"?>"></script>
	

<legend><a href="<?php echo base_url(); ?>" >Home</a>&nbsp;<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];} else{ echo site_url('request_management');}  ?>" >&larr;Back</a>&nbsp;&rarr;&nbsp;Samples Listing</legend>
<hr />

<div class="rightside">
<table>	
<tr class="" >	
<td><span class="misc_title">Split Key:</span></td><td class="splitalert5 centertext"><span>Split - None Assigned</span></td>
<td class="splitalert6 centertext"><span>Split - Assign Pending </span></td>
</tr>
</table>
</div>





<table>
	<tr><span class="misc_title">&nbsp;Filter:</span></tr>
	<tr id="sortby_tr">
			<td id="select_param_td">
				<select id="sample_filter" >
				<option id="default" value="0" selected>None</option>
				<!--option id="active_ing" value="1">Active Ingredient</option-->
				<option id="priority" value="2">Priority</option>
				<option id="split_status" value="3">Split Status</option>
				<!--option id="client_name" value="4">Client Name</option-->
			</select>
		</td>
		</tr>
</table>
	

<!--table><tr><td colspan="7"><hr /></td></tr></table-->
<div>
	<table id="tests2" class="sample_listing">
	<thead>
		<tr id="samples_l_th">
			<th><a id="lab_r" href="#" >Lab Reference Number</a></th>
			<th><a id="priority" href="#" >Priority</a></th>
			<!--th><a id="split_s" href="#" >Split Status</a></th-->
			<th><a id="active_i" href="#" >Active Ingredient</a></th>
			<th><a id="prod_n" href="#" >Product Name</a></th>
			<th><a id="client_n" href="#" >Client Name</a></th>
			<th><a id="date_s" href="#" >Date Submitted</a></th>
			<th><span>Edit</span></th>
			<th>Assign</th>
		</tr>
	</thead>
	<tbody>	
		<?php foreach ($sample_listing as $listing) {
			
			$cl_id = $listing -> client_id ;
			$clientnames = Clients::getNames($cl_id);
			$clientname = $clientnames[0]['Name'];
			
			$reqid = $listing -> request_id;
		    $departments = Departments::getDepartments($reqid);
			$analysts = User::getAnalysts($reqid);
		
			$attributes = array('id' => 'entry_form');
			echo form_open('sample_issue/save/'. $reqid,$attributes);
			echo validation_errors('
			<p class="error">', '</p>');
		
		   $tests_arrays = Request_details::getTests($reqid);
		   
		   $testcounts = Request_details::testsCount($reqid);
			
		   $status_check = Sample_issuance::getStatus2($reqid);
		   
		   $split_pending = Sample_issuance::getSplits($reqid);
		   
		   //$sampleinfo = Sample_information::getLabRef($reqid);
		   
		  //var_dump($sampleinfo[0]['version_id']);
		   
		   
		   $units = Tests::getUnit2($reqid);
		   
		   //var_dump(count($units))	;
	
		   $status = $status_check[0]['Status_id'];
		   
		   //$split_status = $status_check[0]['Split_status'];
		   
		   $dept_id = $status_check[0]['Department_id'];
	
		   if($status != 2 || (count($split_pending) != count($units) ) ) {
		
		   ?>

		<tr class="sample_listing_tr <?php 
				if(count($units) > 1 && count($split_pending) < 1 ) {
					echo "splitalert";
			}
			
				else if(count($split_pending) >= 1)
				{
					echo "splitalert3";
				}
				
				else{
					
					echo "nosplit";
				}
			
			?>">
			
			<td><span><?php echo $listing -> request_id ?></span></td>
			<td class="priority"><span  id="<?php if($listing -> Urgency == 1){echo "splitalert2";}?>"><?php if($listing -> Urgency == 1){echo "High";}
		   else{
		   	echo "Low";
		   }
			 ?></span></td>
			<td class="activeing"><span><?php echo $listing -> active_ing ?></span></td>
			<td><span><?php echo $listing -> product_name ?></span></td>
			<td class="clientn"><span><?php echo $clientname ?></span></td>
			<td><span><?php echo date('d-M-Y', strtotime($listing -> Designation_date)) ?></span></td>
			<input type="hidden" id="lab_ref_no" name="lab_ref_no" value= "<?php echo $listing -> request_id;?>"/>
			<input type="hidden" name="status_id" id="status_id" value= "2">
			<!--td><input type="submit" class="submit-button" id="assign_sample" value="Assign" /></td-->
			
			
			<?php //if(isset($sampleinfo[0]['version_id'])){ $v_id = $sampleinfo[0]['version_id']; } else{ $v_id = " "; } ?>
			
			<td><span><a href="<?php echo site_url() . "sample_controller/edit/" . $listing -> request_id . "/" ;?>">Edit</a></span></td>
			<td><span><a href="<?php echo site_url() . "sample_issue/sample_split/" . $listing -> request_id?><?php foreach($split_pending as $split){ echo "/". $split['Department_id']; }?>">Assign</a></span></td>
		</tr>
		
		<?php } ?>
		<?php } ?>
		
		</tbody>
	</table>	
</div>
	<script>
	$(document).ready(function() {
    $('#tests2').dataTable({
    	"bJQueryUI": true,
    	"asStripClasses": null
    });
		} );
	</script>
	
	<script>
		$(function(){
			$('#sample_filter').change(function(){
				var val = $(this).val();
				if(val == 1){
					
					$('#sortby_tr td:gt(0)').remove();
					$('<td><input type="text" id="input_filter" autocomplete="on" required /></td>').insertAfter('#select_param_td');
					
					
				}
				else if(val == 2){
					$('#sortby_tr td:gt(0)').remove();
					$('<td><select id ="priority_lh" ><option value ="0" >All</option><option value ="1">High</option><option value ="2">Low</option></select></td>').insertAfter('#select_param_td');
					$('#priority_lh').change(function(){
						var priority = $(this).val();
						
						switch(priority){
							case '1':
							
							$('.sample_listing_tr .priority:contains("Low")').parent().hide();
							$('.sample_listing_tr .priority:contains("High")').parent().show();
							
							break;
							
							case '2':
							
							$('.sample_listing_tr .priority:contains("High")').parent().hide();
							$('.sample_listing_tr .priority:contains("Low")').parent().show();
							
							break;
							
							case '0':
							
							$('.sample_listing_tr .priority').parent().show();
						}	
						
					})
				}
				else if(val == 3){
					$('#sortby_tr td:gt(0)').remove();
					$('<td><select id ="split_wbm" ><option value ="0">All</option><option value ="1">No Split</option><option value ="2">Split - None Assigned</option><option value ="3">Split - Pending Assign</option></select></td>').insertAfter('#select_param_td');
					
					$('#split_wbm').change(function(){
						var priority = $(this).val();
						
						switch(priority){
							
							case '0':
							//alert(priority)
							$(".sample_listing_tr ").show();
							break;
							
							
							case '1':
							//$(".sample_listing_tr").each(function(){
							$('.sample_listing_tr').show();
							$(".sample_listing_tr").each(function(){
							$(".splitalert3").fadeOut('fast');
							$(".splitalert").fadeOut('fast');
							})
							break;
							
							case '2':
							$('.sample_listing_tr').show();
							$(".sample_listing_tr").each(function(){	
							$(".splitalert3").fadeOut('fast');
							$(".nosplit").fadeOut('fast')
							})
							break;
							
							case '3':
							$('.sample_listing_tr').show();
							$(".sample_listing_tr").each(function(){	
							$(".splitalert").fadeOut('fast');
							$(".nosplit").fadeOut('fast');
							})
							
							}	
						
					})
					
					
					
				}
				
				else if(val == 0 ){
					$('#sortby_tr td:gt(0)').remove();
					$('.sample_listing_tr').show();
				}
				//alert(val);
			});
			
			$('#activeing_filter').keyup(function(){
					string = $(this).val(), count =0;
					
					$(".sample_listing_tr .activeing").each(function(){
					
					if($(this).text().search(new RegExp(string, "i")) < 0) {
						
						$(this).parent().fadeOut('fast');
					}
					
					else {
						
						$(this).parent().fadeIn('fast');
						count ++;
					}	
						
					})
					//alert(string);
						//$(".sample_listing_tr .activeing").not(":has("+string+")").parent().hide();
					});
			
			$('#clientname_filter').keyup(function(){
					string = $(this).val(), count =0;
					
					$(".sample_listing_tr .clientn").each(function(){
					
					if($(this).text().search(new RegExp(string, "i")) < 0) {
						
						$(this).parent().fadeOut('fast');
					}
					
					else {
						
						$(this).parent().fadeIn('fast');
						count ++;
					}	
						
					})
					//alert(string);
						//$(".sample_listing_tr .activeing").not(":has("+string+")").parent().hide();
					});
			
			
		});
	</script>
	
	
	<script>
		
	</script>
	
</html>