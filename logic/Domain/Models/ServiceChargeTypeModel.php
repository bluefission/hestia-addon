<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ServiceChargeTypeModel extends Model {
	protected $_table = 'hestia_service_charge_types';
	protected $_fields = [
		'service_charge_type_id',
		'name',
		'created_at',
		'updated_at',
	];
}