<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ContactModel extends Model {
	protected $_table = 'hestia_contacts';
	protected $_fields = [
		'contact_id',
		'profile_id',
		'contact_type_id',
		'name',
		'description',
		'notes',
		'created_at',
		'updated_at',
	];

	public function type()
	{
		return $this->ancestor(ContactTypeModel::class, 'contact_type_id');
	}
}