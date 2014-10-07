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

    <script type="text/javascript" charset="utf-8" src="<?php echo base_url() . "javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js" ?>"></script>


    <legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>sample_requests" >Done Tests </a> </legend>
    <hr />

    <div class="rightside">

    </div>



    <div>
        <table id="tests2" class="sample_listing">
            <thead>
                <tr id="samples_l_th">
                    <th><a id="lab_r" href="#" >Lab Reference Number</a></th>
                    <th><a id="lab_r" href="#" >Download</a></th>

                </tr>
            </thead>
            <tbody>	
                <?php foreach ($labref as $link): ?>
                    <tr>
                        <td class="green_bold"><a href='<?php echo site_url() . "workbooks/".$link->labref."/" . $link->labref.".xlsx"; ?>'>Download Sample:<?php echo $link->labref.".xlsx";?></a></td>
                        <td class="green_bold"><a href='<?php echo site_url() . "analyst_uploads/worksheet/" . $link->labref; ?>'>Upload</a></td>
                    <?php endforeach; ?>

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