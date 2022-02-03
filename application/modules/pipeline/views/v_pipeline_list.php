<?php $this->load->view('partials/back/head'); ?>

<!-- This page plugin CSS -->
<link href="<?= base_url('themes/vendor'); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

<style>
	#stage-list .card .card-body span {
		display: block;
	}

	.select2-container .select2-selection--single {
		height: 36px;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 36px;
	}

	#setting-menu::after {
		content: none;
	}

	div.dropdown .dropdown-item:active {
		background-color: #fff !important;
		color: #212529 !important;
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
				<?php $this->load->view('partials/back/navbtn'); ?>

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Opportunity</th>
												<th>Contact Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Sales Person</th>
												<th>Expected Revenue</th>
												<th>Stage</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($opportunities as $opportunity) : ?>
												<tr>
													<td><?= $opportunity['opportunity']; ?></td>
													<td><?= $opportunity['contact_name']; ?></td>
													<td><?= $opportunity['contact_name'] ? $opportunity['individual_email'] : $opportunity['company_email']; ?></td>
													<td>
														<?php if ($opportunity['contact_name']) : ?>
															<?= $opportunity['individual_mobile']; ?>
														<?php else : ?>
															<?= $opportunity['company_phone']; ?>
														<?php endif; ?>
													</td>
													<td>Admin</td>
													<td><?= rupiah($opportunity['revenue']); ?></td>
													<td><?= $opportunity['stage']; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="stage-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Add a Column</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form id="form-stage" action="<?= base_url('pipeline/saveStage'); ?>" method="POST">
								<div class="form-group">
									<input type="hidden" name="id" id="id" class="form-control">
								</div>
								<div class="form-group">
									<label for="stage" class="control-label">Stage Name</label>
									<input type="text" name="stage" id="stage" class="form-control" placeholder="Prospect" required>
								</div>
								<div id="sales-input" class="form-group">
									<label for="sales_team" class="control-label">Sales Team</label>
									<select name="sales_team" id="sales_team" class="select2 form-control custom-select" style="width: 100%; height: 36px !important;">
										<option value=""></option>
										<?php foreach ($sales_team as $st) : ?>
											<option value="<?= $st['id']; ?>"><?= $st['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div id="req-input" class="form-group">
									<label for="req" class="control-label">Requirements</label>
									<textarea name="req" id="req" class="form-control" placeholder="Give your team the requirements to move an opportunity to this stage"></textarea>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
						</div>
						</form>
					</div>
				</div>
			</div>

			<div id="opportunity-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Create Record</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form id="form-opportunity" action="<?= base_url('pipeline/saveOpportunity'); ?>" method="POST">
								<div class="form-group">
									<input type="hidden" name="stage_id" id="stage_id" class="form-control">
								</div>
								<div class="form-group">
									<label for="opportunity" class="control-label">Opportunity</label>
									<input type="text" name="opportunity" id="opportunity" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="customer" class="control-label">Customer</label>
									<select name="customer" id="customer" class="select2 form-control custom-select" style="width: 100%; height: 36px !important;" required>
										<option></option>
										<?php foreach ($customers as $customer) : ?>
											<option value=" <?= $customer['id']; ?>"><?= $customer['company_name']; ?><?= isset($customer['contact_name']) ? ', ' . $customer['contact_name'] : ''; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-row">
									<div class="form-group col-9">
										<label for="revenue" class="control-label">Expected Revenue</label>
										<input type="text" name="revenue" id="revenue" class="form-control currency" required>
									</div>
									<div class="form-group col-3 d-flex align-self-center justify-content-end">
										<div id="priority"></div>
									</div>
								</div>
								<div class="form-group">
									<label for="closing" class="control-label">Expected Closing</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<span class="ti-calendar"></span>
											</span>
										</div>
										<input type="text" name="closing" id="closing" class="form-control datepicker" data-date-format="YYYY-MM-DD hh:mm:ss" required>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
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
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/raty-js/lib/jquery.raty.js"></script>
	<script src="<?= base_url('themes/js'); ?>/jquery.inputmask.min.js"></script>
	<script src="<?= base_url('themes/vendor') ?>/assets/libs/moment/min/moment.min.js"></script>
	<script src="<?= base_url('themes/js'); ?>/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/extra-libs/raty/rating-init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/select2/dist/js/select2.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/forms/select2/select2.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
	<script src="<?= base_url('themes/js'); ?>/pipeline.js"></script>

	<script>
		/* Embedded JS */
		$(document).ready(function() {
			"use strict";

			let form_init = $("#form-create");
			let form;

			$("#priority").raty({
				number: 3
			});

			form = form_init.validate({
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
						.then(function(res) {
							if (res.success) {
								$(this).find("form").trigger("reset");
								window.location = base_url("pipeline");
							} else {
								console.log(res.console_message);
							}
						}).catch(function(err) {
							console.log(err);
						});
				}
			});
		});
	</script>
</body>

</html>
