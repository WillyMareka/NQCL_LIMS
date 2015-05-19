<head>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/js/jquery.dataTables.grouping.js' ?>" type="text/javascript"></script> 
</head>
<script>
    $(document).ready(function() {
        $('#coa_history_data').dataTable({
            "bSort": false,
            "bFilter": false,
            "bSearchable": false,
            "bInfo": false,
            "sScrollX": "100%",
            "iDisplayLength": 100
        });

        $("#coa_history_data tbody tr.data-in-table").each(function() {
            var $firstCell = $('td:eq(1)', this);
            var $secondCell = $('td:eq(2)', this);
            var $thirdCell = $('td:eq(3)', this);
            var $forthCell = $('td:eq(4)', this);
            var $fifthCell = $('td:eq(5)', this);
            var $sixthCell = $('td:eq(6)', this);
            var $seventhCell = $('td:eq(7)', this);
            var $eighth = $('td:eq(8)', this);
            var $ninth = $('td:eq(9)', this);
            var $tenth = $('td:eq(10)', this);


            if ($firstCell.text() === $secondCell.text()) {
                $firstCell.css('backgroundColor', 'azure');
                $secondCell.css('backgroundColor', 'azure');
            } else {
                $firstCell.css('backgroundColor', 'yellow');
                $secondCell.css('backgroundColor', 'yellow');
            }


            if ($thirdCell.text() === $forthCell.text()) {
                $thirdCell.css('backgroundColor', 'azure');
                $forthCell.css('backgroundColor', 'azure');
            } else {
                $thirdCell.css('backgroundColor', 'yellow');
                $forthCell.css('backgroundColor', 'yellow');
            }


            if ($fifthCell.text() === $sixthCell.text()) {
                $fifthCell.css('backgroundColor', 'azure');
                $sixthCell.css('backgroundColor', 'azure');
            } else {
                $fifthCell.css('backgroundColor', 'yellow');
                $sixthCell.css('backgroundColor', 'yellow');
            }


            if ($seventhCell.text() === $eighth.text()) {
                $seventhCell.css('backgroundColor', 'azure');
                $eighth.css('backgroundColor', 'azure');
            } else {
                $seventhCell.css('backgroundColor', 'yellow');
                $eighth.css('backgroundColor', 'yellow');
            }

            if ($ninth.text() === $tenth.text()) {
                $ninth.css('backgroundColor', 'azure');
                $tenth.css('backgroundColor', 'azure');
            } else {

                $ninth.css('backgroundColor', 'yellow');
                $tenth.css('backgroundColor', 'yellow');

            }
        });
    });

</script>
<div id="history">
    <table id = "coa_history_data">

        <thead>
            <tr>
                <th>No</th>
                <th>Old Method</th>
                <th>New Method</th>
                <th>Old Compedia</th>
                <th>New Compedia</th>
                <th>Old Specification</th>
                <th>New Specification</th>
                <th>Old Complies</th>
                <th>Old Determined</th>
                <th>New Determined</th>
                <th>New Complies</th>
                <th>Date Changed</th>
                <th>By</th>
                <th>Activity</th>
            </tr>
        </thead>

        <tbody>                



            <?php
            $i = 1;
            foreach ($changes_made as $change):
                ?>
                <tr class="data-in-table">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $change->old_method; ?></td>
                    <td><?php echo $change->new_method; ?></td>
                    <td><?php echo $change->old_compedia; ?></td>
                    <td><?php echo $change->new_compedia; ?></td>
                    <td><?php echo $change->old_specification; ?></td>
                    <td><?php echo $change->new_specification; ?></td>
                    <td><?php echo $change->old_determined; ?></td>
                    <td><?php echo $change->new_determined; ?></td>
                    <td><?php echo str_replace("_"," ",$change->old_complies); ?></td>
                    <td><?php echo str_replace("_"," ",$change->new_complies); ?></td>
                    <td><?php echo $change->log_date; ?></td>
                    <td><?php echo $change->who; ?></td>
                    <td><?php echo $change->activity; ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>

        </tbody>

    </table>
</div>