<html>
<form id = "methods_select" >
<div id = "methods_select" >
<?php foreach ($methods as $method) { ?>

<div title = "Choose Method for <?php echo $method -> Name ?>" id =  "methods_div" >
<input type = "hidden" name = "<?php echo $method -> Name ?>"  />
			<fieldset>
			<legend>Methods</legend>
				<div>
				<table>
					<?php foreach ($methods as $method){
						echo "<tr><td><label>".$method->name."</label></td>".
								"<td><input type =" ."'radio' ". "name = 'method'" . "value = '$method->name'" . "data-mname = '$method->name'" . "/></td></tr>";					
					} ?>
				</table>
				</div>
			</fieldset>
</div>

<?php } ?>
</div>
</form>

<script type="text/javascript">
$("#methods_select").jWizard({
	menu:false
})

</script>

</html>