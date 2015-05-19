<html>
<div id ="fancybox_label">
    <form id = "print_label">
        <input type = "hidden" name="ndqno" id ="label_ndqno" class = "label_ndqno" />	
        <div>
            <fieldset>
                <legend><span>Label for </span><span id ="ndqno" class = "label_ndqno"><?php echo $reqid ?></span></legend>
                <ul id = "testlist">
                    <?php foreach($tests as $test){ ?>
                        <li><span><?php echo $test['Name'] ?></span></li>
                    <?php } ?>
                </ul>
            </fieldset>
        </div>
        <div class = "clear">
            <div class = "left_align">
                <label for = "no_of_prints">No. of Prints</label>
            </div>
        </div>

        <div class = "clear" >
            <div class = "left_align">
                <input type ="text" id="no_of_prints" name="no_of_prints" class="validate[required]" />
            </div>
        </div>
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="Print" class="submit-button" />
            </div>
        </div>	
    </form>	
</div>
<script type="text/javascript">
    $('#print_label').submit(function(e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/getLabelPdf/$reqid" ?>' + "/" + $('#no_of_prints').val();
            var href2 ='<?php echo base_url() . "labels/Label$reqid" ?>' + ".pdf";
            $.ajax({
                type: 'POST',
                url: href,
                data: $('#print_label').serialize()
            }).done(function() {
                //parent.$.fancybox.resize();
                parent.$.fancybox.open({
                    href: href2,
                    type: 'iframe',
                    autoSize: false,
                    height: 842,
                    width: 595
                    //content: '<embed src = "'+href2+'#nameddest=self&page=1&view=FitH, 0&zoom=80,0,0" type="application/pdf" height="99%" width="100%" />', 
                });
            })

        })
</script>
</html>