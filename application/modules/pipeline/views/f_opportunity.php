<?php $this->load->view('partials/back/head'); ?>

<!-- Bootstrap Datetimepicker -->
<link href="<?= base_url('themes/css'); ?>/bootstrap-datetimepicker.min.css" rel="stylesheet">

<style>
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
				<div class="row d-flex justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<form id="form_opportunity" action="<?= base_url('pipeline/updateOpportunity'); ?>" method="POST">
									<div class="form-group">
										<input type="hidden" name="id" id="id" value="<?= $opportunity['id']; ?>">
									</div>
									<div class="form-row">
										<div class="form-group col-sm-10">
											<label for="opportunity">Opportunity</label>
											<input type="text" name="opportunity" id="opportunity" class="form-control" placeholder="e.g. Product Pricing" value="<?= $opportunity['name']; ?>" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-5">
											<label for="revenue">Expected Revenue</label>
											<input type="text" name="revenue" id="revenue" class="form-control" value="<?= $opportunity['revenue']; ?>" required>
										</div>
										<div class="form-group col-sm-5">
											<label for="probability">Probability %</label>
											<input type="text" name="probability" id="probability" class="form-control">
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="customer" class="col-sm-4 control-label col-form-label">Customer</label>
												<div class="col-sm-7">
													<select name="customer" id="customer" class="select2 form-control custom-select" style="width: 100%;" required>
														<option value=""></option>
														<?php foreach ($customers as $customer) : ?>
															<?php if ($opportunity['contact_id'] == $customer['id']) : ?>
																<option value=" <?= $customer['id']; ?>" selected><?= $customer['company_name']; ?><?= isset($customer['contact_name']) ? ', ' . $customer['contact_name'] : ''; ?></option>
															<?php else : ?>
																<option value=" <?= $customer['id']; ?>"><?= $customer['company_name']; ?><?= isset($customer['contact_name']) ? ', ' . $customer['contact_name'] : ''; ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="closing" class="col-sm-4 control-label col-form-label">Expected Closing</label>
												<div class="col-sm-7">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="ti-calendar"></span>
															</span>
														</div>
														<input type="text" name="closing" id="closing" class="form-control datepicker" data-date-format="YYYY-MM-DD hh:mm:ss" value="<?= $opportunity['expected_closing']; ?>" required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="email" class="col-sm-4 control-label col-form-label">Email</label>
												<div class="col-sm-7">
													<input type="text" name="email" id="email" class="form-control" value="<?= $opportunity['individual_email'] ? $opportunity['individual_email'] : $opportunity['company_email']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="priority" class="col-sm-4 control-label col-form-label">Priority</label>
												<div class="col-sm-7 d-flex align-items-center">
													<div id="priority" data-priority="<?= $opportunity['priority_id']; ?>"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="phone" class="col-sm-4 control-label col-form-label">Phone</label>
												<div class="col-sm-7">
													<input type="text" name="phone" id="phone" class="form-control" value="<?= $opportunity['individual_phone'] ? $opportunity['individual_phone'] : $opportunity['company_phone']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="tags" class="col-sm-4 control-label col-form-label">Tags</label>
												<div class="col-sm-7">
													<select name="tags" id="tags" class="select2 form-control custom-select" style="width: 100%;">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="sales_person" class="col-sm-4 control-label col-form-label">Sales Person</label>
												<div class="col-sm-7">
													<select name="sales_person" id="sales_person" class="select2 form-control custom-select" style="width: 100%;">
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-6">
											<div class="form-group row">
												<label for="sales_team" class="col-sm-4 control-label col-form-label">Sales Team</label>
												<div class="col-sm-7">
													<select name="sales_team" id="sales_team" class="select2 form-control custom-select" style="width: 100%;">
														<option value=""></option>
														<?php foreach ($sales_team as $st) : ?>
															<option value="<?= $st['id']; ?>"><?= $st['name']; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true">Internal Notes</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="false">Extra Information</a>
										</li>
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="notes" role="tabpanel" aria-labelledby="notes-tab">
											<div class="form-group my-3">
												<textarea name="notes" id="notes" class="form-control" placeholder="Add a description..." style="height: 100px;"></textarea>
											</div>
										</div>
										<div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
											<div class="my-3">
												<h6 class="text-bold text-primary">Contact Information</h6>
												<div class="form-row">
													<div class="col-sm-6">
														<div class="form-group row">
															<label for="company_name" class="col-sm-3 control-label col-form-label">Company Name</label>
															<div class="col-sm-8">
																<input type="text" name="company_name" id="company_name" class="form-control">
															</div>
														</div>
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
																		<select name="state" id="state" class="custom-select form-control select2" style="width: 100%;">
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
															<label for="website" class="col-sm-3 control-label col-form-label">Website</label>
															<div class="col-sm-8">
																<input type="text" name="website" id="website" class="form-control" placeholder="e.g. https://www.your-website.com">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row mb-0">
															<label for="contact" class="col-sm-3 control-label col-form-label">Contact Name</label>
															<div class="col-sm-8">
																<div class="form-row">
																	<div class="form-group col-6">
																		<input type="text" name="contact" id="contact" class="form-control" placeholder="Contact Name...">
																	</div>
																	<div class="form-group col-6">
																		<select name="title" id="title" class="custom-select form-control select2" style="width: 100%;">
																			<option></option>
																			<option value="1">Title</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div id="job-row" class="form-group row">
															<label for="job_position" class="col-sm-3 control-label col-form-label">Job Position</label>
															<div class="col-sm-8">
																<input type="text" name="job_position" id="job_position" class="form-control" placeholder="e.g. Sales Director">
															</div>
														</div>
														<div class="form-group row">
															<label for="mobile" class="col-sm-3 control-label col-form-label">Mobile</label>
															<div class="col-sm-8">
																<input type="text" name="mobile" id="mobile" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="form-row">
													<div class="col-sm-6">
														<h6 class="text-bold text-primary">Marketing</h6>
														<div class="form-group row">
															<label for="campaign" class="col-sm-3 control-label col-form-label">Campaign</label>
															<div class="col-sm-8">
																<select name="campaign" id="campaign" class="custom-select form-control select2" style="width: 100%;">
																	<option></option>
																	<option value="1">campaign</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<label for="medium" class="col-sm-3 control-label col-form-label">Medium</label>
															<div class="col-sm-8">
																<select name="medium" id="medium" class="custom-select form-control select2" style="width: 100%;">
																	<option></option>
																	<option value="1">medium</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<label for="source" class="col-sm-3 control-label col-form-label">Source</label>
															<div class="col-sm-8">
																<select name="source" id="source" class="custom-select form-control select2" style="width: 100%;">
																	<option></option>
																	<option value="1">source</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<h6 class="text-bold text-primary">Misc</h6>
														<div class="form-group row">
															<label for="referred_by" class="col-sm-3 control-label col-form-label">Referred By</label>
															<div class="col-sm-8">
																<select name="referred_by" id="referred_by" class="custom-select form-control select2" style="width: 100%;">
																	<option></option>
																	<option value="1">Referred By</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<a href="<?= base_url('pipeline'); ?>" class="btn btn-outline-secondary">Discard</a>
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</form>
							</div>
						</div>
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

	<script src="<?= base_url('themes'); ?>/js/functions.init.js"></script>
	<script src="<?= base_url('themes/vendor') ?>/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?= base_url('themes/js'); ?>/jquery.inputmask.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/raty-js/lib/jquery.raty.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/extra-libs/raty/rating-init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/select2/dist/js/select2.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/forms/select2/select2.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/moment/min/moment.min.js"></script>
	<script src="<?= base_url('themes'); ?>/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url('themes'); ?>/js/form-opportunity.js"></script>

	<script>
		/* Embedded JS */
		$(document).ready(function() {
			"use strict";

			let form_init = $("#form_opportunity");
			let form;

			$("#priority").raty({
				number: 3,
				hints: ['Medium', 'High', 'Very High', null, null],
				score: function() {
					return $(this).data("priority");
				},
			});

			form_init.validate({
				ignore: ".ignore",
				validClass: "is-valid",
				errorClass: "is-invalid",
				errorPlacement: function(error, element) {
					error.addClass('invalid-feedback mb-0');
					if (element.hasClass('select2') && element.next('.select2-container').length) {
						error.insertAfter(element.next('.select2-container'));
					} else if (element.parent('.input-group').length) {
						error.insertAfter(element.parent());
					} else {
						error.insertAfter(element);
					}
				},
				submitHandler: function(form) {
					save(new FormData(form), form.action)
						.then((res) => {
							if (res.success) {
								$(this).find('form').trigger('reset');
								window.location = base_url('pipeline');
							} else {
								console.log(res.console_message);
							}
						}).catch((err) => {
							console.log(err);
						});
				}
			});
		});
	</script>
</body>

</html>
