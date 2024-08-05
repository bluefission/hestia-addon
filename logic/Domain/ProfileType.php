<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ProfileType extends ValueObject {
	public $profile_type_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}