<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class RoommateRequest extends ValueObject {
	public $roommate_request_id;
	public $profile_id;
	public $budget;
	public $location;
	public $start_date;
	public $duration;
	public $number_of_rooms;
	public $number_of_people;
	public $pets;
	public $smoking;
	public $allergies;
	public $description;
	public $notes;
	public $status;
	public $created_at;
	public $updated_at;
}