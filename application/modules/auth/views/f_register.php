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
				<div>
					<div class="logo">
						<span class="db"><img src="<?= base_url('themes/vendor'); ?>/assets/images/logo-icon.png" alt="logo" /></span>
						<h5 class="font-medium m-b-20">Sign Up to Admin</h5>
					</div>
					<!-- Form -->
					<div class="row">
						<div class="col-12">
							<form class="form-horizontal m-t-20" action="index.html">
								<div class="form-group row ">
									<div class="col-12 ">
										<input class="form-control form-control-lg" type="text" required=" " placeholder="Name">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 ">
										<input class="form-control form-control-lg" type="text" required=" " placeholder="Email">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 ">
										<input class="form-control form-control-lg" type="password" required=" " placeholder="Password">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 ">
										<input class="form-control form-control-lg" type="password" required=" " placeholder="Confirm Password">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12 ">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheck1">
											<label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>
										</div>
									</div>
								</div>
								<div class="form-group text-center ">
									<div class="col-xs-12 p-b-20 ">
										<button class="btn btn-block btn-lg btn-info " type="submit ">SIGN UP</button>
									</div>
								</div>
								<div class="form-group m-b-0 m-t-10 ">
									<div class="col-sm-12 text-center ">
										Already have an account? <a href="<?= base_url('login'); ?>" class="text-info m-l-5 "><b>Sign In</b></a>
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
	<!-- ============================================================== -->
	<!-- All Required js -->
	<!-- ============================================================== -->
	<?php $this->load->view('partials/front/scripts'); ?>
	<!-- ============================================================== -->
	<!-- This page plugin js -->
	<!-- ============================================================== -->
	<script>
		$('[data-toggle="tooltip "]').tooltip();
		$(".preloader ").fadeOut();
	</script>
</body>

</html>
