<?php

namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class AddressModel extends Model {
	protected $_table = 'hestia_addresses';
	protected $_fields = [
		'address_id',
		'parent_id',
		'parent_type',
		'address_line_one',
		'address_line_two',
		'city',
		'state',
		'zip',
		'country',
		'created_at',
		'updated_at',
	];

	public function parent()
	{
		// Polymorphic relationship with parent
		return $this->ancestor($this->parent_type, 'parent_id', (new $this->parent_type())->idField());
	}
}
