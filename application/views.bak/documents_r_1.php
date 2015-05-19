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

<legend><a href="<?php echo site_url() ."documentation_rejects/home/"; ?>">Rejected Samples by Reviewer </a>&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation_rejects/fromDDirector/"; ?>">Rejected Samples by D. Director&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation_rejects/fromDirector/"; ?>">Rejected Samples From The Director </a>&nbsp;||&nbsp;</a></legend><div>&nbsp;</div>
        <div class="success">Success: Worksheet was successfully assigned for review</div>
        <div class="error">Error: Worksheet could not be assigned for review now, Please try again later!</div>
        <div class="content4">
            <table id = "refsubs">
                <thead>
                    <tr>
                        <th>Labreference (.xlsx)</th>
                        
                        <th></th>
                         <th>Reviewer Name</th>
                         <th>Reviewer ID</th>
                           

                        <th>Date Time Rejected</th>
                        <th>Priority</th>

                        
                    </tr>
                </thead>
                <tbody class="tablebody">


                    <?php foreach ($documentation_data as $sheets) : ?>	

                        <tr>
                            <td><?php echo $sheets->folder ?></td>

                            <td  class="bold assign" ><strong><em><?php echo $sheets->folder ?></em></strong>&nbsp;&nbsp;&nbsp;<?php echo anchor('assign/assing_reviewer/' . $sheets->folder, 'Assign') ?></td>
                            <td></td>
                            <td><?php echo $sheets->director_id ?></td>                          
                            <td><?php echo $sheets->time_done?></td>
                            <?php if($sheets->priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>

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
                iGroupingColumnIndex: 1,
                sGroupingColumnSortDirection: "asc",
                iGroupingOrderByColumnIndex: 1,
                //bExpandableGrouping:true,
                //bExpandSingleGroup: true,
                iExpandGroupOffset: -1

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