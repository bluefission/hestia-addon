<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ContactTypeModel extends Model {
	protected $_table = 'hestia_contact_types';
	protected $_fields = [
		'contact_type_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];
}
