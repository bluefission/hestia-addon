<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingConditionModel extends Model {
	protected $_table = 'hestia_lodging_conditions';
	protected $_fields = [
		'lodging_condition_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function lodgings()
	{
		return $this->descendants(LodgingModel::class, 'lodging_id');
	}
}
