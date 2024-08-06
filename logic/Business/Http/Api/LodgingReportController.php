<?php

namespace AddOns\Hestia\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Hestia\Domain\Queries\IAllLodgingReportsQuery;
use AddOns\Hestia\Domain\Repositories\ILodgingReportRepository;
use AddOns\Hestia\Domain\LodgingReport;

class LodgingReportController extends BaseController {

	public function index( IAllLodgingReportsByUserQuery $query ) {
		$lodgingReports = $query->fetch();
		return response($lodgingReports);
	}

	public function find( $lodging_report_id, ILodgingReportRepository $repository ) {
		$lodgingReport = $repository->find($lodging_report_id);
		return response($lodgingReport);
	}
}