<?php $this->load->view('partials/back/head'); ?>

<style>
	#stage-list .card .card-body span {
		display: block;
	}

	#setting-menu::after,
	#action-menu::after {
		content: none;
	}

	div.dropdown .dropdown-item:active {
		background-color: #fff !important;
		color: #212529 !important;
	}

	.draggable-cards {
		touch-action: none;
	}

	.scroll-wrapper {
		min-height: inherit;
		display: flex;
		overflow-x: auto;
	}

	.scroll-wrapper .stage {
		margin-right: 20px;
		/* width: 300px; */
		min-width: 300px;
		max-width: 300px;
	}

	.handle {
		cursor: all-scroll;
	}

	.gu-transit {
		pointer-events: none;
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

				<div class="scroll-wrapper draggable-cards" id="draggable-area">
					<?php foreach ($stages as $stage) : ?>
						<div class="stage" data-id="<?= $stage['id']; ?>" data-order="<?= $stage['order_num']; ?>">
							<section id="title" class="title d-flex justify-content-between handle">
								<h5><?= $stage['name']; ?></h5>
								<div class="icon">
									<div class="setting-dropdown dropdown show d-inline">
										<a href="#" class="ic-setting dropdown-toggle" id="setting-menu" data-toggle="dropdown" style="visibility: hidden;">
											<i class="mdi mdi-settings"></i>
										</a>

										<div class="dropdown-menu" aria-labelledby="setting-menu">
											<a href="#" class="dropdown-item btn-edit" data-toggle="modal" data-target="#stage-modal" data-id="<?= $stage['id']; ?>">Edit</a>
											<a href="#" class="dropdown-item btn-delete" data-id="<?= $stage['id']; ?>">Delete</a>
										</div>
									</div>
									<a href="#" class="ic-create" data-toggle="modal" data-target="#opportunity-modal" data-id="<?= $stage['id']; ?>">
										<i class="mdi mdi-plus"></i>
									</a>
								</div>
							</section>
							<section id="price">
							</section>
							<section id="stage-list">
								<div class="row stage-list" data-id="<?= $stage['id']; ?>">
									<div class="col-md-12" data-id=""></div>
									<?php foreach ($opportunities as $opportunity) : ?>
										<?php if ($stage['id'] == $opportunity['stage_id']) : ?>
											<div class="col-md-12" data-id="<?= $opportunity['id']; ?>">
												<div class="card mb-0 border stage-list-card">
													<div class="card-body p-3">
														<div class="ic-dropdown dropdown show p-1" style="position: absolute; top: 0; right: 0;">
															<a href="#" class="ic-action dropdown-toggle" id="action-menu" data-toggle="dropdown" style="visibility: hidden;">
																<i class="mdi mdi-dots-vertical"></i>
															</a>

															<div class="dropdown-menu" aria-labelledby="setting-menu">
																<a href="<?= base_url('pipeline/edit/') . $opportunity['id']; ?>" class="dropdown-item btn-edit">Edit</a>
																<a href="#" class="dropdown-item delete-stage-list" data-id="<?= $opportunity['id']; ?>">Delete</a>
															</div>
														</div>

														<h6 class="mb-1 text-dark"><?= $opportunity['opportunity']; ?></h6>
														<div class="mb-1">
															<span><?= rupiah($opportunity['revenue']); ?></span>
															<span><?= $opportunity['company_name']; ?><?= isset($opportunity['contact_name']) ? ', ' . $opportunity['contact_name'] : ''; ?></span>
														</div>
														<div class="priority" data-id="<?= $opportunity['id']; ?>" data-priority="<?= $opportunity['priority']; ?>"></div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</section>
						</div>
					<?php endforeach; ?>
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

	<script src="<?= base_url('themes'); ?>/js/functions.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?= base_url('themes/js'); ?>/jquery.inputmask.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/select2/dist/js/select2.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/forms/select2/select2.init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/raty-js/lib/jquery.raty.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/extra-libs/raty/rating-init.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/moment/min/moment.min.js"></script>
	<script src="<?= base_url('themes/js'); ?>/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url('themes/js'); ?>/pipeline.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/assets/libs/dragula/dist/dragula.min.js"></script>

	<script>
		$(document).ready(function() {
			"use strict";

			let form_stage = $("#form-stage");
			let form_opportunity = $("#form-opportunity");

			$(".priority").each(function(i) {
				let that = $(this);
				that.raty({
					number: 3,
					score: function() {
						return $(this).data("priority");
					},
					hints: ["Medium", "High", "Very High", null, null],
					click: function(score, evt) {
						update({
								listID: that.data("id"),
								priority: score
							}, base_url("pipeline/changePriority"))
							.then(function(res) {
								if (res.success) {
									that.raty("score", res.priority);
								} else {
									console.log(res.console_message);
								}
							}).catch(function(err) {
								console.log(err);
							});
					}
				});
			});

			form_stage.validate({
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

			form_opportunity.validate({
				ignore: ".ignore",
				validClass: "is-valid",
				errorClass: "is-invalid",
				errorPlacement: function(error, element) {
					error.addClass("invalid-feedback mb-0");
					if (element.hasClass("select2") && element.next(".select2-container").length) {
						error.insertAfter(element.next(".select2-container"));
					} else if (element.parent(".input-group").length) {
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

			$(".btn-delete").click(function() {
				let that = $(this);
				destroy(that.data("id"), base_url("pipeline/destroy"))
					.then(function(res) {
						if (res) {
							window.location = base_url("pipeline");
						} else {
							console.log(res.console_message);
						}
					}).catch(function(err) {
						console.log(err);
					});
			});

			$(".delete-stage-list").click(function() {
				let that = $(this);
				destroy(that.data("id"), base_url("pipeline/destroyStageList"))
					.then(function(res) {
						if (res) {
							window.location = base_url("pipeline");
						} else {
							console.log(res.console_message);
						}
					}).catch(function(err) {
						console.log(err);
					});
			});

			dragula(querySelectorAllArray(".stage-list"))
				.on("drop", function(el, target) {
					let droppedId = $(el).data("id");
					let targetId = $(target).data("id");

					let data = {
						id: droppedId,
						stageId: targetId
					}

					update(data, base_url("pipeline/changeStage"))
						.then(function(res) {
							if (res.success) {
								console.log(res.console_message);
							} else {
								console.log(res.console_message);
							}
						}).catch(function(err) {
							console.log(err);
						});
				});

			dragula([document.getElementById("draggable-area")], {
				moves: function(el, container, handle) {
					return handle.classList.contains("handle")
				},
				direction: "horizontal"
			}).on("drop", function(el) {
				let selectedData = new Array();
				$(".stage").each(function() {
					selectedData.push($(this).data("id"));
				});

				update({
						position: set(selectedData)
					}, base_url("pipeline/reorder"))
					.then(function(res) {
						if (res.success) {
							console.log(res.console_message);
						} else {
							console.log(res.console_message);
						}
					}).catch(function(err) {
						console.log(err);
					});
			});
		});
	</script>
</body>

</html>
