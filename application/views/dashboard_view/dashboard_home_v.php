<script>



    $(document).ready(function() {

        //Dashboard chart
        function setupDashboardChart(containerElementId) {


            array = [];
            data =<?php echo json_encode($assigned); ?>;
            $.each(data, function(i, d) {
                array.push(parseInt(d.total));
            });
            console.log(array);

            array1 = [];
            data1 =<?php echo json_encode($unassigned); ?>;
            $.each(data1, function(i, d) {
                array1.push(parseInt(d.total));
            });
            console.log(array1);

            array3 = [];
            data3 =<?php echo json_encode($all); ?>;
            $.each(data3, function(i, d) {
                array3.push(parseInt(d.total));
            });
            console.log(array3);





            var s1 = array;
            //console.log(s1);

            var s2 = array1;
            var s3 = array3;
            //var s4 = [data];
            // Can specify a custom tick Array.
            // Ticks should match up one for each y value (category) in the series.
            var ticks = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            var plot1 = $.jqplot(containerElementId, [s1, s2, s3], {
                // The "seriesDefaults" option is an options object that will
                // be applied to all series in the chart.
                seriesDefaults: {
                    renderer: $.jqplot.BarRenderer,
                    rendererOptions: {
                        fillToZero: true
                     
                    }
                },
                // Custom labels for the series are specified with the "label"
                // option on the series option.  Here a series option object
                // is specified for each series.
                series: [
                    {label: 'Assigned'},
                    {label: 'Unassigned'},
                    {label: 'All'},
                    //{ label: 'All' }
                ],
                // Show the legend and put it outside the grid, but inside the
                // plot container, shrinking the grid to accomodate the legend.
                // A value of "outside" would not shrink the grid and allow
                // the legend to overflow the container.
                legend: {
                    show: true,
                    placement: 'outsideGrid'
                },    cursor:{
                          style: 'crosshair',
                          show: true,
                          zoom:true,
                          showTooltip:true,
                          followMouse: true,
                         showTooltipDataPosition :true,
                         showVerticalLine:true,
                         useAxesFormatters:true
                    },
                axes: {
                    // Use a category axis on the x axis and use our custom ticks.
                    xaxis: {
                        renderer: $.jqplot.CategoryAxisRenderer,
                        ticks: ticks
                    },
                    // Pad the y axis just a little so bars can get close to, but
                    // not touch, the grid boundaries.  1.2 is the default padding.
                    yaxis: {
                        pad: 1.05,
                        tickOptions: {formatString: '%d',
                          
                        },
                        min: 0
                    }

                }

            });
        }
//points charts


        setupDashboardChart('chart1');
    });
</script>
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