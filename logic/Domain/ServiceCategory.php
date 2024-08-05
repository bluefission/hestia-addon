<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ServiceCategory extends ValueObject {
	public $service_category_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}