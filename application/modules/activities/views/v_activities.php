<?php $this->load->view('partials/back/head'); ?>

<!-- This page plugin CSS -->
<link href="<?= base_url('themes/vendor'); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

<style>
	.table-schedule td {
		vertical-align: middle;
		padding: 0;
	}

	.table-schedule td .add,
	.feedback {
		display: inline-block;
		width: 100%;
		height: 100%;
		padding: 25px;
	}

	td .btn-light,
	td .btn-success {
		border-radius: 0;
	}

	.create {
		display: inline-block;
		width: 100%;
		height: 100%;
		padding: 10px;
	}

	#table-opportunity td {
		vertical-align: middle;
		cursor: pointer;
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
				<div class="row d-flex justify-content-between mb-4">
					<div class="col-12 col-md-4 col-lg-4">
						<div class="btn-group">
							<button id="filters" class="btn btn-light m-0"><i class="mdi mdi-filter"></i> Filters</button>
							<button id="groupby" class="btn btn-light m-0"><i class="mdi mdi-view-sequential"></i> Group By</button>
							<button id="favorites" class="btn btn-light m-0"><i class="mdi mdi-star"></i> Favorites</button>
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-3">
						<div class="btn-group float-right">
							<a href="<?= base_url('pipeline'); ?>" id="grid" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Kanban"><i class="mdi mdi-grid"></i></a>
							<a href="<?= base_url('pipeline/index/list'); ?>" id="list" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="List"><i class="mdi mdi-format-list-bulleted"></i></a>
							<!-- <button id="table" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Pivot"><i class="mdi mdi-table"></i></button>
							<button id="graph" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Graph"><i class="mdi mdi-chart-bar"></i></button> -->
							<a href="<?= base_url('activities'); ?>" id="activity" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Activity"><i class="mdi mdi-av-timer"></i></a>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="zero_config" class="table table-schedule table-bordered">
										<thead>
											<tr>
												<th></th>
												<?php foreach ($activities as $activity) : ?>
													<th><?= $activity['name']; ?></th>
												<?php endforeach; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($schedules as $schedule) : ?>
												<tr>
													<td>
														<div class="mx-3">
															<span class="d-block"><?= $schedule['opportunity']; ?></span>
															<span class="d-block text-muted"><?= rupiah($schedule['revenue']); ?></span>
														</div>
													</td>
													<?php foreach ($activities as $activity) : ?>
														<?php if (checkSchedule($schedule['opportunity_id'], $activity['id'])) : ?>
															<td style="width: 9%;" class="text-center">
																<a href="#" class="btn feedback btn-success" data-toggle="modal" data-target="#feedback-modal" data-id="<?= $schedule['opportunity_id']; ?>" data-activity="<?= $activity['id']; ?>">
																	<?= date_format(date_create(scheduleDate($schedule['opportunity_id'], $activity['id'])), 'M d'); ?>
																</a>
															</td>
														<?php else : ?>
															<td style="width: 9%;" class="text-center">
																<a href="#" class="btn add btn-light" data-toggle="modal" data-target="#schedule-modal" data-id="<?= $schedule['opportunity_id']; ?>" data-activity="<?= $activity['id']; ?>">
																	<i class="fas fa-plus" style="visibility: hidden;"></i>
																</a>
															</td>
														<?php endif; ?>
													<?php endforeach; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr>
												<td>
													<button class="btn create bg-transparent text-left" data-toggle="modal" data-target="#table-modal">
														<span class="text-info">
															<i class="fas fa-plus"></i> Schedule Activity
														</span>
													</button>
												</td>
												<td colspan="9"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<div id="schedule-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Schedule Activity</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form id="form_add" action="<?= base_url('activities/store'); ?>" method="POST">
								<div class="form-group">
									<input type="hidden" name="opportunity_id" id="opportunity_id">
								</div>
								<div class="form-row">
									<div class="col-sm-6">
										<div class="form-group row">
											<label for="" class="col-sm-5 control-label col-form-label">Activity Type</label>
											<div class="col-sm-6">
												<select name="activity_type" id="activity_type" class="custom-select form-control select2" style="width: 100%;" required>
													<option value=""></option>
													<?php foreach ($activities as $activity) : ?>
														<option value="<?= $activity['id']; ?>"><?= $activity['name']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group row">
											<label for="closing" class="col-sm-5 control-label col-form-label">Expected Closing</label>
											<div class="col-sm-6">
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
									</div>
								</div>
								<div class="form-row">
									<div class="col-sm-6">
										<div class="form-group row">
											<label for="summary" class="col-sm-5 control-label col-form-label">Summary</label>
											<div class="col-sm-6">
												<input type="text" name="summary" id="summary" class="form-control" placeholder="e.g. Discuss prospect">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group row">
											<label for="sales_person" class="col-sm-5 control-label col-form-label">Assigned to</label>
											<div class="col-sm-6">
												<select name="sales_person" id="sales_person" class="custom-select form-control select2" style="width: 100%;">
													<option value=""></option>
													<option value="1">Admin</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<textarea name="note" id="note" class="form-control" style="height: 100px;" placeholder="Log an note..."></textarea>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary waves-effect waves-light">Schedule</button>
						</div>
						</form>
					</div>
				</div>
			</div>

			<div id="table-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Search: Leads or Opportunities</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table id="table-opportunity" class="table table-bordered table-hover">
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
												<td class="text-truncate" data-id="<?= $opportunity['id']; ?>">
													<?= $opportunity['opportunity']; ?>
												</td>
												<td class="text-truncate"><?= $opportunity['contact_name']; ?></td>
												<td class="text-truncate"><?= $opportunity['contact_name'] ? $opportunity['individual_email'] : $opportunity['company_email']; ?></td>
												<td class="text-truncate">
													<?php if ($opportunity['contact_name']) : ?>
														<?= $opportunity['individual_mobile']; ?>
													<?php else : ?>
														<?= $opportunity['company_phone']; ?>
													<?php endif; ?>
												</td>
												<td class="text-truncate">Admin</td>
												<td class="text-truncate"><?= rupiah($opportunity['revenue']); ?></td>
												<td class="text-truncate"><?= $opportunity['stage']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- <div class="modal-footer">
							<div class="form-group">
								<button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
							</div>
						</div> -->
					</div>
				</div>
			</div>

			<div id="feedback-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Planned</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form id="form_feedback" action="<?= base_url('activities/markdone'); ?>" method="POST">
								<div class="form-group">
									<input type="hidden" name="opportunity" id="opportunity">
								</div>
								<div class="form-group">
									<input type="hidden" name="activity_id" id="activity_id">
								</div>
								<div class="form-group">
									<label for="feedback">Feedback</label>
									<textarea name="feedback" id="feedback" style="height: 100px;" placeholder="Write a feedback..." class="form-control" required></textarea>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
							<button type="submit" id="schedule-next" class="btn btn-primary waves-effect waves-light">Done & Schedule Next</button>
							<button type="submit" id="done" class="btn btn-primary waves-effect waves-light">Done</button>
						</div>
						</form>
					</div>
				</div>
			</div>

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

	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?= base_url('themes'); ?>/js/functions.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/moment/min/moment.min.js"></script>
	<script src="<?= base_url('themes/js'); ?>/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/select2/dist/js/select2.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/forms/select2/select2.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>

	<script>
		/* Embedded JS */
		$(document).ready(function() {
			"use strict";

			let form_init = $("#form_add");
			let form_feedback = $("#form_feedback");
			let form;

			$(window).on("load", function() {
				let next = localStorage.getItem("next");
				let opportunity_id = localStorage.getItem("opportunity_id");

				if (next) {
					localStorage.removeItem("next");
					$("#schedule-modal").modal("show");
					$("#opportunity_id").val(opportunity_id);
				}
			})

			$("#table-opportunity").DataTable();

			$(".datepicker").datetimepicker({
				defaultDate: new Date(),
				format: 'MM/DD/YYYY'
			});

			$("#activity_type").select2({
				placeholder: "Activity...",
				allowClear: true,
			});

			$("#sales_person").select2({
				placeholder: "Assigned to...",
				allowClear: true,
			});

			$(".add").click(function() {
				let id = $(this).data("id");
				let activity_id = $(this).data("activity");

				$("#opportunity_id").val(id);
				$("#activity_type").val(activity_id).trigger("change");
			});

			$(".feedback").click(function() {
				let id = $(this).data("id");
				let activity_id = $(this).data("activity");

				$("#opportunity").val(id);
				$("#activity_id").val(activity_id);
			});

			$("#schedule-next").click(function() {
				$(this).attr("data-next", 1);
			});

			$("#done").click(function() {
				$("#schedule-next").removeAttr("data-next");
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
								location.reload();
							} else {
								console.log(res.console_message);
							}
						}).catch((err) => {
							console.log(err);
						});
				}
			});

			form_feedback.validate({
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
								if ($("#schedule-next").data("next") != undefined) {
									localStorage.setItem("next", true);
									localStorage.setItem("opportunity_id", $("#opportunity").val());
								}
								location.reload();
							} else {
								console.log(res.console_message);
							}
						}).catch((err) => {
							console.log(err);
						});
				}
			});

			$("#table-opportunity td").click(function() {
				let id = $(this).data("id");
				$("#table-modal").modal("hide");
				$("#schedule-modal").modal("show");
				$("#opportunity_id").val(id);
				$("#activity_type").val("").trigger("change");
			});

			$("td .btn-light").each(function(i) {
				let that = $("td .btn-light")[i];

				$(that).hover(function() {
					let ic = $("td .btn-light .fa-plus")[i];
					$(ic).css("visibility", "visible");
				}, function() {
					let ic = $("td .btn-light .fa-plus")[i];
					$(ic).css("visibility", "hidden");
				})
			});
		});
	</script>
</body>

</html>
