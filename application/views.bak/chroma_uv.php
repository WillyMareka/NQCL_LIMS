<html>
	<div>
	<legend title="Click to expand."><a id="eqpmnt_show" class="div_show" href="#"><span id="eqmnt_plus">+</span>&nbsp;Monograph Information</a></legend>

	<div class="monograph_info hidden2">
	<hr / >
	<table id="tests">
		<thead>
			<tr>
				<th>Monograph</th>
				<th>Lower Limit</th>
				<th>Upper Limit</th>
				<th>Volume & Year</th>
				<th>Page</th>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td> 
				<select>
				<option value="USP" >USP</option>
				<option value="USP" >BP</option>
				<option value="USP" >Eur</option>
				<option value="USP" >Intl.</option>	
				</select> 
				</td>
				<td><input type="text" name="lower_limit"  required /></td>
				<td><input type="text" name="upper_limit"  required /></td>
				<td><input type="text"  name="vol"  required/></td>
				<td><input type="text"  name="page"  required/></td>
			</tr>
		</tbody>
		
	</table>
	</div>
</div>	
	
	
	
<!--div>
<legend>
<a id="standardprep" class="div_show" href="#">
<span class="minus_plus">+</span>&nbsp;Standard Preparation</a>
</legend>

<div class="hidden2" >
<hr />
<textarea class="chromaconditions" required ></textarea>
</div>

</div-->	
	
	
<!--div>
<legend>
<a id="sampleprep" class="div_show" href="#">
<span class="minus_plus">+</span>&nbsp;Sample Preparation</a>
</legend>

<div class="hidden2" >
<hr />
<textarea class="chromaconditions" required ></textarea>
</div>

</div-->	
	

<div>
	
	<legend title="Click to expand."><a id="eqpmnt_show" class="div_show" href="#"><span id="eqmnt_plus">+</span>&nbsp;Equipment Used</a></legend>
	
<div id = "equipment" class="hidden2" >
	<hr />
    <form name="" action="" method="">
        <table border="0" cellpadding="0" cellspacing="0" id="tests">
            
            <thead>
            <tr>
                <th>No.</th>
                <th>Equipment Name</th>
                <th>Date of Last Calibration</th>
                <th>Date of Next Calibration</th>
                <th>Remarks</th>
            </tr>
            </thead>
            
            <tbody id="eqpmnt_tbody" ></tbody>
        </table>
    </form>
</div>
</div>
<!--div id="items">Data</div-->

<div>
<legend title="Click to expand."><a id="chems_show" class="div_show" href="#"><span class="minus_plus">+</span>&nbsp;Chemicals Used</a></legend>
	
<div class="hidden2">
	<hr />
    <form name="" action="" method="">
        <table border="0" cellpadding="0" cellspacing="0" id="tests">
            <thead>
            <tr>
                <th>No.</th>
                <th>Reagent Name</th>
                <th>Manufacturer</th>
                <th>Lot/Batch No.</th>
                <th>Opened Date</th>
                <th>Expiry Date</th>
                <th>Remarks</th>
            </tr>
            </thead>
            
            <tbody id="chems_tbody" ></tbody>
        </table>
      </form>
</div>
</div>




<div>	
	
<legend>
	<a id="references_show" class="div_show" href="#">
		<span class="minus_plus">+</span>&nbsp;Reference Standards</a>
</legend>

	
<div id = "references" class="hidden2" >
 <hr />
    <form name="" action="" method="">
        <table border="0" cellpadding="0" cellspacing="0" id="tests">
            <thead>
            <tr>
                <th>No.</th>
                <th>Reference Substance</th>
                <th>Lot/Batch No.</th>
                <th>Potency</th>
                <th>Expiry Date</th>
            </tr>
            </thead>
            
            <tbody id="refs_tbody" ></tbody>
        </table>
    </form>
</div>
</div>

<div>
<legend>
<a id="chroma_conditions" class="div_show" href="#">
<span class="minus_plus">+</span>&nbsp;UV System</a>
</legend>

<div class="hidden2">
<hr />
<table id="tests">
	<tr>
		<td><label for="wave_length" >Wavelength of Absorption</label></td><td><input type="text" name="wavelength" required ></td>
	</tr>	
</table>


</div>

</div>

	
<script>
        $(document).ready(function(){      
            
              $.ajax({  
                url:'<?php echo base_url(); ?>/equipments/get_equipment_names/',
                type:'POST',  
                dataType: 'json',
                success: function( json ) {        
                    $.each(json,function(key,val) {
                        $('select.ename').append('<option value="'+ key + '">' + val + '</option>');
                    });
                }
            });
   
   			$('.div_show').click( function(){
   				
   				$(this).parent().next().slideToggle();
   				
   			
   			});
   			
   			
   
   
   			var refs_tr_count = 5;
   			var tr_count = 8;
   			//var tr_var = 
   			for(var i = 1; i <= tr_count; i++){
   				
   				$( "<tr class=''>" +
                "<td id = 'number' ><span>"+i+"</span></td>" + "<td><select name='ename"+i+"' id= 'ename"+i+"' class='ename'>"
                 + "<option value=''>-Select Name-</option></select></td>"
                 + "<td><input type='text' name='lcdate"+i+"' id='lcdate"+i+"' class='date' readonly /></td>"
                 + "<td><input type='text' name='ncdate"+i+"' id='ncdate"+i+"' class='date' readonly /></td>"
                 + "<td><input type='text' name='remarks"+i+"' id='remarks"+i+"' /></td>"
                 + "</tr>" ).appendTo('#eqpmnt_tbody');
   		 
   		  $("<tr>" +
                "<td>"+i+"</td>"
                 + "<td><select name='rname"+i+"' id='rname"+i+"' class='rname'>"
                 + "<option value=''>-Select Name-</option>"
                 + "</select></td>"
                 + "<td><select name=mnfgname"+i+" id='mnfgname"+i+"' class='mnfgname'>"
                 + "<option value=''>-Select Name-</option>"
                 + "</select></td>"
                 + "<td><input type='text' name='lbatch"+i+"' id='lbatch"+i+"' /></td>"
                 + "<td><input type='text' name='opdate"+i+"' id='opdate"+i+" class='date"+i+"'/></td>"
                 + "<td><input type='text' name='edate"+i+"' id='edate"+i+"' class='date"+i+"'/></td>"
                 + "<td><input type='text' name='remarks"+i+"' id='remarks"+i+"' /></td>" +
            "</tr>").appendTo("#chems_tbody")
   		  
   		   }
   		   
   		   for(var i =1; i<=refs_tr_count; i++){
   		   	
   		   	$("<tr>" +
    			"<td>"+i+"</td>"
    			+ "<td><select name='refsu"+i+"' id='refsu"+i+"' class='rname'>"
                + "<option value=''>-Select Name-</option>"
                + "</select></td>"
    			+ "<td><input type='text' name='nqclbc"+i+"' id='nqclbc"+i+"'></td>"
    			+ "<td><input type='text' name='potency"+i+"' id='potency"+i+"'></td>"
    			+ "<td><input type='text' name='expdate"+i+"' id='expdate"+i+"'></td>"
  				+ "</tr>").appendTo("#refs_tbody");
   		   }
   		   
   		   
    
        });
    </script>	
	
<input type="submit" value="Save" class="submit-button"/>	
</html>