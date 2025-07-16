@php
defined('BASEPATH') OR exit('No direct script access allowed');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title', 'Welcome to Application')</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/global_assets/css/icons/icomoon/styles.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/bootstrap_limitless.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/layout.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/components.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/colors.min.css'); ?>" rel="stylesheet" type="text/css">
	
	<link href="<?= base_url("assets/plugins/font-awesome/css/font-awesome.min.css") ?>"  rel="stylesheet" type="text/css">
	<link href="<?=base_url("assets/plugins/confirm/jquery-confirm.min.css")?>"  rel="stylesheet" type="text/css"/>



	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?=base_url('assets/global_assets/js/main/jquery.min.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/main/bootstrap.bundle.min.js'); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?=base_url('assets/global_assets/js/plugins/pickers/daterangepicker.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/plugins/forms/selects/select2.min.js'); ?>" ></script>
	<script src="<?=base_url('assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js'); ?>" ></script>
	<script src="<?=base_url('assets/js/app.js'); ?>" ></script>
	
	<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min1.js'); ?>"></script>
    <script src="<?=base_url('assets/plugins/confirm/jquery-confirm.min.js') ?>"></script>

	<!-- /theme JS files -->

</head>

<body class="@yield('bodyClass')">

<?php 
							   
	$_username = $this->session->userdata('username');
	$_userimage = $this->session->userdata('image');         

?>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="<?=base_url(); ?>" class="d-inline-block">
				<img src="<?=base_url('assets/global_assets/images/logo_light.png'); ?>" alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
            <button class="navbar-toggler sidebar-mobile-right-toggle" type="button">
                <i class="icon-more"></i>
            </button>

		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
            </ul>

			<ul class="navbar-nav" style="margin-left:auto;">
		     	<li class="nav-item mt-auto">
				 <a href="javascript:void(0);" class="navbar-nav-link" > 
				   <span><?=date('d-m-Y H:i A'); ?></span>
				 </a>  
                </li>
				<li class="nav-item dropdown dropdown-user">
					<a href="javascript:void(0);" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
				       <?php if(isset($_userimage) && $_userimage != ""){ ?>
						<img src="<?=base_url().$_userimage; ?>" height="36" width="36" class="rounded-circle" alt="">
						<?php }else{ ?>
						<img src="<?=base_url('assets/img/placeholder.png'); ?>" height="36" width="36" class="rounded-circle mr-2" alt="">
						<?php } ?>
						<span><?=$_username;?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?=base_url("doctor/profile")?>" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
						<a href="<?=base_url("doctor/profile")?>" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
						<a href="<?=base_url("account/logout")?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
                </li>
                
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
							   <a href="<?=base_url('doctor/profile/'); ?>">
								<?php if(isset($_userimage) && $_userimage != ""){ ?>
								<img src="<?=base_url().$_userimage; ?>" height="38" width="38" class="rounded-circle" alt="">
							    <?php }else{ ?>
								<img src="<?=base_url('assets/img/placeholder.png'); ?>" height="38" width="38" class="rounded-circle" alt="">
								<?php } ?>
							   </a>
							</div>

							<div class="media-body align-self-center">
								<div class="media-title font-weight-semibold"><?=$_username;?></div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="<?=base_url('doctor/profile/'); ?>" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="<?=base_url('doctor/'); ?>" class="nav-link <?php if(@$active == 'dashboard'){echo "active";}?>">
								<i class="fa fa-tachometer"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<!-- /main -->

						<!-- Users -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Users</div> <i class="icon-menu" title="Forms"></i></li>
						<li class="nav-item nav-item-submenu <?php if(@$active == 'patients'){echo "nav-item-expanded nav-item-open";}?>">
							<a href="javascript:void(0);" class="nav-link <?php if(@$active == 'patients'){echo 'active';}?>"><i class="fa fa-user-o"></i> <span>Patients</span></a>
							<ul class="nav nav-group-sub " data-submenu-title="Patients">
								<li class="nav-item "><a href="<?=base_url("doctor/patients/add")?>" class="nav-link <?php if(@$active_page == 'patients_add'){echo 'active';}?>">Add Patient</a></li>
								<li class="nav-item "><a href="<?=base_url("doctor/patients/manage/3")?>" class="nav-link <?php if(@$active_page == 'patients'){echo 'active';}?>">All Patients</a></li>		
								<li class="nav-item "><a href="<?=base_url("doctor/patients/manage/1")?>" class="nav-link <?php if(@$active_page == 'approved'){echo 'active';}?>">Approved </a></li>
								<li class="nav-item "><a href="<?=base_url("doctor/patients/manage/2")?>" class="nav-link <?php if(@$active_page == 'unapproved'){echo 'active';}?>">Unapproved </a></li>
								<li class="nav-item "><a href="<?=base_url("doctor/patients/manage/0")?>" class="nav-link <?php if(@$active_page == 'pending'){echo 'active';}?>">Pending </a></li>
								<li class="nav-item "><a href="<?=base_url("doctor/patients/manage/4")?>" class="nav-link <?php if(@$active_page == 'deleted'){echo 'active';}?>">Deleted Patients</a></li>								
							</ul>
						</li>
						
						<!-- /Users -->

						<!-- Appointments -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Appointments</div> <i class="icon-menu" title="Components"></i></li>
						
						<li class="nav-item nav-item-submenu <?php if(@$active == 'appointments'){echo "nav-item-expanded nav-item-open";}?>">
							<a href="javascript:void(0);" class="nav-link <?php if(@$active == 'appointments'){echo 'active';}?>"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Appointments">
							  <li class="nav-item"><a href="<?=base_url('doctor/appointment/add_appointment')?>" class="nav-link <?php if(@$active_page == 'appointment_add'){echo 'active';}?>"> Add Appointment</a></li>
                              <li class="nav-item"><a href="<?=base_url('doctor/appointment/manage/3')?>" class="nav-link <?php if(@$active_page == 'appointments'){echo 'active';}?>">All Appointments</a></li>
                              <li class="nav-item"><a href="<?=base_url('doctor/appointment/manage/1')?>" class="nav-link <?php if(@$active_page == 'active'){echo 'active';}?>">Active</a></li>
                              <li class="nav-item"><a href="<?=base_url('doctor/appointment/manage/0')?>" class="nav-link <?php if(@$active_page == 'pending'){echo 'active';}?>">Pending</a></li>
                              <li class="nav-item"><a href="<?=base_url('doctor/appointment/manage/2')?>" class="nav-link <?php if(@$active_page == 'cancelled'){echo 'active';}?>">Cancelled</a></li>
							  <li class="nav-item"><a href="<?=base_url('doctor/appointment/calendar')?>" class="nav-link <?php if(@$active_page == 'appointments_calendar'){echo 'active';}?>"></i>Calendar</a></li>
							  <li class="nav-item"><a href="<?=base_url('doctor/appointment/availability/')?>" class="nav-link <?php if(@$active_page == 'appointment_settings'){echo 'active';}?>"></i>Settings</a></li>
							</ul>
						</li>

						<li class="nav-item nav-item-submenu <?php if(@$active == 'invoices'){echo "nav-item-expanded nav-item-open";} ?>">
							<a href="javascript:void(0);" class="nav-link <?php if(@$active == 'invoices'){echo 'active';}?>"><i class="fa fa-credit-card"></i><span>Billing</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Invoices">
                              <li class="nav-item"><a href="<?=base_url('doctor/invoices/add_invoice')?>" class="nav-link <?php if(@$active_page == 'invoice_add'){echo 'active';}?>">Add Invoice</a></li>
                              <li class="nav-item"><a href="<?=base_url('doctor/invoices')?>" class="nav-link <?php if(@$active_page == 'invoices'){echo 'active';}?>"></i>Manage Invoices</a></li>
                              <li class="nav-item"><a href="<?=base_url('doctor/invoices/payments')?>" class="nav-link <?php if(@$active_page == 'payments'){echo 'active';}?>"></i>Manage Payments</a></li>
							</ul>
						</li>
						
						<!-- /Appointments -->

						<!-- Settings -->
						
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Settings</div> <i class="icon-menu" title="Layout options"></i></li>
						<li class="nav-item nav-item-submenu <?php if(@$active == 'settings'){echo "nav-item-expanded nav-item-open";}?>">
							<a href="javascript:void(0);" class="nav-link <?php if(@$active == 'settings'){echo 'active';}?>"><i class="fa fa-cog"></i><span>Settings</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Settings">
     							 <li class="nav-item"><a href="<?=base_url('doctor/notifications/')?>" class="nav-link <?php if(@$active_page == 'notifications'){echo 'active';}?>">Emails & SMS</a></li>
								 <li class="nav-item"><a href="<?=base_url('doctor/settings/app_logo')?>" class="nav-link <?php if(@$active_page == 'branding'){echo 'active';}?>">Branding</a></li>
								 <li class="nav-item"><a href="<?=base_url('doctor/settings/quick_notes')?>" class="nav-link <?php if(@$active_page == 'quick_notes'){echo 'active';}?>">Quick Notes</a></li>
								 <li class="nav-item"><a href="<?=base_url('doctor/settings/payment_gateways/')?>" class="nav-link <?php if(@$active_page == 'payment_gateways'){echo 'active';}?>">Payment Gateways</a></li>								
	    					</ul>
						</li>
						<li class="nav-item nav-item-submenu <?php if(@$active == 'widgets'){echo "nav-item-expanded nav-item-open";}?>">
							<a href="javascript:void(0);" class="nav-link <?php if(@$active == 'widgets'){echo 'active';}?>"><i class="fa fa-star-half-o" aria-hidden="true"></i><span>Widgets</span></a>
				            <ul class="nav nav-group-sub" data-submenu-title="Settings">
								<li class="nav-item"><a href="<?=base_url('doctor/widgets/add')?>" class="nav-link <?php if(@$active_page == 'branding'){echo 'add_widget';}?>">Add Widget</a></li>
     							 <li class="nav-item"><a href="<?=base_url('doctor/widgets/')?>" class="nav-link <?php if(@$active_page == 'notifications'){echo 'widgets';}?>">Manage Widgets</a></li>
							</ul>
				        </li>	
						
						<!-- /Settings -->

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->

		@yield('content')
		
		<!-- /main content -->

	</div>
	<!-- /page content -->
    <script type="text/javascript">
 
	function confirmbox(text,link)
	{  
        var b = $.confirm({
		title: 'Confirm!',
		content: text,
		buttons: {
			confirm: function() 
			{
			window.location = link
			},
			close: function() 
			{
			
			}
		  }
		});
		
		return b;
	}

	</script>

   @yield('scripts')
  </body>
</html>
