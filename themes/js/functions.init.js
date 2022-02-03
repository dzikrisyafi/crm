// error validate init
let errorValidate = function (error, element) {
	let elem = $(element);
	if (elem.hasClass("select2-hidden-accessible")) {
		element = $("#select2-" + elem.attr("id") + "-container").parent();
		error.insertAfter(element);
	} else {
		error.insertAfter(element);
	}
}

let highlight = function (element, errorClass, validClass) {
	let elem = $(element);
	if (elem.hasClass("select2-offscreen")) {
		$("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
	} else {
		elem.addClass(errorClass);
	}
}

// When removing make the same adjustments as when adding
let unhighlight = function (element, errorClass, validClass) {
	var elem = $(element);
	if (elem.hasClass("select2-offscreen")) {
		$("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
	} else {
		elem.removeClass(errorClass);
	}
}

function getDetail(id, action) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			url: action,
			method: "GET",
			data: {
				id: id,
			},
			dataType: "JSON"
		}).done(function (res) {
			resolve(res);
		}).fail(function () {
			reject("Failed to get data!");
		});
	});
}

function save(data, action) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			url: action,
			method: "POST",
			data: data,
			dataType: "JSON",
			processData: false,
			contentType: false,
			cache: false,
			async: false,
		}).done(function (res) {
			resolve(res);
		}).fail(function () {
			reject('Failed to save data!');
		});
	});
}

function update(data, action) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			url: action,
			method: "POST",
			data: data,
			dataType: "JSON"
		}).done(function (res) {
			resolve(res);
		}).fail(function () {
			reject('Failed to save changes!');
		})
	})
}

function destroy(id, action) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			url: action,
			method: "POST",
			data: {
				id: id,
			}
		}).done(function (res) {
			resolve(res);
		}).fail(function () {
			reject('Failed to delete data!');
		});
	});
}

function base_url(param) {
	var pathparts = location.pathname.split('/');
	if (location.host == 'localhost' || location.host == '127.0.0.1') {
		var url = location.origin + '/' + pathparts[1].trim('/') + '/';
	} else {
		var url = location.origin + '/';
	}
	return param ? url + param : url;
}

function querySelectorAllArray(selector) {
	return Array.prototype.slice.call(document.querySelectorAll(selector), 0);
}

function set(array) {
	return array.filter((item, index) => array.indexOf(item) === index);
}
