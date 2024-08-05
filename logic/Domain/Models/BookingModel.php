<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class BookingModel extends Model {
	protected $_table = 'hestia_bookings';
	protected $_fields = [
		'booking_id',
		'lodging_id',
		'service_provider_id',
		'datetime',
		'duration',
		'booking_status_id',
		'created_at',
		'updated_at',
	];

	public function lodging()
	{
		return $this->ancestor(LodgingModel::class, 'lodging_id');
	}

	public function status()
	{
		return $this->ancestor(BookingStatusModel::class, 'booking_status_id');
	}

	public function serviceProvider()
	{
		return $this->ancestor(ServiceProviderModel::class, 'service_provider_id');
	}
}