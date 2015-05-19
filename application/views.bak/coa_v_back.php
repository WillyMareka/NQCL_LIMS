<head>

    <style type="text/css">

        #COA{
            padding-right:25px;
            padding-left:25px;
            
        }

        #side{
            background-color:#CCCCCC;
            font-size:12px;

        }
        #top_row{
            background-color:#CCCCCC;
        }
        table { 
            border-collapse:collapse;

        }
        p{
            margin-bottom: 0px;
            font-weight: bolder;
        }
        #label_name{
            font-size:13px;
        }
        #wording{
            font-size: 12px;
        }
    </style>
</head>
<center><p><?php echo 'CERTIFICATE OF ANALYSIS'; ?></p><br></center>
<center><?php echo 'CERTIFICATE No. ' . date('Y') . '/'; ?></center>
<p></p>
<p>
<div id="COA">
    
    <?php 
    $attr=array('id'=>'COAF');
    echo form_open('coa/saveCOA/'.$labref,$attr); 
    ?>
    <table >
        <tr id="top_row">
            <td width="94" height="25" align="center" valign="middle"><strong>PRODUCT</strong></td>
            <td width="126" align="left"><?php echo $information[0]->product_name; ?></td>
            <td width="283" align="left" valign="middle"><strong>REF. NO:</strong>&nbsp;<?php echo $information[0]->request_id; ?></td>
        </tr>
        <tr>
            <td align="center" valign="middle" id="side"><strong>DATE RECEIVED</strong></td>
            <td rowspan="2" align="left" valign="top" id="label_name""><strong>LABEL CLAIM</strong></td>
            <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->label_claim; ?></td>
        </tr>
        <tr align="center" valign="middle">
            <td id="side"><?php echo $information[0]->designation_date; ?></td>
        </tr>
        <tr>
            <td align="center" valign="middle" id="side"><strong>BATCH NO.</strong></td>
            <td rowspan="2" align="left" valign="top" id="label_name"><strong>PRESENTATION</strong></td>
            <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->presentation; ?></td>
        </tr>
        <tr align="center" valign="middle">
            <td id="side"><?php echo $information[0]->batch_no; ?></td>
        </tr>
        <tr>
            <td align="center" valign="middle" id="side"> <strong>MGF. DATE</strong></td>
            <td rowspan="2" align="left" valign="top" id="label_name"><strong>MANUFACTURER</strong></td>
            <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->manufacturer_name; ?></td>
        </tr>
        <tr align="center" valign="middle">
            <td id="side"><?php echo $information[0]->manufacture_date; ?></td>
        </tr>
        <tr>
            <td align="center" valign="middle" id="side"><strong>EXP. DATE</strong></td>
            <td rowspan="2" align="left" valign="top" id="label_name"><strong>ADDRESS</strong></td>
            <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->manufacturer_add; ?></td>
        </tr>
        <tr align="center" valign="middle">
            <td id="side"><?php echo $information[0]->exp_date; ?></td>
        </tr>
        <tr>
            <td align="center" valign="middle" id="side">&nbsp;</td>
            <td rowspan="2" align="left" valign="top" id="label_name"><strong>CLIENT</strong></td>
            <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->name . " " . $information[0]->address; ?></td>
        </tr>
        <tr align="center" valign="middle">
            <td id="side"><strong>CLIENT REF NO</strong></td>
        </tr>
        <tr>
            <td height="40" align="center" valign="middle" id="side"><?php echo $information[0]->clientsampleref; ?></td>
            <td align="left" valign="bottom" id="label_name"><strong>TEST(S) REQUESTED</strong></td>
            <td align="left" valign="bottom" id="wording"><?php echo $tests_requested; ?></td>
        </tr>
    </table>
    <p>

    <table width="503" height="278" border="1">
        <tr align="center" valign="middle">
            <td height="34" align="center" valign="middle" id="side"><strong>TEST</strong></td>
            <td align="center" valign="middle"><strong>METHOD</strong></td>
            <td align="center" valign="middle"><strong>COMPEDIA</strong></td>
            <td align="center" valign="middle"><strong>SPECIFICATION</strong></td>
            <td align="center" valign="middle"><strong>DETERMINED</strong></td>
            <td align="center" valign="middle" id="side"><strong>REMARKS</strong></td>
        </tr>
         
        <?php for ($i=0;$i<count($trd);$i++){ ?>
        
            <tr>
                <td height="56" align="center" valign="middle" id="side"><?php echo $trd[$i]->name ?></td>
                <td align="center" valign="middle">Weight</td>
                <td align="center" valign="middle"><textarea name="compedia[]" cols="10" value=""><?php echo $trd[$i]->compedia;?></textarea></td>
                <td align="center" valign="middle"><textarea name="specification[]" cols="10"><?php echo $trd[$i]->specification;?></textarea></td>
                <td align="center" valign="middle">None Deviate</td>
                <td align="center" valign="middle" id="side">COMPLIES</td>
            </tr>
        <?php }; ?>
             
    </table>
    <br>
    <p>
        <label>Conclusion</label><label id="side">The product complies with the specifications for the tests performed</label>
    </p>
    <p>
    <table width="500" border="1">
        <tr>
            <td height="26" align="center" valign="middle"><strong>ANALYST:</strong></td>
            <td>MR.CROTICH</td>
            <td>__________</td>
            <td align="center" valign="middle"><strong>DATE:09/05/2013 </strong></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><strong>ANALYST</strong></td>
            <td>DR. P. NJARIA</td>
            <td>__________</td>
            <td align="center" valign="middle"><strong>DATE:09/05/2013</strong></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><strong>ANALYST</strong></td>
            <td>DR. E. MBAE</td>
            <td>__________</td>
            <td align="center" valign="middle"><strong>DATE:09/05/2013</strong></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><strong>DIRECTOR</strong></td>
            <td>DR. H. K.CHEPKWONY</td>
            <td>__________</td>
            <td align="center" valign="middle"><strong>DATE:09/05/2013</strong></td>
        </tr>
    </table>

</p>
<?php    $button = array(
            'name' => 'genCOA',
            'id' => 'genCOA',            
            'content' => 'Genearate COA',
            'class'=>'submit-button'
        );
        echo form_button($button);?>
<?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#genCOA').click(function(){
         datastring = $('#COAF').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref;?>",
                            data: datastring,
                            success: function(data)
                            {
                                alert('COA DRAFTED');
                                // var content=$('.refsubs');
                                //$('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                               / //$.fancybox.close();


                                setTimeout(function() {
                                  window.location.href = '<?php echo base_url(); ?>documentation/reviewed';
                                }, 3000);

                                return true;
                            },
                            error: function(data) {
                                $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');
                                $.fancybox.close();


                                return false;
                            }
                        }); 
                        });
    });
</script>