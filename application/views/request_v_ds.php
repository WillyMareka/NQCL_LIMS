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
            
            <div id="filter">
                  <form id="printing_form" method="post">
                <table>
                  
                    <tr><td>Start Date: <input type="text" id="start" name="start"/></td></tr>
                    <tr><td>End Date: <input type="text" id="end" name="end"/></td></tr>
                    <tr><td><input type="button"  value="Print" id="printer"/></td></tr>
                    
                </table>
                  </form>
            </div>
            <table id = "refsubs">
                <thead>
                    <tr>
                        <th>Sample</th> 
						<th>Quantity Issued</th> 						
                        <th>Issued To.</th>                        
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
							<td><?php echo $sheets->quantity_issued . " " . $sheets->sample_packaging ?></td>
                            <td><?php echo $sheets->analyst_name ?></td>                        
                            <td  class=""><a href="#date_change" class="Edit" id="<?php echo $sheets->id;?>"> <?php echo $sheets->date_time_tracker ?> (Edit)</a></td>
                            <?php if($sheets->a_stat==='0'){?>
                            <td style="background: yellow;">Analysis in Progress : <a href="<?php echo base_url().'request_management/complete/'.$sheets->labref?>">Complete Analysis</a></td> 
                            <?php }else{ ?>
                            <td style="background: lawngreen;">
                            <?php if($sheets->stat === '0') { ?>
                                <a id="<?php echo $sheets->labref;?>" href="#data" class="assign_reviewer">Assign Reviewer</a></td> 
                            <?php } else {?> 
                                <a href = "#review_in_progress" title = "Click to see reviewer" data-labref = "<?php echo $sheets->labref;?>" id="rvip<?php echo $sheets->labref;?>" class="rvip">Review in Progress</a>
                            <?php } ?>
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
                             $(function() {
$( "#start,#end" ).datepicker({
     changeMonth: true,
changeYear: true,
dateFormat: 'yy-mm-dd'
});
});



$('#printer').click(function(){
    //alert(1);
    start=$('#start').val();
    end = $('#end').val();
    window.location.href="<?php echo base_url();?>assigned_report/getReport/"+start+"/"+end+"/";
    });
        });
            $(document).ready(function() {
                $('#data').hide();
                  $('#date_change').hide();

                
                
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

                                /*
                                setTimeout(function() {
                                    window.location.href = '<?php echo base_url(); ?>request_management/complete/';
                                }, 3000);
                                */

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

    //Show reviewer details to whom sample assigned
    $('.review_in_progress').on("click", function(e){
        e.preventDefault();
        labref = $(this).attr('data-labref');
        reviewer_details_url = "<?php echo base_url(); ?>assign/reviewerDetailsView/" + labref;
            $.fancybox.open({
                href:reviewer_details_url,
                type:'iframe',
                autoSize:false,
                autoDimensions: false,
                width:600
            })        
         })

    //Show reviewers to assign to
    $('.assign_reviewer').on("click",function(e){
        e.preventDefault();
        href = $(this).attr('href');
        labref = $(this).attr('id');
       
        //Set labref
        $('#labref_no').val(labref); 
        
        //Pop up reviewer select
        $.fancybox.open({
            href:href
            })
        });
    
    </script>


    </script>
</html>