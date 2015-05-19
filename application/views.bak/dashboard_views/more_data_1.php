<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6}
</style>
<?php foreach ($info as $i);?>
<table class="tg">
  <tr>
      <th class="tg-031e" colspan="2"><strong><em><?php echo $i->request_id;?> DETAILS</em></strong></th>

  </tr>
<!--  <tr>
      <td class="tg-ugh9"><strong>CLIENT NAME:</strong></td>
    <td class="tg-ugh9"> Alphonce Ochieng</td>
  </tr>
  <tr>
    <td class="tg-031e"><strong>PRODUCT NAME:</strong></td>
    <td class="tg-031e">LAMBDAT Tablets</td>
  </tr>-->
  <tr>
    <td class="tg-ugh9"><strong>ACTIVE INGREDIENT(S):</strong></td>
    <td class="tg-ugh9"><strong><?php echo $i->active_ing;?></strong></td>
  </tr>
  <tr>
    <td class="tg-031e"><strong>QTY:</strong></td>
    <td class="tg-031e"><?php echo $i->sample_qty ." " .$i->name ;?></td>
  </tr>
  <tr>
    <td class="tg-ugh9"><strong>MANUFACTURER:</strong></td>
    <td class="tg-ugh9"><?php echo $i->manufacturer_name;?></td>
  </tr>
  <tr>
    <td class="tg-031e"><strong>MANUFACTURER ADDRESS:</strong></td>
    <td class="tg-031e"><?php echo $i->manufacturer_add;?></td>
  </tr>
<!--  <tr>
    <td class="tg-ugh9"><strong>BATCH NUMBER:</strong></td>
    <td class="tg-ugh9">ABC</td>
  </tr>-->
  <tr>
    <td class="tg-031e"><strong>LABEL CLAIM:</strong></td>
    <td class="tg-031e"><?php echo $i->label_claim;?></td>
  </tr>
  <tr>
    <td class="tg-ugh9"><strong>COUNTRY OF ORIGIN:</strong></td>
    <td class="tg-ugh9"><?php echo $i->country_of_origin;?></td>
  </tr>
  <tr>
    <td class="tg-031e"><strong>DESIGNATOR:</strong></td>
    <td class="tg-031e"><?php echo $i->dsgntr;?></td>
  </tr>
  <tr>
    <td class="tg-ugh9"><strong>SAMPLE CUSTODY:</strong></td>
    <td class="tg-ugh9"><?php echo $sl[0]->to;?></td>
  </tr>
  <tr>
      <td class="tg-031e" colspan="2">All rights reserved &COPY; <?php echo date('Y') ." " .$i->request_id; ?> NQCL </td>
    
  </tr>
</table>