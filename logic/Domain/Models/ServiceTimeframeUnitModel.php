<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ServiceTimeframeUnitModel extends Model {
	protected $_table = 'hestia_service_timeframe_units';
	protected $_fields = [
		'service_timeframe_unit_id',
		'name',
		'created_at',
		'updated_at',
	];
}