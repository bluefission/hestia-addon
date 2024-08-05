<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ContactType extends ValueObject {
	public $contact_type_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}