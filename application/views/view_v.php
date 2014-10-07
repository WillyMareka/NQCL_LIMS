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
    <table width="80%">
        <tr>
            <td width="120px">From:</td>
            <td width=""><?php echo $messages_id[0]->sender; ?></a></td>
        </tr>

        <tr>
            <td width="120px">Subject:</td>
            <td width=""><?php echo $messages_id[0]->subject; ?></td>
        </tr>

        <tr>    
            <td width="120px">Message Body:</td>
            <td width=""><?php echo $messages_id[0]->message; ?></td>
        </tr>
        <tr>    
            <td width="120px"><a href="#data" id="reply">Reply</a></td>

        </tr>

    </table>
</center>
<div id="data">
    <form name="send" method="post" action="<?php echo base_url(); ?>messages/send/">

        <p><b>Please compose a message.</b></p>
        <table width="80%">
            <tr>
                <td width="150px" align="left" valign="top"><p>Username</p></td>
                <td width="" align="left" valign="top"><input name="username" type="text" required id="username" value="<?php echo $messages_id[0]->sender; ?>"></td>
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
</div>
<script>
    $(document).ready(function() {
        $('#data').hide();
        $("a#reply").fancybox({
            maxWidth: 500,
            maxHeight: 550,
            fitToView: true,
            width: '100%',
            height: '100%',
            autoSize: false,
            closeClick: false

        });
    });
</script>
