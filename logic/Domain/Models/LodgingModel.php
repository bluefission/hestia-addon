<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingModel extends Model {
	protected $_table = 'hestia_lodgings';
	protected $_fields = [
		'lodging_id',
		'lodging_type_id',
		'lodging_condition_id',
		'profile_id',
		'built_year',
		'renovated_year',
		'description',
		'notes',
		'created_at',
		'updated_at',
	];

	public function address()
	{
		return $this->descendants(Address::class, 'address_id');
	}

	public function contacts()
	{
		return $this->associates(ContactModel::class, ContactToLodgingModel::class, 'lodging_id', 'contact_id');
	}

	public function type()
	{
		return $this->ancestor(LodgingTypeModel::class, 'lodging_type_id');
	}

	public function condition()
	{
		return $this->ancestor(LodgingConditionModel::class, 'lodging_condition_id');
	}

	public function meta()
	{
		return $this->descendants(LodgingMetaDataModel::class, 'lodging_id');
	}

	public function images()
	{
		return $this->descendants(ImageModel::class, 'lodging_id', 'parent_id');
	}

	public function reports()
	{
		return $this->descendants(LodgingReportModel::class, 'lodging_id');
	}

	public function bookings()
	{
		return $this->descendants(BookingModel::class, 'lodging_id');
	}
}