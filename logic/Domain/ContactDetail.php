<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ContactDetail extends ValueObject {
	public $contact_detail_id;
	public $contact_id;
	public $contact_detail_type_id;
	public $name;
	public $value;
	public $notes;
	public $is_primary;
	public $is_public;
	public $is_verified;
	public $created_at;
	public $updated_at;
}