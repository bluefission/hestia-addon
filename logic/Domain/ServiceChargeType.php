<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ServiceChargeType extends ValueObject {
	public $service_charge_type_id;
	public $name;
	public $created_at;
	public $updated_at;
}