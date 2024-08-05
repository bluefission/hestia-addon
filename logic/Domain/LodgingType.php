<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingType extends ValueObject {
	public $lodging_type_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}