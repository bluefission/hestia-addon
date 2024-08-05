<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingCondition extends ValueObject {
	public $lodging_condition_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}
