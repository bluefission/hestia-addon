<?php

namespace AddOns\Hestia\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Hestia\Business\Services\AIAssessmentService;
use AddOns\Hestia\Domain\Queries\IAllLodgingsQuery;
use AddOns\Hestia\Domain\Repositories\ILodgingRepository;
use AddOns\Hestia\Domain\Lodging;
use AddOns\Hestia\Domain\Image;

class LodgingController extends BaseController {

    public function index( IAllLodgingsQuery $query ) {
        $lodgings = $query->fetch();
        return response($lodgings);
    }

    public function find( $lodging_report_id, ILodgingRepository $repository ) {
        $lodging = $repository->find($lodging_id);
        return response($lodging);
    }

    public function save( Request $request, ILodgingRepository $repository, IImageRepository $imageRepository ) 
    {
        $lodging = new Lodging;
        foreach ($request->all() as $key => $value) {
            if ( property_exists($lodging, $key) ) {
                $lodging->$key = $value;
            }
        }

        // Save the new model
        $model = $repository->save($lodging);

        // Handle photo uploads and attach to lodging
        if ( $file = $request->file('photo') && $file->save('photos') ) {
            $image = new Image();
            $image->path = $file->path();
            $image->parent_id = $model->id;
            $image->parent_type = get_class($model);
            $image->description = 'Photo';

            $imageRepository->save($image);
        }

        // Return the model
        return response($model);
    }

    public function update( Request $request, ILodgingRepository $repository )
    {
        return $this->save($request, $repository);
    }

    public function report( $lodging_report_id, ILodgingRepository $repository ) {
        $lodging = $repository->find($lodging_id);
        return response($lodging->report()->last());
    }

    public function newReport( $lodging_report_id, AIAssessmentService $assessor ) {
        $lodging = $repository->find($lodging_id);
        // @TODO: make ths a background job
        $assessor->assess($lodging);
        return response(true);
    }

}