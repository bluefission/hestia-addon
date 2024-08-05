<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ContactToLodging extends ValueObject {
	public $contact_to_lodging_id;
	public $contact_id;
	public $lodging_id;
	public $created_at;
	public $updated_at;
}