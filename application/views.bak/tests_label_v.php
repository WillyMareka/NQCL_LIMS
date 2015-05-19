<html>
<?php    
for($i=0; $i < $prints_no; $i++) {?>
<?php foreach($infos as $info) { ?>
	  <table class = "misc_title">
				<tr><td><small><?php echo strtoupper($reqid)?><small/></td></tr>
				<!--tr><td><?php //echo strtoupper($info['product_name']) ?></td></tr>
				<tr><td><?php //echo strtoupper("Sample " . (int)($i+1) ); ?></td></tr-->
	  </table>
		
		<table>
			<thead></thead>
			<tbody>
				<tr><td colspan = "1"><hr></td></tr>
				<?php 
				$tests = Request_details::getTestsNames($reqid);
				//var_dump($tests);
				foreach($tests as $test){ ?>
				<tr>
					<td>					 
						<span class = "small-text" ><small><?php echo $test['Alias']; ?></small></span>
					</td>
				</tr>					
				<?php } ?>
				<tr><td>&nbsp;</td></tr>
			</tbody>
		</table>
		<!--/div>
		<!--/div>		
		<div class = "clear"><hr /></div-->						
	<?php } ?>
<?php } ?>		
</html>						