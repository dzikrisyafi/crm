$(document).ready(function () {
	$(".datepicker").datetimepicker();

	$("#revenue").inputmask("currency", {
		rightAlign: false
	});

	$("#customer").select2({
		placeholder: "Customer...",
		allowClear: true
	});

	$("#tags").select2({
		placeholder: "Tags...",
		allowClear: true
	});

	$("#sales_team").select2({
		placeholder: "Sales Team...",
		allowClear: true
	});

	$("#state").select2({
		placeholder: "State...",
		allowClear: true
	});

	$("#country").select2({
		placeholder: "Country...",
		allowClear: true
	});

	$("#title").select2({
		placeholder: "Title...",
		allowClear: true
	});

	$("#campaign").select2({
		placeholder: "Email Campaign - Products",
		allowClear: true
	});

	$("#medium").select2({
		placeholder: "Email",
		allowClear: true
	});

	$("#source").select2({
		placeholder: "Search Engine",
		allowClear: true
	});

	$("#referred_by").select2({
		placeholder: "Referred By...",
		allowClear: true
	});
})
