<html>	
		<table style = "table-layout:fixed; width:4.1in; border-spacing:0.05in">
			<thead></thead>
			<tbody>
			<?php $newline_count = 1;?>
				<tr class = "tr_formating">	
				<?php for($i=0; $i < $prints_no; $i++) {?>
				<?php if($i%2 == 0){ echo "</tr><tr>"; } ?>
					<td class = "fixed <?php if($prints_no == 1){ echo 'left_text'; } else { echo 'centred_text bordered'; } ?>" >
						<small class = "centred_text" ><img src="<?php echo base_url()."Images/nqcl_logo_bw.jpg" ?>" height = "8" width = "8" >&nbsp;<span class = "smaller_text" >National Quality Control Laboratory <br> P.O. Box 29726 - 00202 KNH, Nairobi.</span><small/>
						<br>	
						<?php 
						foreach($refsub[$i][0] as $key => $value){?>							
							<?php if($key != 'id' && $key != 'date_received') { ?> 
								<?php if($key != 'potency_unit'){ echo "<br>"; }  ?>
								<span class = "small-text" ><small><?php if($key != 'potency_unit') { echo ucfirst(str_replace("_", " ", $key))."&nbsp;:&nbsp;".ucfirst(str_replace("_", " ", $value)); } else { echo "&nbsp;".ucfirst(str_replace("_", " ", $value));  } ?></small></span>
							<?php } ?>
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
	font-size:0.60em;
}

.left_text{
	text-align: justify;
	font-size: 0.60em;
}

.bordered {
border-style: dotted dotted dotted dotted;
border-width: thin thin thin thin;

}

table td {
	table-layout: fixed;
	overflow:hidden;
	width:2.0in;
	height:0.90in;
}

.smaller_text{
	font-size:0.50em;
}

html { margin-right: 0.13in;
	   margin-left:0.25in;
	   margin-top:0.0in;
	   margin-bottom:0.02in;
	}

</style>