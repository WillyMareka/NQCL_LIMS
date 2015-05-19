<html>
<div id ="fancybox_label">
    <form id = "quoted_amount">
        <input type = "hidden" name="ndqno" id ="label_ndqno" class = "label_ndqno" />	
        <div>
            <fieldset>
                <legend><span>Quoted amount for </span><span id ="ndqno" class = "label_ndqno"><?php echo $reqid ?></span></legend>
                <ul id = "testlist" class = "" >
                    <li><span><?php echo $request[0]['product_name'] ?></span></li>
                    <li><span><?php echo $request[0]['Clients']['Name'] ?></span></li>
                </ul>
            </fieldset>
        </div>
        <div class = "clear">
            <div class = "left_align">
                <label for = "quoted_amount">Quoted Amount</label>
            </div>
        </div>

        <div class = "clear" >
            <div class = "left_align">
                <input type ="text" id="quoted_amount" name="quoted_amount" class="validate[required]" />
            </div>
        </div>
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="Quote" class="submit-button" />
            </div>
        </div>	
    </form>	
</div>
<?php $cid = $request[0]['Clients']['Clientid'] ?>
<script type="text/javascript">
    $('#quoted_amount').submit(function(e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/saveQuote/$reqid/$cid" ?>'
            console.log(href);
            $.ajax({
                type: 'POST',
                url: href,
                data: $('#quoted_amount').serialize()
            }).done(function() {
                noty({
                    type:'success',
                    text:'Successfully quoted.'
                })
                setTimeout("parent.$.fancybox.close()", 1000);
            })

        })
</script>
</html>