<style type="text/css">

    .tg-table-light 
    { border-collapse: collapse;
      border-spacing: 0;

    }
    .tg-table-light td, .tg-table-light th { 
        background-color: #fff; 
        border: 1px #bbb solid; 
        color: #333; font-family: sans-serif; 
        font-size: 100%; 
        padding: 10px; 
        vertical-align: top; 
    }
    .tg-table-light .tg-even td  { 
        background-color: #eee;
    }
    .tg-table-light th  { 
        background-color: #ddd; 
        color: #333; 
        font-size: 110%; 
        font-weight: bold;
    }
    .tg-table-light tr:hover td, .tg-table-light tr.even:hover td  { 
        color: #222; 
        background-color: #FCFBE3;
    }
    .tg-bf { 
        font-weight: bold;
    } 
    .tg-it 
    { 
        font-style: italic;
    }
    .tg-left {
        text-align: left; 
    } 
    .tg-right { 
        text-align: right; 
    } 
    .tg-center { 
        text-align: center;
    }
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
        border: 2px solid greenyellow;
    }
    .uniformity{
        margin: 0 auto;
        background: rgb(246,248,249); /* Old browsers */
        /* IE9 SVG, needs conditional override of 'filter' to 'none' */
        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y2ZjhmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjIwJSIgc3RvcC1jb2xvcj0iI2U1ZWJlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNWY3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
        background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 20%, rgba(245,247,249,1) 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(20%,rgba(229,235,238,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* IE10+ */
        background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-8 */
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid black;
        box-shadow: 3px;
        width: 99.5%;
    }
    input[type=text]{
        text-align: center;
    }
          span#dcomply{
                font-family: sans-serif;
                color: white;
                background-color: red;
                font-weight: bold;
            }
            span.span11{
                background-color: #F93;
                color: #F93;                
                width: 10px;
            }
            span.span12{
                background-color: #33ff33;
                color:#33ff33;
                width: 10px;
            }
            span.span13{
                background-color: #0FF;
                color:#0FF;
                width: 10px;
            }

</style>
<script>
    
    
    $(document).ready(function(){
        
  $('input').keyup(function(e){
if(e.which==39)
$(this).closest('td').next().find('input').focus();
else if(e.which==37)
$(this).closest('td').prev().find('input').focus();
else if(e.which==40)
$(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
else if(e.which==38)
$(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
});

$('input:text').keypress(function(event){
        if(event.keyCode==13)
        {
            event.preventDefault();

            }
        })
       i=1;
$('.num').live('keyup',function () {
    average();
    });
    $('.num1').live('keyup',function () {
    average1();
    });
    
     $data = "<?php echo Sample_issuance::getCompendiaStatus($labref, $test_id);?>";
                console.log($data);
                if($data==='0'){
                    $.fancybox({
                        href:"#dialog-c",
                        modal:true
                    });
                }else{
                }
                
            $(document).on('keyup', '.tg-table-light >tbody > tr ', function() {

            val = $(this).closest('.tg-table-light tr').find('.num').val();
            value1 =  parseFloat(val);          
            val_ = $(this).closest('.tg-table-light tr').find('.num1').val();
            value2= parseFloat(val_);
            answer = value1-value2;
            final = answer.toFixed(2);
            $('.num2', this).val(final);
        

        });     
                
            

        $('#addRow').click(function(e){  
            e.preventDefault();
        table= $('.tg-table-light > tbody');
        newRow =  "<tr class='tg-even'><td><div align='center'>"+i+"</div></td>\n\
                       <td><input type='text' id='' name='capsdata1[]' size='20' class='num' required tabindex='1'/></td>\n\
                       <td><input type='text' id='' name='capsdata2[]' size='20' class='num1' required tabindex='1'/></td>\n\
                       <td><input type='text' id='' name='capsdata3[]' size='20' class='num2' readonly tabindex='1'/></td>\n\
                       <td><button id='remRow'>-Remove</button></td>\n\
                   </tr>";
                   i++; 
                   $('.tg-table-light > tbody tr:last').before( $(newRow) );         
           return false;
        });
        
        $(document).on('click','#remRow', function(){
          $(this).closest('tr').remove();
          average();
          average1();
          i-1;
            return false;
        });
        
        average=function findaverage(){
             var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.num[value!=""]').length;
        $('.num').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        $('input#uav1').val(answer1);
        } 
        
            
        average1=function findaverage1(){
             var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.num2[value!=""]').length;
        $('.num2').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        $('input#uav3').val(answer1);
        } 
    });
</script>
<link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' /></script>
<!--<script src="<?php echo base_url(); ?>javascripts/nqcl_1.js?1500" type="text/javascript"></script>-->
<script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>
<form name="" action="#" id="capsForm">
    <legend>  &#171; <?php echo anchor('analyst_controller','Back')?></legend>
    <center>
        <div class="uniformity">
           <legend><h4>&#8801; NQCL &#187; UNIFORMITY OF WEIGHT &#187 CAPSULES/SACHETS & VIALS &#187; SAMPLE : <?php echo $labref; ?> </h4></legend>
            <hr>
<!--            <table>
                <tr>
                    <th>Color</th>
                    <th>Representation</th>
                </tr>
                <tr>
                  <td style=" background-color: #33ff33"></td>
                    <td>Does Not Deviate</td>
                </tr>
                <tr>
                   
                    <td style="background-color: #0FF;"></td>
                    <td>Deviates once</td>
                </tr>
                <tr>
                    <td style="background-color: #F93;"></td>
                    
                    <td>Deviates by more than twice</td>
                </tr>
            </table>-->
            <table class="tg-table-light">
                <tr>
                    <th>No.</th>
                    <th>Capsules/<br>Sachets/Vials  (mg)</th>
                    <th>Empty Capsule/<br> Sachet/Vial  (mg)</th>
                    <th>Content Weight  (mg)</th>
                     <td><button id="addRow">+ Add Row</button></td>
                  
                </tr>
                <tbody>
                              
            
                <tr class="">
                    <td>Average</td>
                    <td><input type="text" class="uav" id="uav1" name="average" readonly/></td> 
                    <td></td>
                    <td><input type="text" class="uav2" id="uav3" name="uav3" readonly/></td> 
               
                </tr>
                </tbody>
            </table>
            <p><center><textarea name="comment" cols="90" id="com" ></textarea></center></p>
        <center> <div>
                                   <input type="button" id="Export" value="Save Uniformity" class="submit-button"/>
            </div></center>
        </div>
                                    
    </center>
    <div id="dialog" title="Basic dialog" placeholder="Add Comment" style="display: none; background-color: #E5E5FF; margin:10px;">
        <p><form name="" id="reason">
            <h4>State the reason for repeating this test below</h4>
            <p>
                <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
                <br/>
                <input type="button" value="submit" id="sendit" /><input type="button" value="cancel" id="cancelit"/>
        </form></p>
    </div>
       <div id="dialog-c" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
       <?php $this->load->view('compendia_v_v');?>
    </div> 
    
</form>
<script>
    $(document).ready(function() {

    

     /*   repeat_no =<?php echo $repeat_no; ?>;
        if (repeat_no === 1) {
            prompt_dialog();
        }*/

        $('#Export').click(function() {
            var bad = 0;
            $('#capsForm :text').each(function()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            if (bad > 0) {
                $.prompt(bad + ' value(s) are missing, ensure all fields are filled and that deviations have been calculated if they\n\
                        have not been calculated');
            }
            else {
                dataString2 = $('#capsForm').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>uniformity/save_capsule_weights/<?php echo $labref.'/'.$test_id; ?>",
                                        data: dataString2,
                                        success: function() {
                                                            alert('Data Saving Complete');
                                                         window.location.href = "<?php echo base_url() . 'analyst_controller'?>";

                                                
                                          
                                         
                                        },
                                        error: function() {
                                            $.prompt('An internal problem has been experienced, data could not be exported!');
                                        }

                                    });



                                }

                            });

                            $('#sendit').click(function() {
                                var data = $('#reason').serialize();
                                $.ajax({
                                    type: 'post',
                                    url: '<?php echo base_url() . 'tabs/postRepeatReason/' . $labref; ?>',
                                    data: data,
                                    success: function(data) {
                                        alert(data);
                                    },
                                    error: function() {

                                    }


                                })

                                $('#dialog').trigger('close');
                            });
                            $('#cancelit').click(function() {
                                window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";
                            });

                            function prompt_dialog() {
                                $("#dialog").lightbox_me({
                                    closeClick: false,
                                    centered: true
                                });
                            }


                            function generate(type) {

                                var today = new Date();
                                var cHour = today.getHours();
                                var cMin = today.getMinutes();
                                var cSec = today.getSeconds();
                                var time = cHour + ":" + cMin + ":" + cSec;

                                var d = new Date();

                                var month = d.getMonth() + 1;
                                var day = d.getDate();

                                var output = (('' + day).length < 2 ? '0' : '') + day + '/' +
                                        (('' + month).length < 2 ? '0' : '') + month + '/' +
                                        d.getFullYear();
                                var n = noty({
                                    text: type,
                                    type: type,
                                    dismissQueue: true,
                                    layout: 'topCenter',
                                    theme: 'defaultTheme',
                                    timeout: 5000,
                                    text:'Work Autosaved Temporarily: ' + output + '\t' + time
                                });
                                console.log('html: ' + n.options.id);
                            }

                            function generateAll() {

                                generate('information');

                            }

                        });
</script>