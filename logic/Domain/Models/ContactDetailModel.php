<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ContactDetailModel extends Model {
	protected $_table = 'hestia_contact_details';
	protected $_fields = [
		'contact_detail_id',
		'contact_id',
		'contact_detail_type_id',
		'name',
		'value',
		'notes',
		'is_primary',
		'is_public',
		'is_verified',
		'created_at',
		'updated_at',
	];

	public function contact()
	{
		return $this->ancestor(LodgingContactModel::class, 'contact_id');
	}

	public function type()
	{
		return $this->ancestor(LodgingContactDetailTypeModel::class, 'contact_detail_type_id');
	}

	public function user()
	{
		return $this->ancestor(UserModel::class, 'user_id');
	}
}