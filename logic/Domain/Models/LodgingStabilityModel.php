<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingStabilityModel extends Model {
	protected $_table = 'hestia_lodging_stabilities';
	protected $_fields = [
		'lodging_stability_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function profiles()
	{
		return $this->descendants(ProfileModel::class, 'lodging_stability_id');
	}
}