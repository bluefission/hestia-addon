<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Profile extends ValueObject {
	public $profile_id;
	public $profile_type_id;
	public $user_id;
	public $title;
	public $first_name;
	public $last_name;
	public $suffix;
	public $lodging_stability_id;
	public $budget;
	public $budget_frequency_id;
	public $notes;
	public $created_at;
	public $updated_at;
}