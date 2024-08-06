<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Age extends ValueObject {
	public $age_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}