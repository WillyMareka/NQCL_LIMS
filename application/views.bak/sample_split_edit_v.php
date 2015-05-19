<html lang ="en">
	
<legend><a href="<?php echo site_url()."sample_issue/issued_listing"; ?>" >Samples Issued Listing</a>
&nbsp;&rarr;&nbsp;Sample Split & / Re-issue&nbsp;&rarr;&nbsp;<?php $reqid = $this -> uri -> segment(3); echo $reqid; ?></legend>

<hr />

<?php 
$units = $split_pending = Sample_issuance::getSplits($reqid);
 
if(count($units) > 1){
	
$splitstatus = 1;	
	
}
else {
	
	$splitstatus = 0;
}
//$split_pending = Sample_issuance::getSplits($reqid);

?>

<?php for ($i=0; $i < count($units) ; $i++) { 

$user_type = 1;	
$unit_id = $units[$i]['Department_id'];
$analysts = User::getAnalysts2($reqid, $user_type);

$unit1= $this -> uri -> segment(5);
$unit2= $this -> uri -> segment(6);
$unit3= $this -> uri -> segment(7);

$unitsarray = array($unit1,$unit2, $unit3);

if(!in_array($unit_id, $unitsarray) ){

?>

<legend id="unit"><?php 
 
switch ($unit_id) {
	case 1:
		
		echo "Wet Chemistry Unit";
		
		break;
	
	case 2:
		
		echo "Biological Analysis Unit";
	
		break;
	
	case 3:
		
		echo "Medical Devices Unit";
	
		break;	
		
	default:
		
		echo "";
		
}
	
	
?></legend>

<hr />

<?php 
$attributes = array('id' => 'entry_form');
echo form_open('sample_issue/update/',$attributes);
echo validation_errors('<p class="error">', '</p>');
?>


<table class="issues" >
	
<!--tr><td colspan="4" ><hr></td></tr-->	

<thead>
<tr>
<th>Samples Available</th>
<th>Samples Issued</th>
<th>Samples Returned</th>
<th>Samples to Re-Issue</th>
<th>Analyst</th>
<th>Re-assign Notes</th>
<th>Assign</th>
</tr>
</thead>



<tbody>
<tr class="unitrows">
	<td class="samples_available"><span id ="<?php echo $sample_listing[0]['sample_qty']; ?>"><?php echo $sample_listing[0]['sample_qty']; ?></span></td>
	<td class="samples_issued"><span><?php echo $sample_issues[$i]['Samples_no'] ?></span></td>
	<td class="samples_returned"><input type="text" id="samples_returned" name="samples_returned" required /></td>
	<td class ="samples2issue"><input type="text" id="samples2issue" name="samples_no" required /></td>
	<td>
		<span>
			<select name="analyst_id" id="analyst">
				<!--option value="" >Select Analyst</option-->
				<?php foreach($analysts as $analyst){?>
					<option value="<?php echo $analyst['id']; ?>" <?php if( $analyst['id'] == $sample_issues[$i + 1]['Analyst_id']){ echo "selected"; } else{ echo "";} ?>  ><?php echo $analyst['fname'] ." ".$analyst['lname']; ?></option>
				<?php }  ?>	
			</select>
		</span>
	</td>
	
	<td><textarea name="edit_notes" required ><?php echo $sample_issues[$i + 1]['Edit_notes'] ?></textarea></td>
	<input type="hidden" name="aid" id="analyst_id" value="<?php echo $sample_issues[$i + 1]['Analyst_id'] ?>" />
	<input type="hidden" name="version_id" value="<?php echo $sample_issues[$i + 1]['Version_id'] + 1 ?>" />
	<input type="hidden" name="issues_version_id" value="<?php echo $sample_issues[$i + 1]['Version_id']  ?>" />
	<input type="hidden" name="issued_samples_no"  value="<?php echo $sample_issues[$i + 1]['Samples_no']  ?>" />
	<input type="hidden" name="dept_id" value="<?php echo $unit_id ?>"/>
	<input type="hidden" name="lab_ref_no" value="<?php echo $reqid ?>"/>
	<input type="hidden" name="upd_samples_qty" class ="s_avail" value="<?php echo $sample_listing[0]['sample_qty']?>"/>
	<input type="hidden" name="status_id" value= "2"/>
	<input type="hidden" name="splitstatus" value="<?php echo $splitstatus; ?>"/>
	<input type="hidden" name="tests_version_id" value="<?php echo $tests[0]['version_id']; ?>" />
	<input type="hidden" name="req_version_id" value="<?php echo $sample_listing[0]['version_id'] ?>" />
	<td><input type ="submit" class="submit-button" value="Re-assign"/></td>
	
	
</tr>
</tbody>
</table>

<?php echo form_close(); ?>
<?php } ?>
<?php } ?>


<script>
$(function(){
	
	$('.issues').dataTable({ 
	"bPaginate":false,
	"bJQueryUI":true,
	"bSortClasses":false,
	"bSort":false,
	"bFilter":false,
	"sDom":'t',
	"bRetrieve":true
	
	});
	
	
 	
	
	
  $('.unitrows').each(function(i){
  	
  $('.samples2issue input').eq(i).keyup(function(){
  	
  	var s_avail = $('.samples_available span').eq(i).text();

  	var s_a = parseInt($('.samples_available span').attr('id'));
  	
    var samples_a = parseInt(s_avail);
  	
  	if($(this).val() > samples_a ) {
  	
  	alert("Samples to Issue must be less than Samples Available.");
  	
  	$(this).val(0);

  	//$('.samples_available span').eq(i).text(s_a);

  	}
  	
  	else if ($(this).val() < 0) {
  		
  	alert("Samples to Issue cannot be less than zero.");
  		
  	$(this).val(0);

  	//$('.samples_available span').eq(i).text(s_a);
  	
  	}	
  	
  	else
    {
    	var diff = parseInt($('.samples_available span').eq(i).text()) - $(this).val();
    	
    	//$('.samples_available span').eq(i).text(diff);


     if($('.unitrows').length == 2){
     
     //$('.samples_available span').eq(i).text(diff);
     $('.samples_available span').eq(i+1).text(diff);
     $('.samples_available span').eq(i-1).text(diff); 	
  	}
  	
  	
  	else if ($('.unitrows').length == 3) {
  	
  	$('.samples_available span').eq(i+1).text(diff);
  	$('.samples_available span').eq(i+2).text(diff);
    $('.samples_available span').eq(i-1).text(diff); 	
  	$('.samples_available span').eq(i-2).text(diff);
  	}	
  		
  	}
  	
  	});

 $('.samples_returned input').eq(i).keyup(function(){

 	var s_avail = $('.samples_available span').eq(i).text();
 	var s_2issue = $('.samples_issued span').eq(i).text();
 	var samples_i = parseInt(s_2issue);
 	var s_avail2 = parseInt(s_avail);
 	var s_a = parseInt($('.samples_available span').attr('id'));


 	var s_return = $(this).val();


  	if(s_return > samples_i ) {
  	
  	var diff_gt = s_return - samples_i
  	alert("Samples Returned must be less than Samples Issued");
  	
  	$(this).val(0);

  	$('.samples_available span').eq(i).text(s_a);
  	
  	}

  	else if (s_return <  0 ){

  	alert("Samples Returned cannot be less than zero.");
  	
  	$(this).val(0);

  	$('.samples_available span').eq(i).text(s_a);

  	}

  	else if(s_return <= samples_i ){

  	if(s_return > 0) {
	var diff = samples_i - s_return;
	var sum = s_a + parseInt($(this).val());

		$('.samples_available span').eq(i).text(sum);
		$('.samples_available span').eq(i+1).text(sum);
		$('.samples_available span').eq(i-1).text(sum);
		$('.samples_available span').eq(i+2).text(sum);
		$('.samples_available span').eq(i-2).text(sum);
	//$('.samples2issue input').eq(i).val(diff);  		

	}

	else {

		$('.samples_available span').eq(i).text(s_a);
		$('.samples_available span').eq(i+1).text(s_a);
		$('.samples_available span').eq(i-1).text(s_a);
		$('.samples_available span').eq(i+2).text(s_a);
		$('.samples_available span').eq(i-2).text(s_a);

	}


  	}

 })



	});
})	
</script>


</html>

