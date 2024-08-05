<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Image extends ValueObject {
	public $image_id;
	public $parent_id;
	public $parent_type;
	public $path;
	public $description;
	public $notes;
	public $created_at;
	public $updated_at;
}