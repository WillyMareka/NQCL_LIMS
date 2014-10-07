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
        
                    tr.even:hover td,
#mtTable tr.even:hover td,
#mtTable tr.even:hover td.sorting_1 { background-color: #00CC33;
                                      border-top: 2px solid #00CC33;
                                      border-bottom: 2px solid #00CC33; }

tr.odd:hover td,
#mtTable tr.odd:hover td,
#mtTable tr.odd:hover td.sorting_1 { background-color: #00CC33;
                                      border-top: 2px solid #00CC33;
                                      border-bottom: 2px solid #00CC33; }


    </style>

    <div class ="content">
        
       

<legend><a href="<?php echo site_url() ."documentation/home/"; ?>">Analyzed Samples</a>&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation/reviewed/"; ?>">Reviewed Samples&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation/fromDirector/"; ?>">Samples From The Director </a>&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation_rejects/home/"; ?>"></a></legend>        <div>&nbsp;</div>
<hr>
 <p><legend>Done Samples &#187 Analyzed Samples</legend></p>
    
    <hr>

        <div class="success">Success: Worksheet was successfully assigned for review</div>
        <div class="error">Error: Worksheet could not be assigned for review now, Please try again later!</div>
        <div class="content4">
            <table id = "refsubs">
                <thead>
                    <tr>
                        <td></td>
                        <th>Labreference (Test Name) </th>
                        
                        <th>Date Time Uploaded</th>
                        
                        <th>Status | Action</th>
                        

                        
                    </tr>
                </thead>
                <tbody class="tablebody">

					
                    <?php foreach ($documentation_data as $sheets) : ?>	

                        <tr>
                            <td><?php echo $sheets->labref ?></td>
                         <?php 
                            if($sheets->test_name=='micro'){?>
                            <td><strong><em><?php echo $sheets->labref ;?> (Microbial Assay)</em></strong></td>   
                            <?php }else if($sheets->test_name=='microlal'){?>
                               <td><strong><em><?php echo $sheets->labref ;?> (Bacterial Endotoxin)</em></strong></td>  
                            <?php }else{ ?>
                               <td><strong><em><?php echo  $sheets->labref ."  (".  ucfirst(str_replace("_"," ",$sheets->test_name)) ?>)</em></strong></td>  
                           <?php } ?>                            
                           

<!--                            <td><?php echo $sheets->supervisor_name ?></td>

                            <td><?php echo $sheets->analyst_name ?></td>
                            <td><?php echo $sheets->test_name ?></td>
                            <td><?php echo $sheets->test_product ?></td>-->
                               
                            <td><?php echo $sheets->date_time_approved ?></td>
                            <?php 
                            if($sheets->assign_status =='0'){?>
                       <td  class="bold assign" style="background-color: yellow; font-weight: bolder;">Not Assigned || <?php echo anchor('assign/assing_reviewer/' . $sheets->labref.'/'.$sheets->test_product.'/'.$sheets->test_id.'/'.$sheets->id, 'Assign') ?></td>

                            <?php }else{ ?>
                        <td  class="bold assign" style="background-color: greenyellow; font-weight: bold;"  >Assigned || <?php  anchor('assign/assing_reviewer/' . $sheets->labref.'/'.$sheets->test_product.'/'.$sheets->test_id.'/'.$sheets->id, 'Assign') ?></td>

                  <?php } ?>

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
            }).rowGrouping({
            bExpandableGrouping: true,
            bExpandSingleGroup: false,
            iExpandGroupOffset: 1,
            asExpandedGroups: [""]
        });

            $(document).ready(function() {
                $('#data').hide();
                $("#inline1").fancybox({
           

                });
            });



            $(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assign/getAJAXReviewers/",
                    dataType: "JSON",
                    success: function(reviewers)
                    {

                        $.each(reviewers, function(id, city)
                        {
                            var opt = $('<option />'); // here we're creating a new select option for each group
                            opt.val(city.id);
                            opt.text(city.alias);
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
                                    window.location.href = '<?php echo base_url(); ?>documentation/home';
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