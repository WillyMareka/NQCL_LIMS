<style>
    #gps_information{
        display: none;
        width: 290px;
        height: 220px;

    }
    label{
        font-weight: bold;
        display: block;
    }
    #an-sup{
        background: -webkit-linear-gradient(orange, yellow); /* For Safari */
        background: -o-linear-gradient(orange, yellow); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(orange, yellow); /* For Firefox 3.6 to 15 */
        background: linear-gradient(orange, yellow); /* Standard syntax (must be last) */
        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:18%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #an-doc{
        background: -webkit-linear-gradient(yellow,blue); /* For Safari */
        background: -o-linear-gradient(yellow,blue); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(yellow,blue); /* For Firefox 3.6 to 15 */
        background: linear-gradient(yellow,blue); /* Standard syntax (must be last) */
        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:37%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #sup{
        background: yellow; /* Standard syntax (must be last) */
        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:28%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }
    #doc{
        background: blue;/* Standard syntax (must be last) */
        text-align: center; 
        color: white; 
        font-weight: bolder; 
        width:45%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #rev{
        background: indigo; /* Standard syntax (must be last) */
        text-align: center; 
        color: white; 
        font-weight: bolder; 
        width:55%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }
    #doc2{
        background: violet;/* Standard syntax (must be last) */
        text-align: center; 
        color: white; 
        font-weight: bolder; 
        width:63%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #ddir{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:72%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: turquoise;
    }
        #sddir{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:82%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: skyblue;
    }
           #doc3{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:100%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: yellowgreen;
    }
          #doc31{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:100%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: lime;
    }
    
              #sec{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:10%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: orange;
    }

</style>
<legend><a href="<?php echo base_url(); ?>" >Home</a><div class="coding"> Key: 
        <span id="documentation" style="width: 4px;height: 4px;background-color: #FF3399">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Sample Recieving&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="analyst" style="width: 4px;height: 4px;background-color: orange">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Analyst&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="supervisor" style="width: 4px;height: 4px;background-color: yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Supervisor&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="documentation" style="width: 4px;height: 4px;background-color: blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Documentation - 2&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="reviewer" style="width: 4px;height: 4px;background: indigo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Reviewer&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="documentation" style="width: 4px;height: 4px;background: violet">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Documentation - 3&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="director" style="width: 4px;height: 4px;background: turquoise">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Draft Review&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="sdirector" style="width: 4px;height: 4px;background: skyblue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Director&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="documentation" style="width: 4px;height: 4px;background: greenyellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Documentation - 4&nbsp;&nbsp;&nbsp;&nbsp;
          <span id="documentation" style="width: 4px;height: 4px;background: lime">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Documentation - Final&nbsp;&nbsp;&nbsp;&nbsp;

    </div></legend>
<hr />
<div>
    <table id="tests2" class="sample_listing">
        <thead>                
            <tr id="samples_l_th">
                <th>No.</th><th>Sample</th><th>Location</th><th>Sample Progress</th><th>More</th><th>Priority</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach ($location as $gps): ?>
                <tr>

                    <td><?php echo $i; ?></td>
                    <td><?php echo $gps->labref ?></td>
                    <td><?php echo $gps->current_location ?></td>

                    <?php if ($gps->stage === '1') { ?>
                        <td style=" width:50x; padding: 0px; text-align: center; font-weight: bolder; color: black;"><div id="start" >0%.. Completed!</div></td>                   
                    <?php } else if ($gps->stage === '2') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="sec" >10%..</div></td>                   
        <!--                <td style="background: orange; text-align: center; color: black; font-weight: bolder;">9.09% Complete</td>-->
                    <?php } else if ($gps->stage === '3') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="an-sup" >20%..</div></td>
                    <?php } else if ($gps->stage === '4') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="sup" >30%..</div></td>                   
                    <?php } else if ($gps->stage === '5') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="an-doc" >40%..</div></td>
        <!--                        <td><span style="background: yellow; text-align: center; color: black; font-weight: bolder; width: auto" >36.36% Complete</span> || <span style="background: blue; text-align: center; color: white; font-weight: bolder;">36.36% Complete</span></td>-->
                    <?php } else if ($gps->stage === '6') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="doc" >50%..</div></td>
                    <?php } else if ($gps->stage === '7') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="rev" >60%..</div></td>
                    <?php } else if ($gps->stage === '8') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="doc2" >70%..</div></td>
                    <?php } else if ($gps->stage === '9') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="ddir" >80%..</div></td>
                    <?php } else if ($gps->stage === '10') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="sddir" >90%..</div></td>
                    <?php } else if ($gps->stage === '11') { ?>
                        <td style=" width:50x; padding: 0px;"><div id="doc3" >100% Completed!</div></td>
                    <?php } ?>
                        <td><a class="pop" href="#gps_information" id="<?php echo $gps->labref ?>">More</a><input type="hidden" id="labref" value=""/></td>
                    <?php if ($gps->priority === '1') { ?>
                        <td><span id="high">High</span></td>
                    <?php } else { ?>
                        <td><span id="low">Low</span></td>    
                    <?php } ?>
                </tr>
            <?php
            $i++;
            endforeach; ?>
        </tbody>
    </table>	
</div>
<div id="gps_information">



</div>
<script>
    $(document).ready(function() {
        $('#tests2').dataTable({
            "bJQueryUI": true,
            "asStripClasses": null,
            //"iDisplayLength": 1000

        });

    });


    $(document).ready(function() {
        $('.pop').click(function() {
            labref = $(this).attr('id');
            //alert(labref)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>sample_location/gps/" + labref,
                dataType: "json",
                success: function(data)
                {

                    $.each(data, function(id, info)
                    {

                        $('#gps_information').html("<label>CURRENT LOCATION</label>" + info.current_location + "<br><br><label> SAMPLE:</label> " + info.labref + "<br><br><label> ACTIVITY:</label> " + info.activity + "<br><br><label> FROM:</label>  " + info.from + "<br><br> <label>TO:</label>  " + info.to + "<br><br> <label>DATE:</label> " + info.date);


                        $.fancybox({
                            href: '#gps_information'

                        });


                    });


                    return true;
                },
                error: function(data) {



                    return false;
                }
            });
            return false;
        });

    });
</script>
<!--div id ="showreviewer">Choose Reviewer</div-->
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />