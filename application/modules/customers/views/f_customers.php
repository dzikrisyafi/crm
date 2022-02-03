<?php $this->load->view('partials/back/head'); ?>
<style>
	.img-wrapper {
		width: 120px;
		height: 120px;
		object-fit: cover;
		object-position: center;
	}
</style>
</head>

<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<?php $this->load->view('partials/back/preloader'); ?>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<?php $this->load->view('partials/back/topbar'); ?>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<?php $this->load->view('partials/back/sidebar'); ?>
		<!-- ============================================================== -->
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<?php $this->load->view('partials/back/breadcrumb'); ?>
			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Container fluid  -->
			<!-- ============================================================== -->
			<div class="container-fluid">
				<div class="card">
					<div class="card-body">
						<form id="form_customer" action="<?= base_url('customers/save'); ?>" method="POST">
							<div class="form-row">
								<div class="form-group col-4 col-md-2 col-lg-1">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="category" id="individual" value="1" checked>
										<label class="form-check-label" for="individual">
											Individual
										</label>
									</div>
								</div>
								<div class="form-group col-4 col-md-2 col-lg-1">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="category" id="company" value="2">
										<label class="form-check-label" for="company">
											Company
										</label>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-8">
									<input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="e.g. Brandon Freeman" required>
								</div>
							</div>
							<div id="org-row" class="form-row">
								<div class="form-group col-sm-8">
									<select name="company_name" id="company_name" class="select2 form-control custom-select" style="width: 100%;" required>
										<option></option>
										<?php foreach ($companies as $company) : ?>
											<option value="<?= $company['id']; ?>"><?= $company['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col-sm-6">
									<div class="form-group row mb-0">
										<label for="address" class="col-sm-3 control-label col-form-label">Address</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" class="form-control" name="street" id="street" placeholder="Street...">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="street2" id="street2" placeholder="Street 2...">
											</div>
											<div class="form-row">
												<div class="form-group col-4">
													<input type="text" class="form-control" name="city" id="city" placeholder="City">
												</div>
												<div class="form-group col-4">
													<select name="state" id="state" class="custom-select form-control select2">
														<option></option>
														<option value="1">State</option>
													</select>
												</div>
												<div class="form-group col-4">
													<input type="text" name="zip" id="zip" class="form-control" placeholder="ZIP">
												</div>
											</div>
											<div class="form-group">
												<select name="country" id="country" class="custom-select form-control select2" style="width: 100%;">
													<option></option>
													<option value="1">Country</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="tax_id" class="col-sm-3 control-label col-form-label">Tax ID</label>
										<div class="col-sm-8">
											<input type="text" name="tax_id" id="tax_id" class="form-control" placeholder="e.g. BE0477472701">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div id="job-row" class="form-group row">
										<label for="job_position" class="col-sm-3 control-label col-form-label">Job Position</label>
										<div class="col-sm-8">
											<input type="text" name="job_position" id="job_position" class="form-control" placeholder="e.g. Sales Director">
										</div>
									</div>
									<div class="form-group row">
										<label for="phone" class="col-sm-3 control-label col-form-label">Phone</label>
										<div class="col-sm-8">
											<input type="text" name="phone" id="phone" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="mobile" class="col-sm-3 control-label col-form-label">Mobile</label>
										<div class="col-sm-8">
											<input type="text" name="mobile" id="mobile" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="email" class="col-sm-3 control-label col-form-label">Email</label>
										<div class="col-sm-8">
											<input type="text" name="email" id="email" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="website" class="col-sm-3 control-label col-form-label">Website</label>
										<div class="col-sm-8">
											<input type="text" name="website" id="website" class="form-control" placeholder="e.g. https://www.your-website.com">
										</div>
									</div>
									<div id="title-row" class="form-group row">
										<label for="title" class="col-sm-3 control-label col-form-label">Title</label>
										<div class="col-sm-8">
											<select name="title" id="title" class="custom-select form-control select2" style="width: 100%;">
												<option></option>
												<option value="1">Mister</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="tags" class="col-sm-3 control-label col-form-label">Tags</label>
										<div class="col-sm-8">
											<select name="tag" id="tag" class="custom-select form-control select2" style="width: 100%;">
												<option></option>
												<option value="1">Service</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<a href="<?= base_url('customers'); ?>" class="btn btn-outline-secondary">Discard</a>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			<?php $this->load->view('partials/back/footer'); ?>
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<?php $this->load->view('partials/back/scripts'); ?>

	<script src="<?= base_url('themes/vendor') ?>/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?= base_url('themes'); ?>/js/functions.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/select2/dist/js/select2.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/forms/select2/select2.init.js"></script>
	<script src="<?= base_url('themes'); ?>/js/customer.js"></script>

	<script>
		$(document).ready(function() {
			"use strict";

			let form_init = $("#form_customer");
			let form;

			form = form_init.validate({
				ignore: ".ignore",
				validClass: "is-valid",
				errorClass: "is-invalid",
				errorPlacement: function(error, element) {
					error.addClass('invalid-feedback mb-0');
					if (element.hasClass('select2') && element.next('.select2-container').length) {
						error.insertAfter(element.next('.select2-container'));
					} else {
						error.insertAfter(element);
					}
				},
				submitHandler: function(form) {
					save(new FormData(form), form.action)
						.then((res) => {
							if (res.success) {
								$(this).find("form").trigger("reset");
								window.location = base_url("customers");
							} else {
								console.log(res.console_message);
							}
						}).catch((err) => {
							console.log(err);
						});
				}
			})

			$("input[name='category']").change(function() {
				if ($("#company").is(":checked")) {
					$("#org-row").attr("hidden", true);
					$("#job-row").attr("hidden", true);
					$("#title-row").attr("hidden", true);

					$("#company_name").attr("required", false);
				} else if ($("#individual").is(":checked")) {
					$("#org-row").attr("hidden", false);
					$("#job-row").attr("hidden", false);
					$("#title-row").attr("hidden", false);

					$("#company_name").attr("required", true);
				}
			});
		});
	</script>
</body>

</html>
