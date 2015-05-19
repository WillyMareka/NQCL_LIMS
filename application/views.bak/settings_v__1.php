<?php
if(!isset($quick_link)){
$quick_link = null;
}  
$userarray = $this->session->userdata;
$user_id = $userarray['user_id'];
$user_type = $userarray['usertype_id'];

?>

<?php if($user_type == 2) {?>
<div id="sub_menu">
<a href="<?php echo site_url('request_management');?>" class="top_menu_link sub_menu_link first_link  <?php if($quick_link == "request"){echo "top_menu_active";}?>">Requests</a>
<a href="<?php echo site_url("client_management");?>" class="top_menu_link sub_menu_link   <?php if($quick_link == "client"){echo "top_menu_active";}?>">Clients</a>
<a href="<?php echo site_url("test_controller");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "test"){echo "top_menu_active";}?>">Tests</a>
<a href="<?php echo site_url("sample_issue/listing");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Samples Listing"){echo "top_menu_active";}?>">Samples Unissued</a>
<a href="<?php echo site_url("sample_issue/issued_listing");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Samples Listing"){echo "top_menu_active";}?>">Samples Issued</a>
<a href="<?php echo site_url("inventory");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Inventory"){echo "top_menu_active";}?>">Inventory</a>
<a href="<?php echo site_url("quotation");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "quotation"){echo "top_menu_active";}?>">Quotation</a>
<a href="<?php echo site_url("proforma");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "proforma"){echo "top_menu_active";}?>">Proforma</a>
</div>
<?php }?>

<?php if($user_type == 4 || $user_type==5) {?>
<div id="sub_menu">
    <a href="<?php echo site_url("request_management");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Inventory"){echo "top_menu_active";}?>">Requests</a>
 <a href="<?php echo site_url("documentation/home");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Inventory"){echo "top_menu_active";}?>">Done Samples</a>
<a href="<?php echo site_url("inventory");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Inventory"){echo "top_menu_active";}?>">Inventory</a>
<a href="<?php echo site_url("supervisors");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "supervisors"){echo "top_menu_active";}?>">Supervisors</a>
<a href="<?php echo site_url("analyst_supervisor");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "an_su"){echo "top_menu_active";}?>">Assign Supervisor</a>
<a href="<?php echo site_url("client_management");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Add User"){echo "top_menu_active";}?>">Manage Clients</a>
   

</div>
<?php } ?>

<?php if($user_type == 2 || $user_type == 6){ ?>
<div id="sub_menu">
<a href="<?php echo site_url("user_registration_supervisor");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Add User"){echo "top_menu_active";}?>">Manage Users</a>
</div>
<?php }?>

<?php if($user_type == 29){ ?>
<div id="sub_menu">
<a href="<?php echo site_url("client_billing/trackSample");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Add User"){echo "top_menu_active";}?>">Track Sample</a>
<a href="<?php echo site_url("client_billing/viewRequests");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Add User"){echo "top_menu_active";}?>">View Invoice</a>
</div>
<?php }?>

<?php if($user_type == 24 || $user_type == 14){ ?>
<div id="sub_menu">
<a href="<?php echo site_url("finance_management/viewBills");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Add User"){echo "top_menu_active";}?>">View Bills</a>
<a href="<?php echo site_url("finance_management/dispatchRegister");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Add User"){echo "top_menu_active";}?>">Dispatch Register</a>
</div>
<?php }?>

<div id="main_content">
<?php
$this->load->view($settings_view);
?>
</div>
