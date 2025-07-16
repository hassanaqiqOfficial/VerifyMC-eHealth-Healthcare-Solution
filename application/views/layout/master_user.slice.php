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
	
	<link href="<?= base_url("assets/plugins/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url("assets/plugins/confirm/jquery-confirm.min.css")?>" rel="stylesheet" type="text/css"/>
    
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?=base_url('assets/global_assets/js/main/jquery.min.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/main/bootstrap.bundle.min.js'); ?>" ></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	
	<script src="<?=base_url('assets/js/app.js'); ?>" ></script>
	<script src="<?= base_url('assets/plugins/confirm/jquery-confirm.min.js') ?>"></script>
	
	<!-- /theme JS files -->
    
</head>

  <body class="@yield('bodyClass')">

    <?php   
	    $_username = $this->session->userdata('username');
	    $_userImage = $this->session->userdata('image');
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
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
					    <img src="<?=base_url($_userImage); ?>" height="36" width="36" class="rounded-circle mr-2" alt="">
						<span><?=$_username;?></span>
					</a>
                    <div class="dropdown-menu dropdown-menu-right">
						<a href="<?=base_url("users/profile")?>" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
						<a href="<?=base_url("users/profile")?>" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
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
							  <a href="<?=base_url('users/profile/'); ?>">
								<img src="<?=base_url($_userImage); ?>" height="38" width="38" class="rounded-circle" alt="">
							  </a>
							</div>

							<div class="media-body align-self-center">
								<div class="media-title font-weight-semibold"><?=$_username; ?></div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="<?=base_url('users/profile/'); ?>" class="text-white"><i class="icon-cog3"></i></a>
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
							<a href="<?=base_url("users"); ?>" class="nav-link <?php if(@$active == 'dashboard'){echo "active";} ?>">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<!-- /main -->


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
