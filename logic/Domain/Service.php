<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Service extends ValueObject {
	public $service_id;
	public $service_category_id;
	public $service_type_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}