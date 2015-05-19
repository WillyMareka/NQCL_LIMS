<form id = "issues" data-columnid = "<?php echo $column[0]['id']; ?>" >
<table id = "issue">	
			<thead>
				<tr>
				<th>Serial No.</th>	
				<th>Analsyt</th>
				<th>Issue</th>
				</tr>	
			</thead>
			<tbody>
				<tr class = "centertext">
					<td id = "column_name"><?php echo $column[0]['column_type']; ?>&nbsp;|&nbsp;<?php echo $column[0]['column_no']; ?></td>
					<td><select name ="analyst_id" class ="validate[required]">
						<option value = ""></option>
						<?php foreach($analysts as $analyst){?>
							<option value ="<?php echo $analyst ['id']; ?>" ><?php echo $analyst ['fname']. " " . $analyst ['lname']; ?></option>
						<?php } ?>
					</select></td>
					<td><input type ="submit" class ="submit-button" value ="Issue" /></td>	
				</tr>	
			</tbody>
	</table>
</form>
<script type="text/javascript">

$('#issues').validationEngine();


$('#issue').dataTable({
	"bSortable" : false,
	"sDom": 't'
})

$('#issues').submit(function(e){
e.preventDefault();
var inputs = $("#issues").find('select').filter(function(){
return this.value === " ";
});

/*if (!inputs.length) {

alert(inputs.length + " fields empty. Please fill to continue.");

}

else { */

	$.ajax({
		type: 'POST',
		url:'<?php echo base_url()."inventory/column_issue/" ?>' + $(this).attr('data-columnid'),
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

				parent.$.fancybox.close();	

				$('form').each(function(){

					this.reset();
				})
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

//}

})



</script>

</html>