<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>

</head>


<body>
	<form id = "methods" class = "methods"  >
		<?php foreach ($components as $component) { ?>
			<fieldset>
				<legend>Choose method for <?php echo $component -> name ?></legend>
				<ul>
					<?php foreach ($methods as $method) { ?>
						<li  id ="method-<?php echo $method -> name?>"  >
							<label for = "<?php echo $method -> name ?>" >
							<input  type = "radio" name = "methods" value = "<?php echo $method -> id ?>" title = "<?php echo $method -> name ?>"  />
							<?php echo $method -> name ?>
							</label>
						</li>	
					<?php } ?>
					<li>
						<input type = "submit" value = "Save" class = "submit-button" />
					</li>
				</ul>
			</fieldset>
		<?php } ?>
 </form>
</body>
</html>
