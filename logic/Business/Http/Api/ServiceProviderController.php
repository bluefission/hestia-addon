<?php

namespace AddOns\Hestia\Business\Http\Api\Admin;

use BlueFission\Services\Request;
use BlueFission\Services\Authenticator;
use BlueFission\BlueCore\BaseController;
use AddOns\Hestia\Domain\Queries\IAllServiceProvidersQuery;
use AddOns\Hestia\Domain\Repositories\IServiceProviderRepository;
use AddOns\Hestia\Domain\ServiceProvider;

class ServiceProviderController extends BaseController {

	public function index( IAllServiceProvidersQuery $query ) {
		$lodgingReports = $query->fetch();
		return response($lodgingReports);
	}

	public function find( $lodging_report_id, IServiceProviderRepository $repository ) {
		$lodgingReport = $repository->find($lodging_report_id);
		return response($lodgingReport);
	}

	public function search( Request $request, IServiceProviderRepository $repository ) {
		$serviceProviders = $repository->search($request->criteria);
		return response($serviceProviders);
	}

	public function save( Request $request, IServiceProviderRepository $repository, Authenticator $auth ) 
	{
		if ($auth->getUser()->user_id != $request->user_id) {
			return response('Unauthorized', 401);
		}

		$serviceProvider = new ServiceProvider;
		foreach ($request->all() as $key => $value) {
			if ( property_exists($serviceProvider, $key) ) {
				$serviceProvider->$key = $value;
			}
		}

		// Save the new model
		$model = $repository->save($serviceProvider);

		// Return the model
		return response($model);
	}

	public function update( Request $request, IServiceProviderRepository $repository )
	{
		return $this->save($request, $repository);
	}
}