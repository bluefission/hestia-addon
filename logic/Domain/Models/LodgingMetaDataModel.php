<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingMetaDataModel extends Model {
	protected $_table = 'hestia_lodging_meta_data';
	protected $_fields = [
		'lodging_meta_data_id',
		'lodging_meta_key_id',
		'lodging_id',
		'value',
		'created_at',
		'updated_at',
	];

	public function lodging()
	{
		return $this->ancestor(LodgingModel::class, 'lodging_id');
	}

	public function key()
	{
		return $this->ancestor(LodgingMetaKeyModel::class, 'lodging_meta_key_id');
	}
}