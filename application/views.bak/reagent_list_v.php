<html>
<div class ="content">

<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Reagents List</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/reagentadd"; ?>">Add Reagents</a>
&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>
<div>&nbsp;</div>

<table id = "rgents">
<thead>
<tr>

<th>Name</th>
<th>Edit</th>
<th>Edit History</th>


</tr>
</thead>
<tbody>
<?php foreach($reagent as $rgnt) {?>	
<tr>
	<td><?php echo $rgnt -> name ?></td>
	<td><a class = "edit" href="#rgnt<?php echo $rgnt -> id ?>">Edit</a></td>
	<td>
		<?php if($rgnt -> edit_status == "1"){ ?>
			<a class = "history" id = "<?php echo $rgnt -> id ?>" href="#rgnt<?php echo $rgnt -> id ?>">Show</a>	
	  	<?php } else { ?>
	  		<span>No Edits</span>
	  	<?php }?>
	
	</td>
</tr>

<div class = " popupform hidden2" id = "rgnt<?php echo $rgnt -> id ?>" >
	<form id = "editreagent<?php echo $rgnt -> id ?>" data-formid = "editreagent" >
		<div>
			<legend>Edit. <?php echo $rgnt -> name ?></legend>
			<hr />
		</div>
		<div id = "add_success" class ="hidden2" >
			<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
		</div>	
		<div class = "clear">
			<div class = "left_align">
				<label for = "refname">Substance Name</label>
			</div>
			<div class = "right_align">
				<input name = "refname" required value = "<?php  echo $rgnt -> name ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "comment">Comment</label>
			</div>
			<div class = "right_align">
				<textarea name = "comment" required autocomplete ="off" ></textarea>
			</div>
		</div>
		<div class = "clear">
			<div class = "right_align">
				<input type = "submit" class = "submit-button" name = "submit_ref" required value = "Update"  />
			</div>
		</div>		
		<input type = "hidden" name = "rgnt_id" value = "<?php echo $rgnt -> id ?>" />
		<input type = "hidden" name = "refname1" value = "<?php echo $rgnt -> name ?>" />
	</form>	
</div>




<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">

 var rtable = $('#rgents').dataTable({
		"bJQueryUI": true
	});

 rtable;

	$('.edit').fancybox();

			$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('inventory/reagent_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})

	$('[data-formid = "editreagent"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/edit_reagent" ?>',
		data: $('[data-formid = "editreagent"]').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				parent.$.fancybox.close();
				document.location.reload();	
			}
			else if(response.status === "error"){
					parent.$.fancybox.close();
				document.location.reload();	
			}
		},
		error:function(){
			parent.$.fancybox.close();
				document.location.reload();
		}
	})

})

</script>
</html>