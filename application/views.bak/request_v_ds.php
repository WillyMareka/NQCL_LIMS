<html>
      <script>
        $(document).ready(function() {
            var success1 = $(".success");
            var error1 = $(".error");
            var selecterror = $(".selecterror");
            success1.hide();
            error1.hide();
            selecterror.hide()
        });
    </script>
    <style type="text/css">
        .success{
            background-color: greenyellow;
            display: none;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:black;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
            z-index: 100;
            opacity: .9;

        }

        .error{
            display: none;
            background-color: red;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:white;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .selecterror{
            background-color: red;
            width:100%;            
            border-radius: 3px;
            color:white;
            display: none;
            text-align: center;
            padding-top: 1px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .data,.date_change,#popup_date{
            display: none;
        }


    </style>

    <div class ="content">

<legend><a href="<?php echo site_url() ."request_management/assigned_samples/"; ?>">Analysis</a>&nbsp;||&nbsp;<a href="<?php echo site_url() ."request_management/review_samples/"; ?>">Review&nbsp;||&nbsp;<a href="<?php echo site_url() ."request_management/Draft_certificate_samples/"; ?>">Draft Certificate Samples </a>&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation_rejects/home/"; ?>"> </a></legend>        <div>&nbsp;</div>
        <div class="success">Success: Worksheet was successfully assigned for review</div>
        <div class="error">Error: Worksheet could not be assigned for review now, Please try again later!</div>
        <div class="content4">
            <table id = "refsubs">
                <thead>
                    <tr>
                        <th>Sample</th>                        
                        <th>Given To.</th>                        
                        <th>Date</th>
                        <td>Analysis</td>
<!--                         <td>Date Returned</td>-->
                        

                        
                    </tr>
                </thead>
                <tbody class="tablebody">


                    <?php foreach ($info as $sheets) : 
                        
                        
                        $timestamp_start = strtotime($sheets->date_time_tracker);

                        $now = date('d-m-Y');

                        $days= timespan($timestamp_start, $now); 
                        ?>	
                            
                        <tr>
<!--                            - <em><strong>Issued: <?php echo $days;?> Ago</strong></em> -->
                            <td style="background: lightgreen;"><?php echo $sheets->labref ?> </td>
                            <td><?php echo $sheets->analyst_name ?></td>                        
                            <td  class=""><a href="#date_change" class="Edit" id="<?php echo $sheets->id;?>"> <?php echo $sheets->date_time_tracker ?> (Edit)</a></td>
                            <?php if($sheets->a_stat==='0'){?>
                            <td style="background: yellow;">In Progress : <a href="<?php echo base_url().'request_management/complete/'.$sheets->labref?>">Complete</a></td> 
                            <?php }else{ ?>
                            <td style="background: lawngreen;">Completed : <a href="#data" id="<?php echo $sheets->labref;?>" class="inline1">Assign</a></td> 
                            <?php }?>
<!--                             <td > <?php echo $sheets->date_time_returned;?></td> -->

                           
                           
                   

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            
        </div>
        <div id="data">
            <form id="popup" >
                <div class="selecterror">Please select a reviewer first!</div>
                <table>
                    <tr>
                        <th>Reviewer Name </th> 
                    </tr>
                    <tr><td>
                            <select name="reviewer" required id="reviewer">
                                <option value="" selected="selected">--Select Reviewer--</option>              
                                   
                            </select>
                             <input type="hidden" name="rev_name" id="revname"/>
                             <input type="hidden" id="labref_no" name="labref_no"/>
                        </td>
                        <td>

                            <input type="button" value="Assign" id="assign_button1" class="submit-button"/> 
                        </td>
                    </tr>


                </table>
            </form>
        </div>
        
              <div id="date_change">
            <form id="popup_date" >
                <div class="selecterror">Field date cannot be left blank!</div>
                <table>
                    <tr>
                        <th>Click TextBox to change date</th> 
                    </tr>
                    <tr><td>
                            <input type="hidden" id="d_id" name="d_id"/>
                             <input type="text" id="date_field" name="date_field"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" value="Change" id="change_date" class="submit-button"/>   
                       
                             <input type="button" value="Cancel" id="cancel" class="button"/> 
                      
                        </td>
                       
                    </tr>


                </table>
            </form>
        </div>

        <!--div id ="showreviewer">Choose Reviewer</div-->
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />
       

        <script type="text/javascript">
$(document).ready(function(){
            $parameta = "<?php echo $this->uri->segment(3);?>";
            $('aria-controls').text($parameta);
            var $lmtable = $('#refsubs').dataTable({
                "bJQueryUI": true,
                "bRetrieve": true
            });
        });
            $(document).ready(function() {
                $('#data').hide();
                  $('#date_change').hide();
                $('.inline1').click(function(){
                   $('#labref_no').val($(this).attr('id')); 
                });
                $(".inline1").fancybox({
           

                });
                
                
                  $('.Edit').click(function(){
                   $('#d_id').val($(this).attr('id')); 
                });
                $(".Edit").fancybox({          

                });
                
                 $(function() {
$( "#date_field" ).datepicker({
     changeMonth: true,
changeYear: true,
dateFormat: 'yy-mm-dd'
});
});
            });
            $('#cancel').click(function(){
                $.fancybox.close();
            });



            $(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assign/getAJAXReviewers1/",
                    dataType: "json",
                    success: function(reviewers)
                    {
                        //console.log(reviewers);
                        $.each(reviewers, function(id, city)
                        {
                            var opt = $('<option />'); // here we're creating a new select option for each group
                            opt.val(city.id);
                            opt.text(city.fname + " " +city.lname);
                            $('#reviewer').append(opt);
                        });
                    }

                });

                $('#assign_button1').click(function() {
                    var rev = $('#reviewer').val();
                    if (rev == '') {
                        $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
                        return true;
                    } else {


                        var labref = $('#labref_no').val();
                        var data1 = $('#popup').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assign/sendSamplesFolder/" + labref,
                            data: data1,
                            success: function(data)
                            {

                                // var content=$('.refsubs');
                                $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                                $.fancybox.close();


                                setTimeout(function() {
                                    window.location.href = '<?php echo base_url(); ?>request_management/complete/';
                                }, 3000);

                                return true;
                            },
                            error: function(data) {
                                $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');
                                $.fancybox.close();


                                return false;
                            }
                        });
                        return false;
                    }
                });
                
                
                       $('#date_change').click(function() {
                    var rev = $('#date_field').val();
                    if (rev == '') {
                        $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
                        return true;
                    } else {


                        var labref = $('#d_id').val();
                        var data1 = $('#popup_date').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assign/edit_assignment/" + labref,
                            data: data1,
                            success: function(data)
                            {

                                // var content=$('.refsubs');
                                alert('Sample Assign Date Update was successfull!');
                                $.fancybox.close();


                                setTimeout(function() {
                                    window.location.href = '<?php echo base_url(); ?>request_management/assigned_samples/';
                                }, 3000);

                                return true;
                            },
                            error: function(data) {
                                $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');
                                $.fancybox.close();


                                return false;
                            }
                        });
                        return false;
                    }
                });


     $('#reviewer').change(function(){
                    name=$('#reviewer option:selected').text();
                    $('#revname').val(name);
                });
            });

        </script>


    </script>
</html>