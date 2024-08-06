<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class AgeModel extends Model {
	protected $_table = 'hestia_ages';
	protected $_fields = [
		'age_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];
}