<html>
<?php var_dump($test_charges) ?>
<table id = "tcharges">
	<thead>
	<tr>
		<th>Test Id</th>
		<!--th>Method Id</th-->
		<th>Charges(Kshs)</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach($test_charges as $t_charge){ ?>

		<tr>
			<td><span><?php echo $t_charge[0]['Name'] ?></span></td>
			<!--td><span><?php //echo $t_charge[0]['method_id'] ?></span></td-->
			<td><span><?php if($t_charge[0]['Test_type'] != 2){echo $t_charge[0]['Charge'];} else { echo "<a id =" . $t_charge[0]['id'] . "class = ". "method"  . " href =" . " #methods" . $t_charge[0]['id'] . ">See Methods</a>"; } ?></span></td>
		</tr>
		
		<div class = "hidden2" id = "methods<?php echo $t_charge[0]['id'] ?>" >

		</div>

		<?php } ?>
	</tbody>
</table>

<script type="text/javascript">

 tcharges = $('#tcharges').dataTable({
	"bJQueryUI": true
})

/*$('.method').live('click', function(){
	id = $(this).attr("id");
})*/


var tcharges;
		
		$('.method').click(function(){
			
			//alert($(this).html());
			var nTr = this.parentNode.parentNode;
			
			if($(this).text() == 'See Methods'){
				
				$(this).text("Close Methods View");
				
				var reqid = $(this).attr("rel");
				var id = $(this).attr("id");
				
				$.post("request_management/getMethodCharges/" + id , function(charges){
					
					tcharges.fnOpen(nTr, charges, 'charges');
				})
				
				
			}
			
			
			else{
				
				$(this).text("See Methods");
				tcharges.fnClose(nTr);
			}
		})

</script>


</html>