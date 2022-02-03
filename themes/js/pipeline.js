$(document).ready(function () {
	"use strict";

	$(".title").each(function (i) {
		let that = $(".title")[i];

		$(that).hover(function () {
			let ic = $(".title .ic-setting")[i];
			$(ic).css("visibility", "visible");
		}, function () {
			let ic = $(".title .ic-setting")[i];
			$(ic).css("visibility", "hidden");
		})
	});

	$(".stage-list-card").each(function (i) {
		let that = $(".stage-list-card")[i];

		$(that).hover(function () {
			let ic = $(".stage-list-card .ic-action")[i];
			$(ic).css("visibility", "visible");
		}, function () {
			let ic = $(".stage-list-card .ic-action")[i];
			$(ic).css("visibility", "hidden");
		})
	});

	/* ============== Select2 ============== */
	$("#customer").select2({
		placeholder: "Customer...",
		allowClear: true
	});

	$("#sales_team").select2({
		placeholder: "Sales...",
		allowClear: true
	});

	/* ============== Input Mask ============== */
	$(".currency").inputmask("currency", {
		rightAlign: false
	});

	/* ============== Date Time Picker ============== */
	$(".datepicker").datetimepicker();

	/* ============== Raty ============== */
	$("#priority").raty({
		number: 3,
		hints: ['Medium', 'High', 'Very High', null, null],
	});

	/* ============== Create and Update Stage Modal ============== */
	$("#btn-create").click(function () {
		$("#stage-modal .modal-title").text("Add a Column");
		$("#stage-modal .btn-primary").text("Add");

		$("#id").val("");
		$("#stage").val("");

		$("#sales_team").val("").trigger("change");
		$("#sales-input").attr("hidden", true);
		$("#req").val("");
		$("#req-input").attr("hidden", true);
	});

	$(".btn-edit").click(function () {
		let that = $(this);
		$("#stage-modal .modal-title").text("Edit Column");
		$("#stage-modal .btn-primary").text("Save");

		$("#sales-input").attr("hidden", false);
		$("#req-input").attr("hidden", false);

		getDetail(that.data("id"), base_url("pipeline/getStage"))
			.then(function (res) {
				if (res.success) {
					$("#id").val(that.data("id"));
					$("#stage").val(res.stage.stage);
					$("#sales_team").val(res.stage.sales_team_id).trigger("change");
					$("#req").val(res.stage.requirements);
				} else {
					console.log(res.console_message);
				}
			}).catch(function (err) {
				console.log(err);
			});
	});

	$(".ic-create").click(function () {
		let id = $(this).data("id");
		$("#stage_id").val(id);
	});
});
