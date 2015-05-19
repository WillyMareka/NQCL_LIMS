<head> 
    <script type="text/javascript">
        $(document).ready(function() {
       
   
        var i = 1;
        var temp_array=new Array();
        temp_array[1]="method";
        temp_array[2]="compedia";
        temp_array[3]="specification";
        temp_array[4]="determined";
        temp_array[5]="complies";
        
       // $.each(temp_array,function(k,v){
            
       // });

            $('.addNew').live('click', function() {
                var count_val=1;
                $(this).closest('tr').find('td').each(function(i,v){
                    var count=parseFloat($(this).closest('td').parent()[0].sectionRowIndex)-1;
                    if(i>0){
                   $('<textarea class="clone"  id="p_new' + i + '" rows="1" cols="10" name='+temp_array[count_val]+'_'+count+'[]" value="" placeholder="COA" ></textarea><br />____________________').appendTo(v);
                    count_val++;
                }
                });
               
               // $('<tr class="clone"><td><textarea  id="p_new' + i + '" rows="1" cols="10" name="determined_'+count+'[]" value="" placeholder="I am New" ></textarea><a href="#" class="remNew">-</a><td> </tr>').appendTo($(this).parent('td'));
                

                return false;
            });
            
            $('.remNew').live('click', function() {
                $(this).closest('tr').find('.clone').each(function(i,v){
                    //if(i>0){
                        v.remove();
                     // $("._rows").current().find(".clone").remove();
                    //}
                });
                //return false;
            });
           //  tinymce.init({ selector: "textarea"});
        });
    </script>
    <style type="text/css">

        #COA{
            padding-right:25px;
            padding-left:25px;

        }
        #temp_table td{
            border: 1px solid black;
        }

        #side{
            background-color:#CCCCCC;
            font-size:11px;

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
            font-size:11px;
        }
        #wording{
            font-size: 10px;
        }
        textarea {
            vertical-align:middle;
            font-size: 12px;
          
        }
        .det{
              font-weight: bold;
        }
        #COA_AREA{
            margin: 0 auto 0 auto;
        }
        #hes{
            font-size: 10px;
        }
        #signatories{
            font-size: 10px;
        }
        textarea.special:first-line { 
       font-weight: bold; 
} 
       
    </style>
</head>
<center><p><?php echo 'CERTIFICATE OF ANALYSIS'; ?></p><br></center>
<center><?php echo 'CERTIFICATE No: CAN/' . date('Y') . '/' . $coa_number[0]->number; ?></center>
<p></p>
<p>
<div id="COA_AREA">
    <span id="COA">

        <?php
        $attr = array('id' => 'COAF');
        echo form_open('coa/saveCOA/' . $labref, $attr);
        ?>
        <table >
            <tr id="top_row">
                <td width="94" height="25" align="center" valign="middle"><span>PRODUCT</span></td>
                <td width="126" align="left"><?php echo $information[0]->product_name; ?></td>
                <td width="283" align="left" valign="middle"><span>REF. NO:</span>&nbsp;<?php echo $information[0]->request_id; ?></td>
            </tr>
            <tr>
                <td align="center" valign="middle" id="side"><span>DATE RECEIVED</span></td>
                <td rowspan="2" align="left" valign="top" id="label_name"><span>LABEL CLAIM</span></td>
                <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->label_claim; ?></td>
            </tr>
            <tr align="center" valign="middle">
                <td id="side"><?php echo $information[0]->designation_date; ?></td>
            </tr>
            <tr>
                <td align="center" valign="middle" id="side"><span>BATCH NO.</span></td>
                <td rowspan="2" align="left" valign="top" id="label_name"><span>PRESENTATION</span></td>
                <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->presentation; ?></td>
            </tr>
            <tr align="center" valign="middle">
                <td id="side"><?php echo $information[0]->batch_no; ?></td>
            </tr>
            <tr>
                <td align="center" valign="middle" id="side"> <span>MGF. DATE</span></td>
                <td rowspan="2" align="left" valign="top" id="label_name"><span>MANUFACTURER</span></td>
                <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->manufacturer_name; ?></td>
            </tr>
            <tr align="center" valign="middle">
                <td id="side"><?php echo $information[0]->manufacture_date; ?></td>
            </tr>
            <tr>
                <td align="center" valign="middle" id="side"><span>EXP. DATE</span></td>
                <td rowspan="2" align="left" valign="top" id="label_name"><span>ADDRESS</span></td>
                <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->manufacturer_add; ?></td>
            </tr>
            <tr align="center" valign="middle">
                <td id="side"><?php echo $information[0]->exp_date; ?></td>
            </tr>
            <tr>
                <td align="center" valign="middle" id="side">&nbsp;</td>
                <td rowspan="2" align="left" valign="top" id="label_name"><span>CLIENT</span></td>
                <td rowspan="2" align="left" valign="top" id="wording"><?php echo $information[0]->name . " " . $information[0]->address; ?></td>
            </tr>
            <tr align="center" valign="middle">
                <td id="side"><span>CLIENT REF NO</span></td>
            </tr>
            <tr>
                <td height="40" align="center" valign="middle" id="side"><?php echo $information[0]->clientsampleref; ?></td>
                <td align="left" valign="bottom" id="label_name"><span>TEST(S) REQUESTED</span></td>
                <td align="left" valign="bottom" id="wording"><?php echo $tests_requested; ?></td>
            </tr>
        </table>
        <p></p>

        <table width="490" height="278" border="1" id="temp_table">
            <tr align="center" valign="middle">
                <td height="34" align="center" valign="middle" id="side"><span>TEST</span></td>
                <td align="center" valign="middle"><span id="hes">METHOD</span></td>
                <td align="center" valign="middle"><span id="hes">COMPEDIA</span></td>
                <td align="center" valign="middle"><span id="hes">SPECIFICATION</span></td>
                <td align="center" valign="middle"><span id="hes">DETERMINED</span></td>
                <td align="center" valign="middle" id="side"><span>REMARKS</span></td>
            </tr>

            <?php
            for ($i = 0; $i < count($trd); $i++) {

                foreach ($coa_details as $coa) {

                    if ($coa->test_id == $trd[$i]->test_id) {
                        $determined = $coa->determined;
                        $remarks = $coa->verdict;
                    }
                }
                ?>

            <tr class="_rows">
                    <td height="56" align="center" valign="middle" id="side"><?php echo $trd[$i]->name ?>
                        <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                    </td>
                        
                    <td align="center" valign="middle">
                        <?php
                        $j = 1;
                        $myvals = explode(',', $trd[$i]->methods);
                        
                        foreach ($myvals as $option) {
                           $newoption= str_ireplace("(","&#10(",$option); 
                            echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="method_'.$i.'[]" value="" class="det" placeholder="Input Value" >' . trim($newoption) 
                                    . '</textarea>';
                            $j++;
                        }
                        ?>
                    </td>
                    <td align="center" valign="middle">
                        <?php
                        $j = 1;
                        $myvals = explode(',', $trd[$i]->compedia);
                        
                        foreach ($myvals as $option) {
                           $newoption= str_ireplace("(","&#10(",$option); 
                            echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="compedia_'.$i.'[]" value="" class="det" placeholder="Input Value" >' . trim($newoption) 
                                    . '</textarea>';
                            $j++;
                        }
                        ?>
                    </td>
                  
                    <td align="center" valign="middle">
                               <?php
                        $j = 1;
                        $myvals = explode(',', $trd[$i]->specification);
                        
                        foreach ($myvals as $option) {
                           $newoption= str_ireplace("(","&#10(",$option); 
                            echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="specification_'.$i.'[]" value="" class="det" placeholder="Input Value" >' . trim($newoption) 
                                    . '</textarea>';
                            $j++;
                        }
                        ?>
                        </td>
                    <td align="center" valign="middle" id="addinput">

                        <?php
                        $j = 1;
                        $myvals = explode(',', $trd[$i]->determined);
                        
                        foreach ($myvals as $option) {
                           $newoption= str_ireplace("(","&#10(",$option); 
                            echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="determined_'.$i.'[]" value="" class="det" placeholder="Input Value" >' .'&#32;&#32;&#32;&#32;&#32;'. trim($newoption) 
                                    . '</textarea>';
                            $j++;
                        }
                        ?>
                       
                                    

                    </td>
                    <td align="center" valign="middle" id="side">
                               <?php
                        $j = 1;
                        $myvals = explode(',', $trd[$i]->complies);
                        
                        foreach ($myvals as $option) {
                           $newoption= str_ireplace("(","&#32;&#32;&#32;&#32;&#10(",$option); 
                            echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="complies_'.$i.'[]" value="" class="det" placeholder="Input Value" >' . trim($newoption) 
                                    . '</textarea>';
                            $j++;
                        }
                        ?>
                    </td>
                </tr>
                </tr>
            <?php }; ?>

        </table>

        <p>
            <label>Conclusion</label><label id="side"><textarea name="conclusion" cols="20" rows="1"><?php echo $conclusion[0]->conclusion; ?></textarea></label>
        </p>
        <p>
        <table id="signatories" >
            <?php foreach ($signatories as $signatures): ?>            
                <tr>            
                    <td><?php echo $signatures->designation; ?>:</td>
                    <td><?php echo $signatures->signature_name; ?></td>
                    <td><?php echo $signatures->sign; ?></td>
                    <td>DATE: <?php echo $signatures->date_signed; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
</div>
 
        <?php echo form_close(); ?>
    </span>

    