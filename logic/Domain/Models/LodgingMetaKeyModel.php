<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingMetaKeyModel extends Model {
	protected $_table = 'hestia_lodging_meta_keys';
	protected $_fields = [
		'lodging_meta_key_id',
		'name',
		'type',
		'description',
		'created_at',
		'updated_at',
	];

	public function values()
	{
		return $this->descendants(LodgingMetaValueModel::class, 'lodging_meta_key_id');
	}
}