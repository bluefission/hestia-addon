<?php

namespace AddOns\Hetia\Domain\Repositories;

use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;

interface IServiceProviderRepository extends IGenericRepository {
	public function search( $criteria );
}