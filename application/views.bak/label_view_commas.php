<html>
<?php    
for($i=0; $i < $prints_no; $i++) {?>
	  <table class = "misc_title">
				<tr><td><small><?php echo strtoupper($reqid)?><small/></td></tr>
				<!--tr><td><?php //echo strtoupper($info['product_name']) ?></td></tr>
				<tr><td><?php //echo strtoupper("Sample " . (int)($i+1) ); ?></td></tr-->
	  </table>
		
		<table>
			<thead></thead>
			<tbody>
				<tr><td colspan = "1"><hr></td></tr>
				<tr>
					<td>					 
						<span class = "small-text" >
							<small>
							<?php 
								$tests = Request_details::getTestsNames($reqid);
									$key = 1;
									foreach($tests as $test) { 
									 	//$test_array[] = $test['Alias'];

									 	if($key%2)
											  {
											    echo ucfirst($test['Alias']).",";
											  }
											  else
											  {
											    echo ucfirst($test['Alias']).",<br />";
											  }
											  $key++;									 
									 }  
									 /*echo implode(",<br />", array_map(function($k){
									 	return implode(", ", $k); }, array_chunk($test_array, 2)));
									 $test_array = array(); //Empty the array */
							?>
							</small>
						</span>
					</td>
				</tr>					
				<tr><td>&nbsp;</td></tr>
			</tbody>
		</table>						
<?php } ?>		
</html>						