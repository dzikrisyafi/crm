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
				<div class="row mb-4">
					<div class="col">
						<a href="<?= base_url('customers/create'); ?>" class="btn btn-primary">Create</a>
					</div>
				</div>
				<?php
				$numOfCols = 3;
				$rowCount = 0;
				$bootstrapColWidth = 12 / $numOfCols;
				foreach ($customers as $customer) : ?>
					<?php if ($rowCount % $numOfCols == 0) : ?><div class="row"><?php endif; ?>
						<?php $rowCount++; ?>
						<div class="col-<?= $bootstrapColWidth; ?>">
							<div class="card">
								<div class="d-flex flex-row">
									<img src="<?= base_url('uploads/img/users'); ?>/default.jpeg" alt="user-profile" class="img-fluid img-wrapper">
									<div class="card-body">
										<a href="<?= base_url('customers/detail/') . $customer['company_id']; ?>">
											<h6 class="card-title"><?= $customer['company_name']; ?><?= isset($customer['contact_name']) ? ', ' . $customer['contact_name'] : ''; ?></h6>
										</a>
										<span class="card-text d-block">Lorem ipsum dolor sit amet</span>
										<span class="card-text d-block">Jakarta, Indonesia</span>
										<span class="card-text d-block"><?= isset($customer['company_email']) ? $customer['company_email'] : $customer['individu_email']; ?></span>
									</div>
								</div>
							</div>
						</div>
						<?php if ($rowCount % $numOfCols == 0) : ?>
						</div><?php endif; ?>
				<?php endforeach; ?>
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
	<script>
		/* Embedded JS */
		$(document).ready(function() {
			"use strict";
		});
	</script>
</body>

</html>
