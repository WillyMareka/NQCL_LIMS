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
        .data{
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
                        <td>Approval</td>
                         <td>Date Returned</td>
                         <td>Date Of Completion</td>
                         <td>Analysis Duration</td>
                        

                        
                    </tr>
                </thead>
                <tbody class="tablebody">


                    <?php foreach ($info as $sheets) : 
                        
                        
                        $timestamp_start = strtotime($sheets->date_time);

                        $now = date('d-m-Y H:i:s');

                        $days= timespan($timestamp_start, $now); 
                        
                         $time_start=  strtotime($sheets->date_time_returned);
                        $time_end=  strtotime($sheets->date_time_completed);
                        $duration='';
                        
                        if($time_end=='Not Completed: In Progress'){
                           $duration=='Not Completed';
                        }else if($time_end==true){
                         $duration=  timespan($time_start,$time_end);   
                        }
                        
                        
                        ?>	
                            
                        <tr>
                            <td style="background: lightgreen;"><?php echo $sheets->labref ?> - <em><strong>Issued: <?php echo $days;?> Ago</strong></em> </td>
                            <td><?php echo $sheets->analyst_name ?></td>                        
                            <td><?php echo $sheets->date_time ?></td>
                            <?php if($sheets->a_stat==='0'){?>
                            <td style="background: yellow;">In Progress </td> 
                            <?php }else if(($sheets->a_stat==='1')){ ?>
                            <td style="background: yellow;">In Progress : Director's Desk</td> 
                            <?php }else if(($sheets->a_stat==='2')){?>
                            <td style="background: yellow;">Finished : <a href="<?php echo base_url().'request_management/confirm_completion/'.$sheets->labref?>">Confirm</a></td> 

                            <?php }else{ ?>
                           <td style="background: greenyellow; font-weight: bolder;">ANALYSIS COMPLETE! : 100%</td> 

                            <?php } ?>
                             <td > <?php echo $sheets->date_time_returned;?></td> 

                             <td><?php echo $sheets->date_time_completed;?></td>
                             <td><?php echo $duration;?></td>
                           
                   

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

        <!--div id ="showreviewer">Choose Reviewer</div-->
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />
       

        <script type="text/javascript">


            var $lmtable = $('#refsubs').dataTable({
                "bJQueryUI": true,
                "bRetrieve": true
            });
            $(document).ready(function() {
                $('#data').hide();
                $('.inline1').click(function(){
                   $('#labref_no').val($(this).attr('id')); 
                });
                $(".inline1").fancybox({
           

                });
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
                            url: "<?php echo base_url(); ?>assign_director/sendSamplesFolderToDirector/" + labref,
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


     $('#reviewer').change(function(){
                    name=$('#reviewer option:selected').text();
                    $('#revname').val(name);
                });
            });

        </script>


    </script>
</html>