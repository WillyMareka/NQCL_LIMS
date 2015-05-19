<html>
	<head></head>
	<body>
		<div>
				<div><hgroup><h3>Proforma Invoice for <?php $reqid = $this -> uri -> segment(4); $rid  = $this -> uri -> segment(3); echo $reqid; ?> </h3>
					<h4>Cost of Analysis of Listed Samples</h4>
					<h3><?php echo $this -> uri -> segment(4) ?></h3>
					<h3><?php echo $sample[0]['active_ing'] ?></h3></hgroup></div>
				<hr/>
				<div>
				<div class = "left_align clear" ><?php echo "Address" ?></div>
				<div class  = "right_align clear" ><?php echo date('d-M-Y'); ?></div>
				</div>
				<div id = "table" class = "clear">
					<table id ="proforma">
						<thead>
							<tr>
								<!--th>Lab Reference Number</th>
								<th>Active Ingredient</th-->
								<th>Test(s) Requested</th>
								<!--th>Method(s) Used</th>
								<th>Cost per Batch (Kshs.)</th-->
								<th>Total(Kshs)</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($tests as $test) { ?>
							 <?php 
							 $tid = $test['id'];
							 if($test['Test_type'] == '1'){
							 $charges = Tests::getCharges($tid); 
							 $requested_methods = Request_test_methods::getMethods($reqid, $tid);
							 }
							 else if($test['Test_type'] == '2'){
							 $requested_methods = Request_test_methods::getMethods($reqid, $tid);
							 for ($i=0; $i < count($requested_methods) ; $i++) { 
							 $method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
							 }
							 $multicomponent = Test_Multic::getMultic($reqid, $tid);
							 $multistage = Test_Multis::getMultis($reqid, $tid); 
							 $analysistype = Analysis_type::getType($reqid, $requested_methods[0]['method_id']);
							 }
							 ?>
							<tr class = "others">
								<!--td><span></span></td>
								<td><span></span></td-->
								<td><span><?php echo ucfirst($test['Alias']); ?></span></td>
								<span><?php if(sizeof($requested_methods) >= 1) { for($i = 0; $i < count($requested_methods); $i++){ 
									$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
									//echo "<li>" . $method_charges[0]['name'] . "</li>"; }
									//var_dump($requested_methods);
									}
									//else{
										//echo "";
									//}
									 ?></span>
								<span><?php

									if(sizeof($requested_methods) >= 1) {

									for($i=0; $i < count($requested_methods); $i++){
								
									if(sizeof($analysistype) >= 1) {

									if($analysistype[0]['analysis_type'] == 2){
									    $method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
										$multicomponent = Test_Multic::getMultic($reqid, $method_charges[0]['id']);
										$multistage = Test_Multis::getMultis($reqid, $method_charges[0]['id']);
										if(sizeof($multistage < 1)){
										$batch_cost[$tid][] = $method_charges[0]['charge'] * $multicomponent[0]['components_no'];
										}
										else if(sizeof($multistage >= 1)){
										$batch_cost[$tid][] = ($method_charges[0]['charge'] * $multicomponent[0]['components_no']) + ($multistage[0]['components_no'] * 3200) ;
										}	
										//var_dump($multicomponent);
										//echo $total_cost[$i];
										//echo "<li>" . $method_charges[0]['charge'] . "</li>";
									}
									else if ($analysistype[0]['analysis_type'] == 1){
										$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
										$multicomponent = Test_Multic::getMultic($reqid, $method_charges[0]['id']);
										$multistage = Test_Multis::getMultis($reqid, $method_charges[0]['id']);
										if(sizeof($multistage < 1)){
										$batch_cost[$tid][] = $method_charges[0]['charge'] + (($multicomponent[0]['components_no'] -1) * 3200);
										}
										else if(sizeof($multistage >= 1)){
										$batch_cost[$tid][] = ($method_charges[0]['charge'] * $multicomponent[0]['components_no']) + ($multistage[0]['components_no'] * 3200) ;
										}
										//echo $total_cost[$i];
										//echo "<li>" . $method_charges[0]['charge'] . "</li>";
									}
									else if($analysistype[0]['analysis_type'] == 0){
										$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
										$multicomponent = Test_Multic::getMultic($reqid, $method_charges[0]['id']);
										$multistage = Test_Multis::getMultis($reqid, $method_charges[0]['id']);
										if(sizeof($multistage < 1)){
										$batch_cost[$tid][] = $method_charges[0]['charge'] + (($multicomponent[0]['components_no'] -1) * 3200);
										}
										else if(sizeof($multistage >= 1)){
										$batch_cost[$tid][] = ($method_charges[0]['charge'] * $multicomponent[0]['components_no']) + ($multistage[0]['components_no'] * 3200) ;
										}
									}	

								}

								else {
									if(sizeof($requested_methods) >= 1){
									//var_dump($multicomponent);
									
									$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
									$multicomponent = Test_Multic::getMultic($reqid, $method_charges[0]['id']);
									$multistage = Test_Multis::getMultis($reqid, $method_charges[0]['id']);
									if(sizeof($multistage < 1)){
									$batch_cost[$tid][] = $method_charges[0]['charge'] * $multicomponent[0]['components_no'];
									}
									else if(sizeof($multistage >= 1)){
									$batch_cost[$tid][] = ($method_charges[0]['charge'] * $multicomponent[0]['components_no']) + ($multistage[0]['components_no'] * 3200) ;	
									}	//echo "<li>" . $total_cost[$i] . "</li>"; 
										//echo "<li>" . $method_charges[0]['charge'] . "</li>";
									}
									else {
											//echo "jkhkhdkfS";	
									}
								}

								} }

								else {
									$batch_cost[$tid][] = $charges[0]['Charge'];
									var_dump($charges);
										echo $batch_cost;
										//var_dump($charges);
								}



								?></span>
								<td class = "subtotal"><span><?php //echo array_sum($total_cost);
								echo array_sum($batch_cost[$tid]) 
								//var_dump($method_charges)
								 ?></span></td>
							</tr>
							<?php } ?>
							<tr class = "total">
								<td><span>Total</span></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class = "totaltd"></td>
							</tr>
						</tbody>
					</table>
				</div>
		</div>
		<div>&nbsp;</div>
		<div class = "clear footer">
			<table>
				<tr>
					<td><span>Director:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> </td>
					<!--td><span class = "right_align" ><date><?php //echo date('d-M-Y'); ?></date></span></td-->
				</tr>
				<tr>

				<td><footer><span>All cheques should be made payable to: NATIONAL QUALITY CONTROL LABORATORY</span></footer></td>

				</tr>
			</table>
		</div>
	</body>

<script type="text/javascript">
	
	$('#proforma').dataTable({
	"bJQueryUI": true
});

subtotal = parseInt(0);
$('.subtotal').each(function(){
subtotal += parseInt($(this).text());
})
console.log($('.totaltd').text(subtotal))

$('[data-alias = "print"]').click(function(){
reqid = $(this).attr("id");
rid = $(this).attr("data-rid");
	$.post("<?php echo site_url() ?>proforma/getProformaPdf/" + rid + "/" + reqid , function(proformapdf){
		window.location.href =  "<?php echo site_url() ?>proforma/getProformaPdf/" + rid + "/" + reqid ;
				})
})





</script>
<html>
