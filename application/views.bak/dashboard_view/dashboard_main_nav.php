       <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="<?php echo base_url()?>dashboard_control"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="javascript:"><span>Areas</span></a>
                    <ul>
                        <li><a href="<?php echo site_url("request_management");?>">Sample Requests</a> </li>
                        <li><a href="<?php echo site_url("request_management/assigned_samples");?>">Assigned Samples</a> </li>
                        <li><a href="<?php echo site_url("oos_sample");?>">OOS Samples</a> </li>
                        <li><a href="<?php echo site_url("supervisors");?>">My Samples</a> </li>
                        <li><a href="<?php echo site_url("inventory");?>">Inventory</a> </li>
                        <li><a href="<?php echo site_url("analyst_supervisor");?>">Assign Supervisors</a> </li>
                        <li><a href="<?php echo site_url("documentation/Home");?>">Done Samples</a> </li>
                        
                        <li><a href="<?php echo site_url("client_management");?>">Manage Clients</a> </li>
                        
                    </ul>
                </li>
                <li class="ic-typography"><a href="<?php echo base_url()?>dashboard_control/samples_location"><span>Sample Location</span></a></li>
				
                <li class="ic-grid-tables"><a href="<?php echo base_url()?>dashboard_control/samples"><span>Samples</span></a></li>
         
               		 
                
                <li class="ic-notifications"><a href="<?php echo base_url()?>dashboard_control/notifications"><span>Notifications</span></a></li>

            </ul>
        </div>