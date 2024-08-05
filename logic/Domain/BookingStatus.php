<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Booking extends ValueObject {
	public $booking_status_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}