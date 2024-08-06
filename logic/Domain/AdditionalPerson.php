<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class AdditionalPerson extends ValueObject {
	public $additional_person_id;
	public $parent_id;
	public $parent_type;
	public $profile_id;
	public $age_id;
	public $created_at;
	public $updated_at;
}