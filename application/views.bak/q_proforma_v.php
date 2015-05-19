<html>
	<head></head>
	<body>
		<div>
				<div><hgroup><h3>Proforma Invoice for <?php $reqid = $this -> uri -> segment(4); echo $reqid; ?> </h3><h4>Cost of Analysis of Listed Samples</h4></hgroup></div>
				<hr/>
				<div>	
				<div class = "left_align clear" ><?php echo "Address" ?></div>
				<div class  = "right_align clear" ><?php echo date('d-M-Y'); ?></div>
				</div>
				<div id = "table" class = "clear">
					<table id ="proforma">
						<thead>
							<tr>
								<th>Quotation Number</th>
								<th>Client Name</th>
								<th>Sample Name</th>
								<th>Test(s) Requested</th>
								<th>Method(s) Used</th>
								<th>Cost per Batch (Kshs.)</th>
								<th>Total(Kshs)</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($tests as $test) { ?>
							 <?php 
							 $tid = $test['id'];
							 if($test['Test_type'] == '1'){
							 $charges = Tests::getCharges($tid); 
							 $requested_methods = Q_request_test_methods::getMethods($reqid, $tid);
							 }
							 else if($test['Test_type'] == '2'){
							 $requested_methods = Q_request_test_methods::getMethods($reqid, $tid);
							 for ($i=0; $i < count($requested_methods) ; $i++) { 
							 $method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
							 }
							 $multicomponent = Q_test_multic::getMultic($reqid, $tid);
							 $multistage = Q_test_multis::getMultis($reqid, $tid); 
							 $analysistype = Q_analysis_type::getType($reqid, $requested_methods[0]['method_id']);
							 }
							 ?>
							<tr class = "others">
								<td><span><?php echo $this -> uri -> segment(4) ?></span></td>
								<td><span><?php echo $sample[0]['Client_name'] ?></span></td>
								<td><span><?php echo $sample[0]['Sample_name'] ?></span></td>
								<td><span><?php echo ucfirst($test['Alias']); ?></span></td>
								<td><span><?php if(sizeof($requested_methods) >= 1) { for($i = 0; $i < count($requested_methods); $i++){ 
									//echo "<li>" . $method_charges[$i]['name'] . "</li>";

									//var_dump($requested_methods[1]['method_id']);
									$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
									echo "<li>" . $method_charges[0]['name'] . "</li>";
									 }
									}
									else{
										echo "None used";
									}
									 ?></span></td>
								<td><span><?php

									if(sizeof($requested_methods) >= 1) {

									for($i=0; $i < count($requested_methods); $i++){
								
									if(sizeof($analysistype) >= 1) {

									if($analysistype[0]['analysis_type'] == 2){
										$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
										$batch_cost[$tid][] = $method_charges[0]['charge'] * $multicomponent[$i]['components_no'];	
										//echo $total_cost[$i];
										echo "<li>" . $method_charges[0]['charge'] . "</li>"; 
									}
									else if ($analysistype[0]['analysis_type'] == 1){
										$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
										$batch_cost[$tid][] = $method_charges[0]['charge'] + (($multicomponent[$i]['components_no'] -1) * 3200);
										//echo $total_cost[$i];
										echo "<li>" . $method_charges[$i]['charge'] . "</li>";
									}	

								}

								else {
									if(sizeof($requested_methods) >= 1){
									$method_charges = Test_methods::getCharges($requested_methods[$i]['method_id'], $tid);
									$batch_cost[$tid][] = $method_charges[0]['charge'] * $multicomponent[$i]['components_no'];
										//echo "<li>" . $total_cost[$i] . "</li>"; 
										echo "<li>" . $method_charges[0]['charge'] . "</li>" ;
									}
									else {
										echo "jljdf";
									}
								}

								} }

								else {
									$batch_cost[$tid][] = $charges[0]['Charge'];
										echo array_sum ($batch_cost);
										//var_dump($charges);
								}



								?></span></td>
								<td class = "subtotal"><span><?php echo array_sum($batch_cost[$tid]) ?></span></td>
							</tr>
							<?php } ?>
							<tr class = "total">
								<td><span>Total</span></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class = "totaltd"></td>
							</tr>
						</tbody>
					</table>
				</div>
			<div>	
			<div class = "left_align clear"><span>Director:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></div>
			<div class  = "right_align clear" ><date><?php echo date('d-M-Y'); ?></date></div>
			</div>
		</div>
		<div class = "clear footer">
		<footer><span>All cheques should be made payable to: NATIONAL QUALITY CONTROL LABORATORY</span></footer>
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

</script>
<html>
