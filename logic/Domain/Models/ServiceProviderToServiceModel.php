<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ServiceProviderToServiceModel extends Model {
	protected $_table = 'hestia_service_provider_to_services';
	protected $_fields = [
		'service_provider_to_service_id',
		'service_provider_id',
		'service_id',
		'created_at',
		'updated_at',
	];
}