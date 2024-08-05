<?php
use BlueFission\Services\Mapping;

Mapping::crud('api', '', 'AddOns\Hestia\Business\Http\Api\LodgingController', 'lodging_id');

// Lodging Reports
Mapping::add('api/lodging/reports', ['AddOns\Hestia\Business\Http\Api\LodgingReportController', 'index'], 'hestia.lodging-report.index', 'get');
Mapping::add('api/lodging/reports/{lodging_report_id}', ['AddOns\Hestia\Business\Http\Api\LodgingReportController', 'find'], 'hestia.lodging-report.find', 'get');

// Lodging
Mapping::add('api/lodging', ['AddOns\Hestia\Business\Http\Api\LodgingController', 'index'], 'hestia.lodging.index', 'get');
Mapping::add('api/lodging/{lodging_id}', ['AddOns\Hestia\Business\Http\Api\LodgingController', 'find'], 'hestia.lodging.find', 'get');
Mapping::add('api/lodging/{lodging_id}/report', ['AddOns\Hestia\Business\Http\Api\LodgingController', 'report'], 'hestia.lodging.report', 'get');
Mapping::add('api/lodging/{lodging_id}/report/new', ['AddOns\Hestia\Business\Http\Api\LodgingController', 'newReport'], 'hestia.lodging.new-report', 'get');

Mapping::crud('api/admin', '', 'AddOns\Hestia\Business\Http\Api\Admin\LodgingController', 'lodging_id');
