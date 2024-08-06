<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ProfileModel extends Model {
	protected $_table = 'hestia_profiles';
	protected $_fields = [
		'profile_id',
		'user_id',
		'title',
		'first_name',
		'last_name',
		'suffix',
		'current_lodging_id',
		'lodging_stability_id',
		'budget',
		'budget_frequency_id',
		'notes',
	];

	public function type()
	{
		return $this->ancestor(ProfileTypeModel::class, 'profile_type_id');
	}

	public function user()
	{
		return $this->ancestor(UserModel::class, 'user_id');
	}

	public function contacts()
	{
		return $this->descendents(ContactModel::class, 'contact_id');
	}

	public function budgetFrequency()
	{
		return $this->ancestor(ProfileTypeModel::class, 'budget_frequency_id');
	}

	public function lodgings()
	{
		return $this->descendents(LodgingModel::class, 'profile_id');
	}

	public function currentLodging()
	{
		return $this->ancestor(LodgingModel::class, 'current_lodging_id', 'lodging_id');
	}
}