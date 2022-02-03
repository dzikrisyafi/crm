<?php $this->load->view('partials/back/head'); ?>

<!-- This page plugin CSS -->
<link href="<?= base_url('themes/vendor'); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

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
				<div class="row d-flex justify-content-start mb-4">
					<div class="col-12 col-md-4 col-lg-5">
						<a href="#" id="btn-create" class="btn btn-primary" data-toggle="modal" data-target="#create-modal"><i class="mdi mdi-download"></i></a>
					</div>
					<div class="col-12 col-md-4 col-lg-4">
						<div class="btn-group">
							<button id="filters" class="btn btn-light m-0"><i class="mdi mdi-filter"></i> Filters</button>
							<button id="groupby" class="btn btn-light m-0"><i class="mdi mdi-view-sequential"></i> Group By</button>
							<button id="favorites" class="btn btn-light m-0"><i class="mdi mdi-star"></i> Favorites</button>
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-3">
						<div class="btn-group float-right">
							<!-- <button id="table" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Pivot"><i class="mdi mdi-table"></i></button>
							<button id="graph" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Graph"><i class="mdi mdi-chart-bar"></i></button> -->
							<a href="<?= base_url('activities/report'); ?>" id="list" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="List"><i class="mdi mdi-format-list-bulleted"></i></a>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Completion Date</th>
												<th>Assigned To</th>
												<th>Activity Type</th>
												<th>Activity Description</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($reports as $report) : ?>
												<tr>
													<td><?= $report['completion_date']; ?></td>
													<td>Your Company, Admin</td>
													<td><?= $report['activity_type']; ?></td>
													<td><?= $report['feedback']; ?></td>
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

	<!--This page plugins -->
	<script src="<?= base_url('themes/vendor'); ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
	<script src="<?= base_url('themes/vendor'); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>

	<script>
		/* Embedded JS */
		$(document).ready(function() {
			"use strict";
		});
	</script>
</body>

</html>
