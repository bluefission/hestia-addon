<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingTypeModel extends Model {
	protected $_table = 'hestia_lodging_types';
	protected $_fields = [
		'lodging_type_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function lodgings()
	{
		return $this->descendants(LodgingModel::class, 'lodging_type_id');
	}
}
