import "../../../../resource/src/js/modules/datatables";
import { Model, Reactor, ReactiveTemplate } from "../../../../resource/src/js/modules/scripts/reactive_template.js";
import Template from "../../../../resource/src/js/modules/scripts/template.js";
import PresentationModal from "../../../../resource/src/js/modules/scripts/presentation-modal.js"
import BlueFissionCrud from "../../../../resource/src/js/modules/app/bluefission-crud.js"

app.api.student = new BlueFissionCrud('students');

//== Class definition
var ModuleStudents = function() {
	var dataTable;
	const inputOptions = {
	  rejectOn: isNaN,
	  mutator: Number
	};

	const model = new Model;
	model.student_id = new Reactor(0);
	model.name = new Reactor("");
	model.description = new Reactor("");
	model.status = new Reactor("");

	const kpi_01_name = new Reactor("Retention Rate");
	const kpi_01_value = new Reactor(0);
	const kpi_02_name = new Reactor("Dropout Rate");
	const kpi_02_value = new Reactor(0);
	const kpi_03_name = new Reactor("Intervention Effectiveness");
	const kpi_03_value = new Reactor(0);
	const kpi_04_name = new Reactor("Student Engagements");
	const kpi_04_value = new Reactor(0);

	app.assign('kpi_01_name', kpi_01_name);
	app.assign('kpi_01_value', kpi_01_value);
	app.assign('kpi_02_name', kpi_02_name);
	app.assign('kpi_02_value', kpi_02_value);
	app.assign('kpi_03_name', kpi_03_name);
	app.assign('kpi_03_value', kpi_03_value);
	app.assign('kpi_04_name', kpi_04_name);
	app.assign('kpi_04_value', kpi_04_value);

	const settings = new Model;
	settings.settings_id = new Reactor(0);
	settings.student_id = new Reactor(0);
	settings.value = new Reactor("");

	app.assign('student_name', model.name);
	app.set('.student-id-field', model.student_id, 'value', inputOptions);
	app.set('.student-name-field', model.name, 'value');
	app.set('.student-description-field', model.description, 'value');
	app.set('.student-status-field', model.status, 'value');

	app.set('#student-id', model.student_id, 'value', inputOptions);
	app.set('#student-name', model.name, 'value');
	app.set('#student-description', model.description, 'value');
	app.set('#student-status', model.status, 'value');

	// app.set('.settings-id', settings.settings_id, 'value', inputOptions);
	// app.set('.settings-student-id', settings.student_id, 'value', inputOptions);
	// app.set('.settings-value', settings.name, 'value');

	var ready = function() {
		$('#student-edit-screen').hide();
		feather.replace();
	};
	
	var showEditScreen = function() {
		$('#student-listing-screen').fadeOut(200, function(e) {
			$('#student-edit-screen').fadeIn(200);
		});
	};

	var showListingScreen = function() {
		$('#student-edit-screen').fadeOut(200, function(e) {
			$('#student-listing-screen').fadeIn(200);
		});
	};

	var screenHome = function() {
		$('.home-btn').click(function(e) {
			showListingScreen();
		});
	};

	var loadStudentList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/students',
				dataSrc: 'list'
			},
			aoColumnDefs: [
        { "bSortable": false, "aTargets": [ 3 ] }, 
        { "bSearchable": false, "aTargets": [ 2, 3 ] }
	    ],
			columns: [
				{
        	data: 'name',
					render: function(data, type, row) {
					  return `<a href="#" class="show-btn">${data}</a>`;
					},
				},
        { 
        	data: 'description',
        	render: function ( data, type, row ) {
        		return truncate(data, 10) + '...';
        	}
        },
        { 
        	data: 'status',
        	render: function ( data, type, row ) {
				    return data == 1 ? `<span class="badge rounded-pill bg-success">Active</span>` : `<span class="badge rounded-pill bg-secondary">Inactive</span>`;
			  	}
        },
        {
				  data: null,
				  render: function ( data, type, row ) {
				    return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ' 
				    +'&nbsp;<button class="btn btn-sm btn-secondary settings-btn"><i class="fa fa-gear"></i></button>';
			  	}
				}
	   	]
		});
	};

	var studentGenerate = function() {
		$('#student-generate-btn').on('click', function(e) {
			e.preventDefault();
			app.api.student.generate(model, function(response) {
				showListingScreen();
				app.ui.notice(response.status);
	    });
    });
	};

	var studentShow = function() {
		$("#dataTable").on("click", ".show-btn", function(e) {
			e.preventDefault();
			// Get the row data (tr element) containing the clicked cell
			var data = dataTable.row( $(this).parents('tr') ).data();
		
			app.api.student.read(data.student_id, function(response) {
				model.update(response.data);
				// showEditScreen();
				const template = new Template('#student-detail-display-item', model);
				template.render();
				template.swap('#student-details');
	    });
		});
	};

	var studentEdit = function() {
		$('#student-preview').on('click', '#student-edit-btn', function(e) {
			e.preventDefault();
			// Get the row data (tr element) containing the clicked cell
		
			showEditScreen();
		});
	};

	var studentNew = function() {
		$('#student-add-btn').on('click', function(e) {
			e.preventDefault();
			model.clear();
			// $('#modalNewStudent').modal('show');
			showEditScreen();
    });
	};

	var studentDelete = function() {
		$('#student-delete-btn').click(function() {
			app.api.student.delete(model, function(response) {
				app.ui.notice("Student has been deleted");
        dataTable.ajax.reload();
			});
		});
	};
	
	var studentChange = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			let data = dataTable.row( $(this).parents('tr') ).data();
			let student_id = data.student_id;
			app.api.student.read(student_id, function(response) {
				model.update(response.data);
				$('#modalNewStudent').modal('show');
			});
    });
	};

	var studentSave = function() {
		$('.save-btn').click(function(e) {
			e.preventDefault();
			app.api.student.save(model, function(response) {
				if (!response.id) {
					app.ui.notice(response.status, 'error');
					return;
				}
			model.clear();
	        dataTable.ajax.reload();
	        $('#modalNewStudent').modal('hide');
					app.ui.notice("Student has been saved");
				});
			});

			$('#student-save-btn').click(function(e) {
				e.preventDefault();
				app.api.student.save(model, function(response) {
					if (!response.id) {
						app.ui.notice(response.status, 'error');
						return;
					}
				model.clear();
		        dataTable.ajax.reload();
		        showListingScreen();
				app.ui.notice("Student has been saved");
			});
		});
	};

	var studentManage = function() {
		$('#dataTable').on('click', '.settings-btn', function(e) {
			e.preventDefault();
			let data = dataTable.row( $(this).parents('tr') ).data();
			let student_id = data.student_id;
			app.api.student_settings.read(student_id, function(response) {
				$('#modalStudentSettings').modal('show');
			});
    });
	};

	var studentConfigure = function() {
		$('#student-settings-save-btn').click(function() {
			app.api.student_settings.save(settings, function(response) {
        $('#modalNewStudent').modal('hide');
				app.ui.notice("Student settings have been saved");
			});
		});
	};

	var truncate = function(str, no_words) {
    return str.split(" ").splice(0,no_words).join(" ");
	};

	return {
        //main function to initiate the module
        init: function () {

        	screenHome();
        	loadStudentList();
        	studentShow();
        	studentNew();
        	studentEdit();
        	studentChange();
        	studentManage();
        	studentConfigure();
        	studentSave();
        	studentGenerate();

        	ready();

        	$(document).ajaxStart(function() {
				    $('#loadingOverlay').show();
					});

					$(document).ajaxStop(function() {
				    $('#loadingOverlay').hide();
					});

        }
    };
}();

jQuery(document).ready(function() {
    ModuleStudents.init();
});

export default ModuleStudents;