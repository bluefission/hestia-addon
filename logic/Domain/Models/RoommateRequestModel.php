<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class RoommateRequestModel extends Model {
	protected $_table = 'hestia_roommate_requests';
	protected $_fields = [
		'roommate_request_id',
		'profile_id',
		'description',
		'notes',
		'status',
		'created_at',
		'updated_at',
	];

	public function profile()
	{
		return $this->ancestor(ProfileModel::class, 'profile_id');
	}
}