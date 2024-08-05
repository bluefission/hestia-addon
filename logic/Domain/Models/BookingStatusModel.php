<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class BookingStatusModel extends Model {
	protected $_table = 'hestia_booking_statuses';
	protected $_fields = [
		'booking_status_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function bookings()
	{
		return $this->descendents(BookingModel::class, 'booking_status_id');
	}
}