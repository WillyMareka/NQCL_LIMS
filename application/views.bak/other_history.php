
<legend class ="misc_title"> Client & Test History</legend>

<hr />

<table class="other_history">
	<thead>
		<tr>
		<th>Client Name</th>
		<th>Client Address</th>
		<th>Client Type</th>
		<th>Contact Person</th>
		<th>Contact Phone</th>
		<th>Tests Selected</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $chistory['Name'] ?></td>
			<td><?php echo $chistory['Address'] ?></td>
			<td><?php echo $chistory['Client_type'] ?></td>
			<td><?php echo $chistory['Contact_person'] ?></td>
			<td><?php echo $chistory['Contact_phone'] ?></td>
			<td><?php echo count($thistory) . " " ;  foreach($thistory as $thist) { echo $thist['Name'] . ", "; }?></td>
		</tr>
	</tbody>
</table>


<script>
$(document).ready(function(){
 $('.other_history').dataTable({
    //"bJQueryUI": true,
    "sDom": 't'
    })
  })  
</script>


