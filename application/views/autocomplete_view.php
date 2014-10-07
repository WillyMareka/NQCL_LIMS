<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>google</title>
<link href="<?php echo base_url();?>stylesheets/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(function() {
		$( "#autocomplete" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('autocomplete/suggestions'); ?>",
				data: { term: $("#autocomplete").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
	});
});
</script>
</head>
<body>
Text: <input type="text" id="autocomplete" />
</body>
</html>