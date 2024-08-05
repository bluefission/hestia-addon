<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingRequest extends ValueObject {
	public $lodging_request_id;
	public $user_id;
	public $description;
	public $notes;
	public $status;
	public $created_at;
	public $updated_at;
}