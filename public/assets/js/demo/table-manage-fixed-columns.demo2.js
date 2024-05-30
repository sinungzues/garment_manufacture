/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 4.6.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin/admin/
*/

var handleDataTableFixedColumns1 = function() {
	"use strict";

	if ($('#data-table-fixed-columns1').length !== 0) {
		$('#data-table-fixed-columns1').DataTable({
			scrollY:        450,
			scrollX:        true,
			scrollCollapse: true,
			paging:         false,
			fixedColumns:   true
		});
	}
};

var TableManageFixedColumns1 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableFixedColumns1();
		}
	};
}();

$(document).ready(function() {
	TableManageFixedColumns1.init();
});

var handleDataTableFixedColumns2 = function() {
	"use strict";

	if ($('#data-table-fixed-columns2').length !== 0) {
		$('#data-table-fixed-columns2').DataTable({
			scrollY:        450,
			scrollX:        true,
			scrollCollapse: true,
			paging:         false,
			fixedColumns:   true
		});
	}
};

var TableManageFixedColumns2 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableFixedColumns2();
		}
	};
}();

$(document).ready(function() {
	TableManageFixedColumns2.init();
});


var handleDataTableFixedColumns3 = function() {
	"use strict";

	if ($('#data-table-fixed-columns3').length !== 0) {
		$('#data-table-fixed-columns3').DataTable({
			scrollY:        450,
			scrollX:        true,
			scrollCollapse: true,
			paging:         false,
			fixedColumns:   true
		});
	}
};

var TableManageFixedColumns3 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableFixedColumns3();
		}
	};
}();

$(document).ready(function() {
	TableManageFixedColumns3.init();
});