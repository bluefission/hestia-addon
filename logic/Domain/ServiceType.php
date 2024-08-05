<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ServiceType extends ValueObject {
	public $service_type_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}