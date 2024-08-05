<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingMetaKey extends ValueObject {
	public $lodging_meta_key_id;
	public $name;
	public $type; // string, numeric, date, json, etc
	public $description;
	public $created_at;
	public $updated_at;
}