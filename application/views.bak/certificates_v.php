<html>
    <style>
          tr.even:hover td,
        #mtTable tr.even:hover td,
        #mtTable tr.even:hover td.sorting_1 { background-color: #00CC33;
                                              border-top: 2px solid #00CC33;
                                              border-bottom: 2px solid #00CC33; }

        tr.odd:hover td,
        #mtTable tr.odd:hover td,
        #mtTable tr.odd:hover td.sorting_1 { background-color: #00CC33;
                                             border-top: 2px solid #00CC33;
                                             border-bottom: 2px solid #00CC33; }
    </style>
    
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url()."javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js"?>"></script>
	

<legend><a href="<?php echo base_url().'analyst_controller'; ?>" >Home</a></legend>
<hr />

<div class="rightside">

</div>



<div>
	<table id="tests2" class="sample_listing">
	<thead>
		<tr id="samples_l_th">
			<th>Number</th>
                        <th><a id="lab_r" href="#" >Final COA</a></th>
			
		</tr>
	</thead>
	<tbody>	
		 <?php for($i=1; $i<count($samples); $i++){?>
                <tr>
                    <td class="green_bold"><a href='#'>Web Display Number <?php echo $i ;?></a>
                    <td class="green_bold"><a href='<?php echo site_url() . "coa/analyst_coa_view/" . $samples[$i]->labref;?>'><?php echo $samples[$i]->labref ;?></a>
               
 <?php  }  ?>
		    </td>
                </tr>
		</tbody>
	</table>	
</div>
	<script>
	$(document).ready(function() {
    $('#tests2').dataTable({
    	"bJQueryUI": true,
    	"asStripClasses": null
        
    });
		} );
	</script>
	
	
	
</html>