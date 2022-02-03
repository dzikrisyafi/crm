	<div class="row d-flex justify-content-start mb-4">
		<div class="col-12 col-md-4 col-lg-5">
			<a href="#" id="btn-create" class="btn btn-primary" data-toggle="modal" data-target="#stage-modal">Create</a>
			<a href="#" id="btn-generate" class="btn btn-outline-secondary">Generate Leads</a>
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
				<a href="<?= base_url('pipeline'); ?>" id="grid" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Kanban"><i class="mdi mdi-grid"></i></a>
				<a href="<?= base_url('pipeline/index/list'); ?>" id="list" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="List"><i class="mdi mdi-format-list-bulleted"></i></a>
				<!-- <button id="table" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Pivot"><i class="mdi mdi-table"></i></button>
							<button id="graph" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Graph"><i class="mdi mdi-chart-bar"></i></button> -->
				<a href="<?= base_url('activities'); ?>" id="activity" class="btn btn-light m-0" data-toggle="tooltip" data-placement="bottom" title="Activity"><i class="mdi mdi-av-timer"></i></a>
			</div>
		</div>
	</div>
