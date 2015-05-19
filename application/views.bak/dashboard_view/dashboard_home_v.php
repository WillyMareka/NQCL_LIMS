
<div class="grid_10">
    <div class="box round first">
        <h2>
            Statistics</h2>
        <div class="block">
            <div id="chart1">
            </div>
        </div>
    </div>
    <div class="box round">
        <h2>
            Sample & Clients</h2>
        <div class="block">
            <div class="stat-col">
                <span>All Samples Registered</span>
                <p class="purple">
                    <?php echo $all_samples - 1; ?></p>
            </div>

            <a href="<?php echo base_url() ?>dashboard_control/sample_assignments"> <div class="stat-col">
                    <span>Assigned Samples</span>
                    <p class="blue">
                        <?php echo $all_assigned[0]->numrows; ?></p>
                </div></a>
            <div class="stat-col">
                <span>Unassigned Samples</span>
                  <p class="yellow">
                    <?php echo $all_unassigned[0]->numrows - 1; ?></p>
            </div>
            <div class="stat-col">
                <span>Urgent Samples</span>
                <p class="red">
                    <?php //echo $all_urgent[0]->numrows;?></p>
            </div>
            <div class="stat-col">
                <span>Total No. of Clients</span>
                <p class="yellow">
                    <?php //echo $all_clients; ?></p>
            </div>

            <div class="clear">
            </div>
        </div>
    </div>
</div>
<div class="grid_5">
    <div class="box round">
        <h2>
            Populate Later</h2>
        <div class="block">
            <p class="start">
            </p>
        </div>
    </div>
</div>
<div class="grid_5">
    <div class="box round">
        <h2>
            Populate Later</h2>
        <div class="block">
            <p class="start">

            </p>
        </div>
    </div>
</div>