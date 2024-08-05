<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingMetaData extends ValueObject {
	public $lodging_meta_data_id;
	public $lodging_meta_key_id;
	public $lodging_id;
	public $value;
	public $created_at;
	public $updated_at;
}
