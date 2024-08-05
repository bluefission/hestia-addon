<?php

namespace AddOns\Hestia\Business\Http\Api\Admin;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Hestia\Domain\Queries\IAllLodgingReportsQuery;
use AddOns\Hestia\Domain\Repositories\ILodgingReportRepository;
use AddOns\Hestia\Domain\LodgingReport;

class LodgingReportController extends BaseController {

    public function index( IAllLodgingReportsQuery $query ) {
        $lodgings = $query->fetch();
        return response($lodgings);
    }

    public function find( $lodging_report_id, ILodgingReportRepository $repository ) {
        $lodgingReport = $repository->find($lodging_id);
        return response($lodgingReport);
    }

    public function save( Request $request, ILodgingReportRepository $repository )
    {
        $lodgingReport = new LodgingReport;
        foreach ($request->all() as $key => $value) {
            if ( property_exists($lodgingReport, $key) ) {
                $lodgingReport->$key = $value;
            }
        }

        // Save the new model
        $response = $repository->save($lodgingReport);

        // Return the id
        return response($response);
    }

    public function update( Request $request, ILodgingReportRepository $repository )
    {
        return $this->save($request, $repository);
    }
}