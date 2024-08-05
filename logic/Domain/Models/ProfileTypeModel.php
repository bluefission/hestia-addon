<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ProfileTypeModel extends Model {
	protected $_table = 'hestia_profile_types';
	protected $_fields = [
		'profile_type_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function profiles()
	{
		return $this->descendents(ProfileModel::class, 'profile_type_id');
	}
}