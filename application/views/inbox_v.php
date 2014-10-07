<?php
$percent1 = $pm_count[0]->pm_count / '1000';
$percent = $percent1 * '100';
?>

<style>   
      table td{
        border: 1px silver dotted;
    }
    #cont ul {
        margin: auto;
        display: block;
        text-align: center;
        padding: 0;
    }
    #cont li {
        /*font-family: Georgia, "Times New Roman", Times, serif;*/
        font-family: sans-serif, Helvetica, Arial;
        font-size: 13px;
        font-weight: normal;
        position: relative;
        list-style: none;
        margin: 0;
        display: inline-block;
        padding: 0;​
    }
    #pagination a, #pagination strong{
        background: #e3e3e3;
        padding: 4px 7px;
        text-decoration: none;
        border: 1px solid #cac9c9;
        color: #292929;
        
    }
    #pagination stong, #pagination a:hover{
        font-weight: normal;
        background: #cac9c9;
    }
    td:last-child{
        border-right: none;
    }
    span.green{
        background-color: #00ff00;
    }
    span.red{
        background-color: orange;
    }
</style>

<br>
<center>
    <b><p><a href="<?php echo base_url(); ?>messages/inbox">Inbox</a> | <a href="<?php echo base_url(); ?>messages/compose">Compose</a> | <a href="<?php echo base_url(); ?>messages/sent">Sentbox</a></b>
    <b><p><?php echo $pm_count[0]->pm_count . " of 1000 Total  |  " . "$percent" . "% full"; ?></p></b>
</center>

<br>
<?php if ($message_available == '0') { ?>
    <center><p><b>You have no messages to display</b></p></center>
<?php } else { ?>
    <center>
        <form name="send" method="post" action="<?php echo base_url();?>messages/delete_message/" id="pagination">
           
            <table width="80%">
                <tr>
                    <td width="75%" valign="top"><p><b><u>Subject</u></b></p></td>
                    <td width="120px" valign="top"><p><b><u>Sender</u></b></p></td>  
                    <td width="25px" valign="top"><p><b><u>Select</u></b></p></td>
                </tr>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td width="75%" valign="top">
                            <?php if($message->recieved=='0'){?>
                            <a href="<?php echo base_url() . "messages/view/" . $message->id; ?>"><strong><?php echo $message->subject; ?></strong>&nbsp;<span class="red">Unread</span></a>
                            <?php } else {;?>
                            <a href="<?php echo base_url() . "messages/view/" . $message->id; ?>"><?php echo $message->subject; ?>&nbsp;<span class="green">Read</span></a>
                            <?php } ?>
                        </td>
                        <td width="120px" valign="top">
                            <?php echo $message->sender; ?>
                        </td>
                        <td width="25px" valign="top"><input name="pms[]" type="checkbox" value="<?php echo $message->id; ?>"></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>  
                        <td colspan="3"><input type="submit" name="Submit" value="Delete Selected"></td>
                        
                      </tr>
            </table>
            <div id="cont" > 
            <?php echo $links; ?>
            </div>
            
    </center>
<?php } ?>
 