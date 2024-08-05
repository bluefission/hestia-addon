<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ContactToLodgingModel extends Model {
	protected $_table = 'hestia_contact_to_lodging';
	protected $_fields = [
		'contact_to_lodging_id'
		'contact_id',
		'lodging_id',
		'created_at',
		'updated_at',
	];