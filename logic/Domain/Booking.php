<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Booking extends ValueObject {
	public $booking_id;
	public $lodging_id;
	public $service_provider_id;
	public $datetime;
	public $duration;
	public $booking_status_id;
	public $created_at;
	public $updated_at;
}