<style type="text/css">
    .Final_submission{
        width: 100%;
        min-height: 1024px;
        background: blue;
    }
    .LSideFS{
        width: 240px;
        min-height: 1000px;
        background: #00CC33;
        margin-top: 5px;
        position: absolute;
        margin-left: 5px;
    }
    .RSideFS{
        width: 1054px;
        min-height: 1000px;
        background: white;
        margin-top: 5px;
        position: absolute;
        margin-left: 250px;

    }
    .RSideFSIframe{
        width:100%;
        min-height: 1000px;
    }
    .FSTests{
        width: 180px;
        min-height: 150px;
        color: white;
    }
    .FST{
        text-align: center;
        margin:0 auto;
        font-weight: bolder;
        margin-top: 5px;
        background-color: tan;
    }
    .FSTRepeats{
        width: 228px;
        min-height: 200px;
        background:  white;
        margin-left: 6px;
        border-radius: 3px;
    }
    #head{
        margin-top: 6px;
    }
    label{
        display: block;
        margin-left: 10px;

    }
    .labels{
        margin-left: 20px;
    }


</style>

<script type="text/javascript">
    $(document).ready(function() {
        
        status="<?php echo $upload_status;?>";
        
         if (status =='1') {
                                new Messi('You have not yet uploaded the workbook you downloaded <?php echo $labref.'.xlsx';?>  It is an important element for submitting test results on this page, I\'ll take you Home to upload it', {title: 'WARNING: ACCESS DENIED!', modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}], callback: function(val) {

                                        if (val === 'X')
                                            window.location.href = "<?php echo base_url() . 'analyst_controller/' ?>";
                                    }});

                            } 
        
        $.ajax({
            type: "get",
            url: "<?php echo site_url('final_submission/project/' + $labref + '/1/1'); ?>",
            success: function() {
                $('.RSideFSIframe').attr('src', '<?php echo base_url().'final_submission/home_page/';?>');
                loadRepeat();
            },
            error: function() {

            }
        });
        $('ol a').on('click', function() {
            newlink = $(this).attr('href');
            $(this).wrap("<strike>");
            $(this).css('background','white');
           // $(this).css('background','white');
            name = $(this).attr('id');
            name1 = name.replace(/_/g, ' ');
            n = newlink.replace(/\s+/g, '_');
            $('#head').text(name1);
            $('#component').attr('class', name);
            $('#repeat').attr('class', name);
            loadRepeat();
            loadComponentNo();
            $('.RSideFSIframe').attr('src', n);
            return false;
        });

        $('#repeat').change(function() {
            repeat = $(this).val();
            component_no=$('#component').val();
            test_name = $(this).attr('class');
            n = "<?php echo base_url(); ?>final_submission/" + test_name + "/<?php echo $labref; ?>/" + repeat+"/"+component_no;
            $('.RSideFSIframe').attr('src', n);
            // alert(n)
            $.ajax({
                type: "POST",
                url: n,
                // dataType:"json",             
                success: function(data) {

                    console.log(data);
                    $('.RSideFSIframe').attr('src', n);


                    //  $('.RSideFSIframe').attr('src', n);
                },
                error: function() {

                }
            });

        });



        function loadRepeat() {
            var select = $('#repeat').empty();
            test_name = $('#repeat').attr('class');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>final_submission/" + test_name + "_repeat/<?php echo $labref; ?>",
                dataType: "json",
                success: function(data) {
                    select.append("<option value=''>-Select-</option>");
                    $.each(data, function(i, r) {
                        var opt = (r.repeat_status);
                        select.append("<option value=" + opt + ">" + opt + "</option>");
                    });
                },
                error: function() {

                }
            });

        }
        $('#component').change(function(){
         var select = $('#repeat').empty();
         component_no=$(this).val();
        //s alert(component_no);
         test_name = $('#repeat').attr('class');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>final_submission/" + test_name + "_repeat/<?php echo $labref; ?>/"+component_no,
                dataType: "json",
                success: function(data) {
                                      select.append("<option value=''>-Select-</option>");

                    $.each(data, function(i, r) {
                        var opt = (r.repeat_status);
                        select.append("<option value=" + opt + ">" + opt + "</option>");
                    });
                },
                error: function() {

                }
            });
        
        });

        function loadComponentNo() {
            var select = $('#component').empty();
            component_no = $('#component').attr('class');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>final_submission/" + test_name + "_components/<?php echo $labref; ?>",
                dataType: "json",
                success: function(data) {
                  select.append("<option value=''>-Select-</option>");
                    $.each(data, function(i, r) {
                        var opt = (r.component_no);
                        
                        select.append("<option value=" + opt + ">" + r.component + "</option>");
                    });
                },
                error: function() {

                }
            });

        }
        $('#summary').click(function(){
        window.location.href="<?php echo base_url();?>sample_requests/loadsubmissions/<?php echo $labref; ?>/1/1";
        });
    });

</script>
<legend><a href="<?php echo site_url() ."analyst_controller/loadfinal"; ?>">&#171Back</a> &nbsp; || &nbsp;<a href="<?php echo site_url() ."analyst_controller/"; ?>">My Home</a>&nbsp; || &nbsp;<a href="<?php echo site_url() ."sample_requests/"; ?>">Done Tests</a></legend>        

<div class="Final_submission">
    <div class="LSideFS">
        <div class="FSTests">
            <p class="FST">Tests</p><br />
            <ol>
                <?php foreach ($testdata as $test): ?>
                    <li><span><strong><?php echo anchor('final_submission/' . str_replace(" ","_",$test->name) . '/' . $labref . '/1' . '/1', $test->name, array('id' => str_replace(" ", "_", $test->name))) ?> </strong></span></li><br />
                <?php endforeach; ?>
            </ol>
        </div>
        <div class="FSTRepeats">
            <center> <p id="head">Select Test Above</p></center>
            <div class='labels'>
                <p><label>component</label><select id='component'></select></p>
                <p><label>Run Number</label><select id='repeat'></select></p>
                
                <submitfinal>
                    <input type="button" value="Submit Summary" id="summary" class="submit-button"/>
                </submitfinal>
            </div>
        </div>
    </div>
    <div class="RSideFS">
        <iframe class="RSideFSIframe" src=""  frameborder=0 scrolling=auto ></iframe>  
    </div>
</div>