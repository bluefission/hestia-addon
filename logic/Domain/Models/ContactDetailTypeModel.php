<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ContactDetailTypeModel extends Model {
	protected $_table = 'hestia_contact_detail_types';
	protected $_fields = [
		'contact_detail_type_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];
}