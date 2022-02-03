<?php $this->load->view('partials/front/head'); ?>
<style>

</style>
</head>

<body>
	<div class="main-wrapper">
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
		<?php $this->load->view('partials/front/preloader'); ?>
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Login box.scss -->
		<!-- ============================================================== -->
		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?= base_url('themes/vendor'); ?>/assets/images/big/auth-bg.jpg) no-repeat center center;">
			<div class="auth-box">
				<div id="loginform">
					<div class="logo">
						<span class="db"><img src="<?= base_url('themes/vendor'); ?>/assets/images/logo-icon.png" alt="logo" /></span>
						<h5 class="font-medium m-b-20">Sign In to Admin</h5>
					</div>
					<!-- Form -->
					<div class="row">
						<div class="col-12">
							<form class="form-horizontal m-t-20" id="loginform" action="<?= base_url('auth/checkUser'); ?>" method="POST">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
									</div>
									<input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
									</div>
									<input type="text" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheck1">
											<label class="custom-control-label" for="customCheck1">Remember me</label>
											<a href="<?= base_url('auth/forgotPassword'); ?>" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot
												pwd?</a>
										</div>
									</div>
								</div>
								<div class="form-group text-center">
									<div class="col-xs-12 p-b-20">
										<button class="btn btn-block btn-lg btn-info text-uppercase" type="submit">Log In</button>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
										<div class="social">
											<a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fab  fa-facebook"></i> </a>
											<a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google">
												<i aria-hidden="true" class="fab  fa-google-plus"></i> </a>
										</div>
									</div>
								</div>
								<div class="form-group m-b-0 m-t-10">
									<div class="col-sm-12 text-center">
										Don't have an account? <a href="<?= base_url('register'); ?>" class="text-info m-l-5"><b>Sign Up</b></a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- Login box.scss -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper scss in scafholding.scss -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper scss in scafholding.scss -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right Sidebar -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right Sidebar -->
		<!-- ============================================================== -->
	</div>
	<?php $this->load->view('partials/front/scripts'); ?>
	<script>
		$(document).ready(function() {
			"use strict";

			$('[data-toggle="tooltip"]').tooltip();
			$(".preloader").fadeOut();
		});
	</script>
</body>

</html>
