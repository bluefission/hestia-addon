<?php

namespace AddOns\Hestia\Business\Http\Api\Admin;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Hestia\Domain\Queries\IAllLodgingsQuery;
use AddOns\Hestia\Domain\Repositories\ILodgingRepository;
use AddOns\Hestia\Domain\Lodging;

class LodgingController extends BaseController {

    public function index( IAllLodgingsQuery $query ) {
        $lodgings = $query->fetch();
        return response($lodgings);
    }

    public function find( $lodging_report_id, ILodgingRepository $repository ) {
        $lodging = $repository->find($lodging_id);
        return response($lodging);
    }

    public function save( Request $request, ILodgingRepository $repository )
    {
        $lodging = new Lodging;
        foreach ($request->all() as $key => $value) {
            if ( property_exists($lodging, $key) ) {
                $lodging->$key = $value;
            }
        }

        // Save the new model
        $response = $repository->save($lodging);

        // Return the id
        return response($response);
    }

    public function update( Request $request, ILodgingRepository $repository )
    {
        return $this->save($request, $repository);
    }
}