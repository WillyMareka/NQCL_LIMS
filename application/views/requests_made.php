<head>

</head>
<div id="view_content">
	<a class="action_button" id="new_client" href="<?php echo site_url('request_management/add') ?>">New Request</a>
	  <div class="center_div">
		<table class="" id="requests" >
			<thead>
			<tr>
				<th></th>
				<th>Client id</th>
				<th>Request id</th>
				<th>Product_name</th>
				<th>Batch_no</th>
				<th>Date of Request</th>
				<th>Quantity</th>
				<th>Edit Request </th>
				<th>View Label</th>
				<th>View Proforma</th>
	
			</tr>
			</thead>
			
		<tbody>
			<?php			
			foreach ($info as $infos) {?>
				<tr class="info">
					<td><?php $expcol = "<a class=" . '"expcol"' . "rel = " .  $infos['request_id'] .  " >+</a>";?></td>
					<td><span><?php echo $infos['client_id']  ?></span></td>
					<td><span><?php echo $infos['request_id']  ?></span></td>
					<td><span><?php echo $infos['product_name']  ?></span></td>
					<td><span><?php echo $infos['Batch_no']  ?></span></td>
					<td><span><?php echo date('d-M-Y',strtotime($infos['Designation_date']))  ?></span></td>
					<td><span><?php echo $infos['sample_qty'] ?></span></td>
					<td><a href="<?php //echo site_url('request_management/edit') . "/" . $infos['request_id'] ?>" >Edit Request </a></td>
					<td><a class ="labels" id = "<?php echo $infos['id'] ?>" rel =  "<?php echo $infos['id'] ?> " href= "<?php echo "#label" . $infos['id'] ?>">View Label</a></td>
					<td><a href = "<?php echo site_url('proforma/getProforma') . "/" . $infos['id'] . "/" . $infos['request_id'] ?>" >View Proforma</a></td>

					<div class = " popupform hidden2" id = "label<?php echo $infos['id'] ?>" >
					<form id = "label<?php echo $infos['id'] ?>" data-formid = "printlabel" >	
						<div>
							<legend><?php  echo $infos['request_id']?>&nbsp;.&nbsp; <?php //echo $infos['product_name'] ?></legend>
							<hr />
						</div>
						<div id = "add_success" class ="hidden2" >
						<span class = "misc-title small-text padded" ><?php print_r($_POST) ?></span>
						</div>
						<div class = "clear">
							<div class = "left_align" >
						<?php 
						$tests = Request_details::getTestsNames($infos['request_id']);
						//var_dump($tests);
						foreach($tests as $test){ ?>
						 
						 	<li>
						   		<span class = "misc-title" ><?php echo $test['Alias']; ?></span>
							</li>
							
						<?php }
						?>	
						</div>
						</div>
						
						<div class = "clear">
							<hr />
							<div class = "left_align" >
								<label>Prints No.</label>
							</div>
							<div class = "right_align">
								<input type = "text" name = "prints_no" required value = "1" id = "prints_no<?php echo $infos['id'] ?>" />
							</div>
						</div>
						<input type = "hidden" name ="reqid" value ="<?php echo $infos['request_id'] ?>" id = "reqid<?php echo $infos['id'] ?>" />
						<div class = "clear">
								<div class = "right-align">
								<input class = "submit-button" type = "submit" value = "Print" />
								</div>
						</div>
					</form>
				</div>
					</div>	
				</tr>

				<script type="text/javascript">
					$('form[id = "label<?php echo $infos['id'] ?>"]').submit(function(e){
					e.preventDefault();
					reqid = $('[id = "reqid<?php echo $infos['id'] ?>"]').val();
					prints_no = $('[id = "prints_no<?php echo $infos['id'] ?>"]').val();
					$.ajax({
						type: 'POST',
						url: '<?php echo site_url() . "request_management/getLabelPdf/" ?>' + reqid + "/" + prints_no,
						data: $('form[id = "label<?php echo $infos['id'] ?>"]').serialize(),
						dataType: "json",
						success:function(response){
								
							parent.$.fancybox.close();
							document.location.href = '<?php echo site_url() . "request_management/getLabelPdf/"?>' + reqid + "/" + prints_no
		
								},
						error:function(){
							////document.location.href = '<?php //echo site_url() . "request_management/getLabelPdf"?>'	
							parent.$.fancybox.close();
							document.location.href = '<?php echo site_url() . "request_management/getLabelPdf/"?>' + reqid + "/" + prints_no
						}
					})

				})

					</script>

			<?php }?>
		</tbody>
		</table>
	</div>
	<div id="entry_form" title="New Client">
		<?php
		$attributes = array('class' => 'input_form');
		echo form_open('client_management/save', $attributes);
		?>
		</form>
	</div>
</div>

	<script>
	$(document).ready(function(){
		
	requestsTable = $('#requests').dataTable({
    "bJQueryUI": true
    })
    
	
	$('.labels').fancybox({});	
		
		var requestsTable;
		
		$('.expcol').click(function(){
			
			//alert($(this).html());
			var nTr = this.parentNode.parentNode;
			
			if($(this).text() == '+'){
				
				$(this).text("-");
				
				var reqid = $(this).attr("rel");
				var versionid = $(this).attr("id");
				
				$.post("request_management/history/" + reqid + "/" + versionid, function(history){
					
					requestsTable.fnOpen(nTr, history, 'history');
				})
				
				
			}
			
			
			else{
				
				$(this).text("+");
				
				
				requestsTable.fnClose(nTr);
				
			}
			
			
		})

		/*$('[data-formid = "printlabel"]').submit(function(e){
			e.preventDefault();
			reqid = $('[name = "reqid"]').val();
			prints_no = $('[name = "prints_no"]').val();
			$.post("<?php echo site_url('request_management/getLabelPdf') ?>" + "/" + reqid + "/" + prints_no  , function(label){
					
					console.log(label);
					parent.$.fancybox.close();
					//document.location.href = '<?php echo site_url() . "request_management/getLabelPdf/" ?> + reqid + "/" + prints_no '
					
				})

		})*/

	
	})	
		
	</script>

	