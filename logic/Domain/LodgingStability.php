<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingStability extends ValueObject {
	public $lodging_stability_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}