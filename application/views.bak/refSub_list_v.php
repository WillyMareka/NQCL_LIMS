<html>
<div class ="content">
	<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span  class ="link_highlight">Reference Substances List</span>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubslist"; ?>">Reference Substances Inventory</a>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd"; ?>">Add Reference Substance</a>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>
	<div>&nbsp;</div>
<table id = "refsubs">
<thead>
<tr>
<th>Name</th>
<th>Edit</th>
<th>Edit History</th>
</tr>
</thead>
<tbody>
<?php foreach($refsub as $refs) {?>	
<tr>
	<td><?php echo $refs -> name ?></td>
	<td><a class = "edit" href = "<?php echo "#ref" . $refs -> id ?>">Edit</a></td>
	<td>
		<?php if($refs -> edit_status == "1"){ ?>
			<a class = "history" id = "<?php echo $refs -> id ?>" href="#ref<?php echo $refs -> id ?>">Show</a>	
	  	<?php } else { ?>
	  		<span>No Edits</span>
	  	<?php }?>
	
	</td>
</tr>

<div class = " popupform hidden2" id = "ref<?php echo $refs -> id ?>" >
	<form id = "editrefsub<?php echo $refs -> id ?>" data-formid = "editrefsub" >
		<div>
			<legend>Edit. <?php echo $refs -> name ?></legend>
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
				<input name = "refname" required value = "<?php  echo $refs -> name ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "comment">Comment</label>
			</div>
			<div class = "right_align">
				<textarea name = "comment" required ></textarea>
			</div>
		</div>		
		<div class = "clear">
			<div class = "right_align">
				<input type = "submit" class = "submit-button" name = "submit_ref" required value = "Update"  />
			</div>
		</div>		
		<input type = "hidden" name = "refid" value = "<?php echo $refs -> id ?>" />
		<input type = "hidden" name = "refname1" value = "<?php echo $refs -> name ?>" />
	</form>	
</div>

<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">
$(function(){
 var rtable = 	$('#refsubs').dataTable({
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
						
							$.post("<?php echo site_url('inventory/refsub_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})

	$('[data-formid = "editrefsub"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/edit_refsub" ?>',
		data: $('[data-formid = "editrefsub"]').serialize(),
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


})
</script>
</html>