<head>    
    <script>
        $(document).ready(function(){
    $(function() {
		$( "#username" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('messages/recipients'); ?>",
				data: { term: $("#username").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 1,
                                    Delay : 50
		});
	});
        });

    </script>
</head>
<?php
$percent1 = $pm_count[0]->pm_count / '1000';
$percent = $percent1 * '100';
?>
<br>
<center>
    <b><p><a href="<?php echo base_url(); ?>messages/inbox">Inbox</a> | <a href="<?php echo base_url(); ?>messages/compose">Compose</a> | <a href="<?php echo base_url(); ?>messages/sent">Sentbox</a></b>
    <b><p><?php echo $pm_count[0]->pm_count . " of 1000 Total  |  " . "$percent" . "% full"; ?></p></b>
</center>
<br>
<center>
    <form name="send" method="post" action="<?php echo base_url();?>messages/send/">
         
        <p><b>Please compose a message.</b></p>
        <table width="80%">
            <tr>
                <td width="150px" align="left" valign="top"><p>Username</p></td>
                <td width="" align="left" valign="top"><input name="username" type="text" required id="username" value=""></td>
            </tr>

            <tr>
                <td width="150px" align="left" valign="top"><p>Subject</p></td>
                <td width="" align="left" valign="top"><input name="subject" type="text" required id="subject" value=""></td>
            </tr>

            <tr>
                <td width="150px" align="left" valign="top"><p>Message Body</p></td>
                <td width="" align="left" valign="top"><textarea name="message" type="text" required id="message" value="" cols="50" rows="10"></textarea></td>
            </tr>

            <tr>  
                <td></td>
                <td><input type="submit" name="Submit" value="Send Message"></td>
            </tr>
        </table>
    </form>
</center>

