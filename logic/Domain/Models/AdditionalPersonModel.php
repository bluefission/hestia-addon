<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class AdditionalPersonModel extends Model {
	protected $_table = 'hestia_additional_people';
	protected $_fields = [
		'additional_person_id',
		'parent_id',
		'parent_type',
		'profile_id',
		'age_id',
		'created_at',
		'updated_at',
	];

	public function parent()
	{
		// Polymorphic relationship with parent
		return $this->ancestor($this->parent_type, 'parent_id', (new $this->parent_type())->idField());
	}

	public function profile()
	{
		return $this->belongsTo('Profile', 'profile_id');
	}

	public function age()
	{
		return $this->belongsTo('Age', 'age_id');
	}
}
