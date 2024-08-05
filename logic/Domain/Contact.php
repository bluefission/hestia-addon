<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Contact extends ValueObject {
	public $lodging_contact_id;
	public $lodging_id;
	public $profile_id;
	public $contact_type_id;
	public $name;
	public $description;
	public $notes;
	public $created_at;
	public $updated_at;
}