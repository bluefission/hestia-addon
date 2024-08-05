<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ServiceProvider extends ValueObject {
	public $service_provider_id;
	public $service_category_id;
	public $profile_id;
	public $name;
	public $description;
	public $notes;
	public $created_at;
	public $updated_at;
}