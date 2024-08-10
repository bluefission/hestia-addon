import "../../../../resource/src/js/modules/datatables";
import { Model, Reactor, ReactiveTemplate } from "../../../../resource/src/js/modules/scripts/reactive_template.js";
import Template from "../../../../resource/src/js/modules/scripts/template.js";
import PresentationModal from "../../../../resource/src/js/modules/scripts/presentation-modal.js";
import BlueFissionCrud from "../../../../resource/src/js/modules/app/bluefission-crud.js";

// Initialize CRUD API endpoints
app.api.lodging = new BlueFissionCrud('lodgings');
app.api.user = new BlueFissionCrud('users');
app.api.provider = new BlueFissionCrud('service_providers');
app.api.request = new BlueFissionCrud('lodging_requests');
app.api.profile = new BlueFissionCrud('profiles');

app.api.lodging.count = function(callback) {
	this._transaction('lodgings/count', data, 'GET', callback);
}

app.api.lodging.managed.count = function(callback) {
	this._transaction('lodgings/managed/count', data, 'GET', callback);
}

app.api.profile.count = function(callback) {
	this._transaction('profiles/count', data, 'GET', callback);
}

app.api.provider.count = function(callback) {
	this._transaction('service_providers/count', data, 'GET', callback);
}

app.api.provider.services.count = function(callback) {
	this._transaction('service_providers/services/count', data, 'GET', callback);
}

app.api.provider.services.completed.count = function(callback) {
	this._transaction('service_providers/services/completed/count', data, 'GET', callback);
}

app.api.provider.services.active.count = function(callback) {
	this._transaction('service_providers/services/active/count', data, 'GET', callback);
}

app.api.request.count = function(callback) {
	this._transaction('lodging_requests/count', data, 'GET', callback);
}

app.api.request.completed.count = function(callback) {
	this._transaction('lodging_requests/completed/count', data, 'GET', callback);
}

app.api.request.active.count = function(callback) {
	this._transaction('lodging_requests/active/count', data, 'GET', callback);
}

//== Class definition
var ModuleHestiaAddon = function() {
	var dataTable;
	const inputOptions = {
	  rejectOn: isNaN,
	  mutator: Number
	};

	// Define your model for Hestia
	const model = new Model;
	model.lodging_id = new Reactor(0);
	model.name = new Reactor("");
	model.description = new Reactor("");
	model.status = new Reactor("");

	// Define KPIs for Hestia
	const kpi_01_name = new Reactor("Owner Count");
	const kpi_01_value = new Reactor(0);
	const kpi_02_name = new Reactor("Seeker Count");
	const kpi_02_value = new Reactor(0);
	const kpi_03_name = new Reactor("Provider Count");
	const kpi_03_value = new Reactor(0);
	const kpi_04_name = new Reactor("Facilitator Count");
	const kpi_04_value = new Reactor(0);
	const kpi_05_name = new Reactor("Match Rate");
	const kpi_05_value = new Reactor(0);

	// Assign KPIs to the app
	app.assign('kpi_01_name', kpi_01_name);
	app.assign('kpi_01_value', kpi_01_value);
	app.assign('kpi_02_name', kpi_02_name);
	app.assign('kpi_02_value', kpi_02_value);
	app.assign('kpi_03_name', kpi_03_name);
	app.assign('kpi_03_value', kpi_03_value);
	app.assign('kpi_04_name', kpi_04_name);
	app.assign('kpi_04_value', kpi_04_value);
	app.assign('kpi_05_name', kpi_05_name);
	app.assign('kpi_05_value', kpi_05_value);

	// Assign model fields to UI elements
	app.set('.lodging-id-field', model.lodging_id, 'value', inputOptions);
	app.set('.lodging-name-field', model.name, 'value');
	app.set('.lodging-description-field', model.description, 'value');
	app.set('.lodging-status-field', model.status, 'value');

	app.set('#lodging-id', model.lodging_id, 'value', inputOptions);
	app.set('#lodging-name', model.name, 'value');
	app.set('#lodging-description', model.description, 'value');
	app.set('#lodging-status', model.status, 'value');

	// Load the lodging list into a DataTable
	var loadLodgingList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/lodgings',
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
					render: function (data, type, row) {
						return truncate(data, 10) + '...';
					}
				},
				{ 
					data: 'status',
					render: function (data, type, row ) {
						return data == 1 ? `<span class="badge rounded-pill bg-success">Active</span>` : `<span class="badge rounded-pill bg-secondary">Inactive</span>`;
					}
				},
				{
					data: null,
					render: function (data, type, row ) {
						return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ' 
						+'&nbsp;<button class="btn btn-sm btn-secondary settings-btn"><i class="fa fa-gear"></i></button>';
					}
				}
			]
		});
	};

	// Function to display lodging details
	var lodgingShow = function() {
		$("#dataTable").on("click", ".show-btn", function(e) {
			e.preventDefault();
			var data = dataTable.row($(this).parents('tr')).data();
			app.api.lodging.read(data.lodging_id, function(response) {
				model.update(response.data);
				const template = new Template('#lodging-detail-display-item', model);
				template.render();
				template.swap('#lodging-details');
			});
		});
	};

	// Function to edit a lodging entry
	var lodgingEdit = function() {
		$('#lodging-preview').on('click', '#lodging-edit-btn', function(e) {
			e.preventDefault();
			showEditScreen();
		});
	};

	// Function to create a new lodging entry
	var lodgingNew = function() {
		$('#lodging-add-btn').on('click', function(e) {
			e.preventDefault();
			model.clear();
			showEditScreen();
		});
	};

	// Function to delete a lodging entry
	var lodgingDelete = function() {
		$('#lodging-delete-btn').click(function() {
			app.api.lodging.delete(model, function(response) {
				app.ui.notice("Lodging has been deleted");
				dataTable.ajax.reload();
			});
		});
	};

	// Function to save a lodging entry
	var lodgingSave = function() {
		$('.save-btn').click(function(e) {
			e.preventDefault();
			app.api.lodging.save(model, function(response) {
				if (!response.id) {
					app.ui.notice(response.status, 'error');
					return;
				}
				model.clear();
				dataTable.ajax.reload();
				app.ui.notice("Lodging has been saved");
			});
		});
	};

	// Additional utility functions
	var truncate = function(str, no_words) {
		return str.split(" ").splice(0,no_words).join(" ");
	};

	var screenHome = function() {
		$('.home-btn').click(function(e) {
			showListingScreen();
		});
	};

	var showEditScreen = function() {
		$('#lodging-listing-screen').fadeOut(200, function(e) {
			$('#lodging-edit-screen').fadeIn(200);
		});
	};

	var showListingScreen = function() {
		$('#lodging-edit-screen').fadeOut(200, function(e) {
			$('#lodging-listing-screen').fadeIn(200);
		});
	};

	var ready = function() {
		$('#lodging-edit-screen').hide();
		feather.replace();
	};

	// Main function to initiate the module
	return {
		init: function () {
			screenHome();
			loadLodgingList();
			lodgingShow();
			lodgingNew();
			lodgingEdit();
			lodgingDelete();
			lodgingSave();
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
	ModuleHestiaAddon.init();
});

export default ModuleHestiaAddon;