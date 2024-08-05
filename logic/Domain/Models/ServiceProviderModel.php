<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ServiceProviderModel extends Model {
	protected $_table = 'hestia_service_providers';
	protected $_fields = [
		'service_provider_id',
		'service_category_id',
		'profile_id',
		'name',
		'description',
		'notes',
		'created_at',
		'updated_at',
	];

	public function category()
	{
		return $this->ancestor(ServiceCategoryModel::class, 'service_category_id');
	}

	public function profile()
	{
		return $this->ancestor(UserModel::class, 'profile_id');
	}

	public function bookings()
	{
		return $this->descendants(BookingModel::class, 'service_provider_id');
	}
}