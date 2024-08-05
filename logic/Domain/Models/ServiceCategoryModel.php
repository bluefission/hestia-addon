<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ServiceCategoryModel extends Model {
	protected $_table = 'hestia_service_categories';
	protected $_fields = [
		'service_category_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function services()
	{
		return $this->descendants(ServiceModel::class, 'service_category_id');
	}

	public function providers()
	{
		return $this->descendants(ServiceProviderModel::class, 'service_category_id');
	}
}
