<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ContactDetailType extends ValueObject {
	public $contact_detail_type_id;
	public $name; // Email, Phone, Mobile, etc
	public $description;
	public $created_at;
	public $updated_at;
}