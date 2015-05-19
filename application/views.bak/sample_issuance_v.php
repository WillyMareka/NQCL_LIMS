

<!--div class="" id="confirm-dialog"><p class="alert">Confirm assignment?</p></div-->

<div class="view_content">
	
	<fieldset id="assign_tests" class="no_border">
		
	<legend><a href="<?php echo base_url(); ?>sample_issue/listing">Sample Listing Home</a>&nbsp;&rarr;&nbsp;Individual Sample Listing&nbsp;&rarr;&nbsp;<?php
	
	$reqid = $this -> uri -> segment(3);
	
	echo $reqid; ?></legend>
	
	<hr>
	
	<table id="tests">
	
		<tr>&nbsp;</tr>	
		
		<tr id="assign_tests_title" class="center_text" >
		<!--th>Limits</th--><th>Analyst</th><th>Department</th><th>Status</th><th>Tests</th>
		</tr>
		
		<tr>&nbsp;</tr>
	
		<?php 
		
		foreach($mytests as $test){?>
		
		<?php
		$attributes = array('id' => 'entry_form');
		echo form_open('sample_issue/save/'. $reqid . '/'.$test['id'],$attributes);
		echo validation_errors('
		<p class="error">', '</p>
		');
		?>
		
		<?php 
			
			$lab_ref_no = $reqid;
			
			$test_id = $test['id'];
			
			$status_check = Sample_issuance::getStatus($lab_ref_no, $test_id);
	
			$status = $status_check[0]['Status_id'];
	
			$analyst_id = $status_check[0]['Analyst_id'];
			

			$analyst_names = User::getAllUser($analyst_id);
			
			$analyst_name = $analyst_names[0]['fname'] ." ".$analyst_names[0]['lname']; 

			if($status != 1) {
		
		?>
		<!--form action="#" method="post" -->
		
	
		<tr id="assign_tests_body" class="testlist">	
			<!--div id="message"></div-->
			<!--td><input type="text" name="test_limit" placeholder="e.g 90%" required /></td-->
		
			<td class="a_name" >
			<label><span><?php echo $analyst_name; ?></span></label>
		
					
			</td>
		
			<td class="d_name" ><!--input type="text" readonly name="test_department" id="<?php //echo $departments[0]['id']; ?>" placeholder="" value="" required /-->
				<label id="dept_name"><span><?php echo $departments[0]['Name']; ?></span></label>
			</td>
	
			<!--td><input type="text" id="samples_no" name="samples_no" value="" placeholder="50" required/></td-->
			
			<td class="s_name">
			<label class="s_name"><span id="status_name" >Analyst</span></label>
			</td>	
			
			<td class="t_name" >
				<label id="test_name"><?php echo $test['Name']; ?></label>
			</td>
	</tr>
		
		<input type="hidden" id="test_id"  name="test_id" value= "<?php echo $test['id'];?>">
		<input type="hidden" id="department_id" name="department_id" value= "<?php echo $departments[0]['id'];?>">
		<input type="hidden" id="lab_ref_no" name="lab_ref_no" value= "<?php echo $reqid;?>">
		<input type="hidden" name="status_id" id="status_id" value= "2">
		
		</form>
		
		<?php } } ?>
		
	</table>
	
	
<script>

$(function() {

var tr_no = $('.testlist').length;

for(i=0; i<=tr_no; i++)  {
	
//alert($(".labref span").eq(i).text());
	
 if($(".s_name span").eq(i).text() == $(".s_name span").eq(i+1).text()){
        $(".s_name span").eq(i+1).addClass('hide');
        $(".t_name span").eq(i+1).addClass('hide');
        $(".d_name span").eq(i+1).addClass('hide');
        $(".a_name span").eq(i+1).addClass('hide');
       // $('<hr>').appendTo(".hline:eq("+(i+1)+")");
        //$('.number').eq(i).text(i+1+".");
    }
    
    else {
    	
    	//$('.number').eq(i+1).text(i+1+".");
    }
}
});

</script>
	
	
</fieldset>
</div>
