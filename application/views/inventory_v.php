<html>

<legend>
<a id ="home" href = "<?php echo site_url()."request_management"; ?>" title ="Request Managment" >Home</a>&nbsp;|&nbsp;
<a id ="refSubs" href = "<?php echo site_url()."inventory/refSubslist"; ?>" >Chemical Reference Substances</a>&nbsp;|&nbsp;
<a id ="equipment" href = "<?php echo site_url()."inventory/equipmentlist"; ?>">Equipment</a>&nbsp;|&nbsp;
<a id ="columns" href = "<?php echo site_url()."inventory/columnslist"; ?>" >Columns</a> &nbsp;|&nbsp;
<a id ="reagents" href = "<?php echo site_url()."inventory/reagentslist"; ?>" >Chemicals & Reagents</a>
</legend>



<div>&nbsp;</div>

<hr class ="hidden2" />

<script type="text/javascript">
$(function(){

/*$('a').each(function(){

$(this).click(function(e){

e.preventDefault();

$('a').removeClass('link_highlight');
$(this).addClass('link_highlight');

	$('.content').remove();

	var ref = $(this).attr("id");

	$.get("" + ref + "list" , function(i){
			
	$(i).insertAfter('hr');

})


})

})*/

})



</script>


</html>