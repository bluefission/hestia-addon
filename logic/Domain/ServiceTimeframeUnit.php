<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ServiceTimeframeUnit extends ValueObject {
	public $service_timeframe_unit_id;
	public $name;
	public $created_at;
	public $updated_at;
}
