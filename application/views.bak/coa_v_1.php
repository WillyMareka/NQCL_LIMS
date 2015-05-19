<?php
$data=array('Aata 1',' Rata 2','Cata 3','Data 4');
$data1=array('Weight','HPLC','UV','TITRATION');
?>
<div>
<table width="503" height="278" border="1">
        <tr align="center" valign="middle">
            <td height="34" align="center" valign="middle" id="side"><strong>TEST</strong></td>
            <td align="center" valign="middle"><strong>METHOD</strong></td>
            <td align="center" valign="middle"><strong>COMPEDIA</strong></td>
            <td align="center" valign="middle"><strong>SPECIFICATION</strong></td>
            <td align="center" valign="middle"><strong>DETERMINED</strong></td>
            <td align="center" valign="middle" id="side"><strong>REMARKS</strong></td>
        </tr>
        <?php  foreach ($tests_requested as $value) :?>
        <tr>
            <td height="56" align="center" valign="middle" id="side"><textarea name="compedia[]" cols="10"><?php echo @$_POST['compedia']?></textarea></td>
            <td align="center" valign="middle">Weight</td>
            <td align="center" valign="middle"><textarea name="compedia[]" cols="10"></textarea></td>
            <td align="center" valign="middle"><textarea name="specification[]" cols="10"></textarea></td>
            <td align="center" valign="middle">None Deviate</td>
            <td align="center" valign="middle" id="side">COMPLIES</td>
        </tr>
        <?php endforeach;?>
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
<div>
    </p>

