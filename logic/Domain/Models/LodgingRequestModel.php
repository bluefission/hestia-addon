<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingRequestModel extends Model {
	protected $_table = 'hestia_lodging_requests';
	protected $_fields = [
		'lodging_request_id',
		'user_id',
		'description',
		'notes',
		'status',
		'created_at',
		'updated_at',
	];

	public function user()
	{
		return $this->ancestor(UserModel::class, 'user_id');
	}
}