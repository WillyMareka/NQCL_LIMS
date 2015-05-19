<style>
            form input,select,textarea {
	//width: 70%;
	padding: 5px;
	border: 1px solid #d4d4d4;
	border-bottom-right-radius: 5px;
	border-top-right-radius: 4px;
	
	line-height: 1.5em;
	//float: right;
	
	/* some box shadow sauce :D */
	box-shadow: inset 0px 2px 2px #ececec;
}
form input:focus {
	/* No outline on focus */
	outline: 0;
	/* a darker border ? */
	border: 1px solid #bbb;
}
</style>
<script>
    $(document).ready(function() {
        loadRepeats();
        hide();
        $('.reject').hide();

        $("#Inline").fancybox({
        });

        $('#dissolution_repeat').change(function() {
            repeat_uniformity = $(this).val();

            window.location.href = "<?php echo base_url() . 'identification/identification_r/' . $labref . '/' ?>" + repeat_uniformity + "/0";

        });
        function loadRepeats() {
            var select = $('#dissolution_repeat').empty();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>identification/repeats/<?php echo $labref; ?>",
                                dataType: "json",
                                success: function(data) {
                                    $.each(data, function(i, r) {
                                        select.append("<option value=" + r.repeat_status + ">" + r.repeat_status + "</option>");
                                    });
                                },
                                error: function() {

                                }
                            });

                        }
                    });
                    
                     function hide(){
            approved="<?php echo $done;?>";
            if(approved > 0){
                $('.Inline,#Inline').hide();
            }else{
                $('.Inline,#Inline').show();  
            }
            } 
</script>
<p>
<p><h3><<<a href='<?php echo base_url() . 'supervisors/home/' . $labref; ?>'>Back</a></h3> 
<center><legend> <p>
            <?php if ($r > 1) {
                $repeat = $r - 1 ?>
            <p><center><legend><h2>Sample : <?php echo $labref; ?>&nbsp;|&nbsp; <?php echo 'Repeat ' . $repeat; ?> &nbsp;|&nbsp;Posted: <?php echo $identification[0]->date_time; ?>  </h2></legend></center></p>
        <?php } else { ?>
            <p><center><legend><h2>Sample : <?php echo $labref; ?>&nbsp;|&nbsp; &nbsp;Posted: <?php echo $identification[0]->date_time; ?>  </h2></legend></center></p>
<?php } ?>
        </p>
    </legend></center>
</p>
<p>Run no</p>
<select id="dissolution_repeat"></select>
<?php echo form_open('identification/approve/' . $labref . '/' . $r.'/'.$component); ?>

<center><div>       
        <h4>Procedure</h4>
        <textarea name="identification" readonly cols="50" rows="5"><?php echo $identification[0]->description ?></textarea>
        <p></p>
         <h4>Finding</h4>
                <textarea name="specification" readonly cols="50" rows="5"><?php echo $identification[0]->specification ?></textarea>
                <p></p>
                 <h4>Specification</h4>
                <textarea name="value3" readonly cols="50" rows="5"><?php echo $identification[0]->value3 ?></textarea>

    </div>
   <p><input type="submit" value="Approve" style="background-color: #33ff33;color: #ffffff;" class="Inline"/>&nbsp;&nbsp;<a href="#rejectSample" id="Inline" style="background-color: #F00; color: #ffffff;">Reject</a></p>

</center>
</form>
<div class="reject">
    <div id="rejectSample">
<?php $this->load->view('compose_v_1'); ?>
    </div>
</div>
