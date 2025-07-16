@php
 defined('BASEPATH') OR exit('No direct script access allowed');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title', 'Login')</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/global_assets/css/icons/icomoon/styles.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/bootstrap_limitless.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/layout.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/components.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/colors.min.css');?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=base_url("assets/plugins/iCheck/square/blue.css")?>">

	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?=base_url('assets/global_assets/js/main/jquery.min.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/main/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?=base_url('assets/global_assets/js/plugins/loaders/blockui.min.js'); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?=base_url('assets/global_assets/js/plugins/forms/styling/uniform.min.js'); ?>"></script>

	<script src="<?=base_url('assets/js/app.js'); ?>"></script>
    <script src="<?=base_url('assets/global_assets/js/demo_pages/login.js'); ?>"></script>
    <script src="<?=base_url("assets/plugins/iCheck/icheck.min.js")?>"></script>

	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
        @yield('content')
		<!-- /main content -->

	</div>
    <!-- /page content -->
    <script>
    // $(function () {
    //     $('input').iCheck({
    //         checkboxClass: 'icheckbox_square-blue',
    //         radioClass: 'iradio_square-blue',
    //         increaseArea: '20%' /* optional */
    //     });
    // });
   </script>
   @yield('scripts')
  </body>

</html>
