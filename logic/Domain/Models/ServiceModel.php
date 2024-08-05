<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Model\UserModel;

class ServiceModel extends Model {
	protected $_table = 'hestia_services';
	protected $_fields = [
		'service_id',
		'service_category_id',
		'service_type_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function category()
	{
		return $this->ancestor(ServiceCategoryModel::class, 'service_category_id');
	}

	public function type()
	{
		return $this->ancestor(ServiceTypeModel::class, 'service_type_id');
	}
}