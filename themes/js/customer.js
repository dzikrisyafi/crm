$(document).ready(function () {
	"use strict";

	$("#company_name").select2({
		placeholder: "Company Name...",
		allowClear: true,
	});

	$("#state").select2({
		placeholder: "State...",
		allowClear: true,
	});

	$("#country").select2({
		placeholder: "Country...",
		allowClear: true,
	});

	$("#title").select2({
		placeholder: "Title...",
		allowClear: true,
	});

	$("#tag").select2({
		placeholder: "Tags...",
		allowClear: true,
	});
});
