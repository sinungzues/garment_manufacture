/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 4.6.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin/admin/
*/

var handleDataTableFixedColumns = function() {
	"use strict";
    
	if ($('#data-table-fixed-columns').length !== 0) {
		$('#data-table-fixed-columns').DataTable({
			dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
			buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
			],
			responsive: true ,
			scrollY:        '500px',
			scrollX:        true,
			scrollCollapse: true,
			paging:         false,
			fixedColumns:   true
		});
	}
};

var TableManageFixedColumns = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableFixedColumns();
		}
	};
}();
$(document).ready(function() {
	TableManageFixedColumns.init();
});