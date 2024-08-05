<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ServiceTypeModel extends Model {
	protected $_table = 'hestia_service_types';
	protected $_fields = [
		'service_type_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];
}
