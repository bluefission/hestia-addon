<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Lodging extends ValueObject {
	public $lodging_id;
	public $lodging_type_id;
	public $lodging_condition_id;
	public $profile_id;
	public $description;
	public $notes;
	public $created_at;
	public $updated_at;
}