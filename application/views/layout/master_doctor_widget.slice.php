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

	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?=base_url('assets/global_assets/js/main/jquery.min.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/main/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->
	
	
	
	<!-- Theme JS files -->
	<script src="<?=base_url('assets/global_assets/js/plugins/forms/validation/jquery.validate.min.js'); ?>"></script>
    <script src="<?=base_url('assets/global_assets/js/plugins/forms/wizards/steps.min.js') ?>"></script>
    
	<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min1.js'); ?>"></script>
	<script src="<?=base_url('assets/js/app.js'); ?>" ></script>
	<!-- /theme JS files -->

</head>

<body class="@yield('bodyClass')">



	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="<?=base_url(); ?>" class="d-inline-block">
				<img src="<?=base_url('assets/global_assets/images/logo_light.png'); ?>" alt="">
			</a>
		</div>


	</div>
	<!-- /main navbar -->
	@yield('scripts_top')

	<!-- Page content -->
	<div class="page-content">


		<!-- Main content -->

		@yield('content')
		
		<!-- /main content -->

	</div>
	<!-- /page content -->
  
   @yield('scripts')
  </body>
</html>
