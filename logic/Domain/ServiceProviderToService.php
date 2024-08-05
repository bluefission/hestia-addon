<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class ServiceProviderToService extends ValueObject {
	public $service_provider_to_service_id;
	public $service_provider_id;
	public $service;
	public $created_at;
	public $updated_at;
}