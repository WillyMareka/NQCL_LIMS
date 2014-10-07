<html>
    <style>
                form input,select,textarea {
	//width: 70%;
	padding: 5px;
	border: 1px solid #d4d4d4;
	border-bottom-right-radius: 5px;
	border-top-right-radius: 4px;
	
	line-height: 1.5em;
	//float: right;
	
	/* some box shadow sauce :D */
	box-shadow: inset 0px 2px 2px #ececec;
}
form input:focus {
	/* No outline on focus */
	outline: 0;
	/* a darker border ? */
	border: 1px solid #bbb;
}
    </style>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url() . "javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js" ?>"></script>


    <legend><a href="<?php echo base_url().'analyst_controller'; ?>" >Home</a></legend>
    <hr />

    <div class="rightside">

    </div>



    <div>
        <table id="tests2" class="sample_listing">
            <thead>
                <tr id="samples_l_th">
                    <th><a id="lab_r" href="#" >Lab Reference Number</a></th>

                </tr>
            </thead>
            <tbody>	
                <?php foreach ($final_submission as $submissions): ?>
                    <tr>
                        <td class="green_bold"><a href='<?php echo site_url() . "final_Submission/loadsubmissions/" . $submissions->lab_ref_no; ?>'><?php echo $submissions->lab_ref_no; ?></a>
                        <?php endforeach; ?>
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
        });
    </script>



</html>