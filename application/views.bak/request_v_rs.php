<html>
    <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
      <script>
        $(document).ready(function() {
            var success1 = $(".success");
            var error1 = $(".error");
            var selecterror = $(".selecterror");
            success1.hide();
            error1.hide();
            selecterror.hide()
            
            
              $('.reason').on('mouseover',function(){          
          id=$(this).prop('id');
          
           $.ajax({
            type:'get',
            url:"<?php echo base_url();?>reviewer/reject_reason/"+id+"/Reviewer/",
            dataType:'json',
            success:function(data){
              // alert(data[0].reject_reason);
			   
		    showNotification({
            type: "warning",
            message: data[0].reject_reason,
            autoClose: true,
            duration: 5
        });
			   
            },
            error:function(){
              alert('An error occured when attempting to retrieve Rejection reason!');  
              
            }
        });
        });
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
        <div class="success">Success: Draft Certificate was successfully assigned for review</div>
        <div class="error">Error: Draft Certificate could not be assigned for review now, Please try again later!</div>
        <div class="content4">
            <table id = "refsubs">
                <thead>
                    <tr>
                        <th>Sample</th>                        
                        <th>Given To.</th>                        
                        <th>Date</th>
                        <td>Review</td>
                        <td>Date Returned</td>
                        

                        
                    </tr>
                </thead>
                <tbody class="tablebody">


                    <?php foreach ($info as $sheets) : 
                        
                        
                        $timestamp_start = strtotime($sheets->date_time);

                        $now = date('d-m-Y H:i:s');

                        $days= timespan($timestamp_start, $now); 
                        
                       
                        ?>	
                            
                        <tr>
                            <td style="background: lightgreen;"><?php echo $sheets->labref ?> - <em><strong>Issued: <?php echo $days;?> Ago</strong></em> </td>
                            <td><?php echo $sheets->analyst_name ?></td>                        
                            <td><?php echo $sheets->date_time ?></td>
                            <?php if($sheets->a_stat==='4'){?>
                            <td style="background: yellow;">In Progress : Awaiting Response </td> 

                            <?php }else if($sheets->a_stat==='0'){ ?>
                               <td style="background: yellow;">In Progress : <a href="<?php echo base_url().'assign/complete_review/'.$sheets->labref?>">Complete</a></td> 
                             <?php }else if($sheets->a_stat==='5'){?>
                             <td style="background: salmon; color: white; font-weight: bolder;">Sample Rejected: <a href="#" id="<?php echo $sheets->labref;?>" class="reason">Why?</a></td> 
                            <?php } else{?>
                       <td style="background: lawngreen;">Review Status : Complete! - <a href="#data" id="<?php echo $sheets->labref;?>" class="inline1">Assign Draft Certificate</a></td> 

                            <?php } ?>
                             <td > <?php echo $sheets->date_time_returned;?></td> 

                           
                           
                   

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <div id="data">
            <form id="popup" >
                <div class="selecterror">Please select a Certificate Draft Reviewer!</div>
                <table>
                    <tr>
                        <th>Draft Reciewer's Name </th> 
                    </tr>
                    <tr><td>
                            <select name="director" required id="reviewer">
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
                    url: "<?php echo base_url(); ?>assign/getAJAXDdirector/",
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
                $('#reviewer').change(function(){
                    //alert(1);
                    name=$('#reviewer option:selected').text();
                    $('#revname').val(name);
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
                                    window.location.href = '<?php echo base_url(); ?>request_management/review_samples/';
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

            });

        </script>


    </script>
</html>