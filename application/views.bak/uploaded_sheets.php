<html>
    <script>
      $(document).ready(function(){
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
            text-align: center;
            padding-top: 1px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        
        
    </style>
    <link rel="stylesheet" 
          type="text/css" media="screen" href="<?php echo base_url(); ?>javascripts/source/jquery.fancybox.css" />
    <div class ="content">
       
        <legend><a href="<?php echo site_url() . "uploaded_worksheets/"; ?>">Upload Home</a></legend>
        <div>&nbsp;</div>
         <div class="success">Success: Worksheet was successfully assigned for review</div>
          <div class="error">Error: Worksheet could not be assigned for review now, Please try again later!</div>
        <table id = "refsubs">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Lab Reference No</th>
                    <th>Uploaded By</th>

                    <th>Date & Time</th>
                    <th>Assign</th>

                </tr>
            </thead>
            <tbody>


                <?php foreach ($worksheets as $sheets) : ?>	

                    <tr>
                        <td><?php echo $sheets->filename ?></td>

                        <td  class="bold assign" href ="#showreviewer"><?php echo $sheets->nqcl_number ?>&nbsp;&nbsp;&nbsp;<?php echo anchor('assign/assing_reviewer/' . $sheets->nqcl_number, 'Assign') ?><a id="inline" href="#data">Assign1</a><input type="hidden" id="labref_no" value="<?php echo $sheets->nqcl_number; ?>"/></td>

                        <td><?php echo $sheets->uploaded_by ?></td>

                        <td><?php echo $sheets->datetime_uploaded ?></td>
                        <td></td>                        
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div id="data">
        <form id="popup">
            <div class="selecterror">Please select a reviewer first!</div>
            <table>
                <tr>
                    <th>Reviewer Name </th> 
                </tr>
                <tr><td>
                        <select name="reviewer" required id="reviewer">
                            <option value="">--Select Reviewer--</option>              

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
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/source/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript">
   
    
    $('#refsubs').dataTable({
            "bJQueryUI": true
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
            $("a#inline").fancybox({
                maxWidth: 280,
                maxHeight: 145,
                fitToView: true,
                width: '70%',
                height: '70%',
                autoSize: false,
                closeClick: false

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
            var rev=$('#reviewer').val();
            if(rev==''){
                $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
               return true; 
            }else{
               
              
                var labref = $('#labref_no').val();
                var data1 = $('#popup').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assign/sendSamplesFolder/" + labref,
                    data: data1,
                    success: function(data)
                    {
                        
                        
                        $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                        $.fancybox.close();
                        var delay=3000;
                        setTimeout(function(){
                        window.location.href = "<?php echo base_url(); ?>Uploaded_Worksheets";
                        },delay);
                        
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