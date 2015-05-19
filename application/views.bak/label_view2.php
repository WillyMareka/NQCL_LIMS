<html>	
		<table>
			<thead></thead>
			<tbody>
			<?php $newline_count = 1;?>
			<tr class = "tr_formating">	
				<?php for($i=0; $i < $prints_no; $i++) {?>
				<?php if($i%2 == 0){ echo "</tr><tr>"; } ?>
					<td class = "fixed bordered centred_text" >
						<small class = "centred_text" ><?php echo strtoupper($reqid)?><small/>
						<br>	
						<?php 
						$tests = Request_details::getTestsNames($reqid);
						$key = 1;
						//var_dump($tests);
						foreach($tests as $test){ 
							if($key%2){	?>			 
								<span class = "small-text" ><small><?php echo ucfirst($test['Name']).","; ?></small></span>
							<?php } else {?>	
								<span class = "small-text" ><small><?php echo ucfirst($test['Name'])."<br />"; ?></small></span>
							<?php } $key++; ?>	
						<?php } ?>
					</td>
					<?php $newline_count++; ?> 	
				<?php } ?>	
				</tr>
				<tr class = "tr_formating" ><td><br></td></tr>
			</tbody>
		</table>									
</html>						

<style media="screen" type="text/css">

.centred_text {
	text_align:center;
	font-size:0.85em;
}

.bordered {
border-style: dotted;
border-width: thin;
}

table td {
	table-layout: fixed;
	overflow:hidden;
	width:2.0in;
	height:0.90in;
}

html { margin-right: 0.13in;
	   margin-left:0.10in;
	   margin-top:0.0in;
	   margin-bottom:0.02in;
	}

</style>