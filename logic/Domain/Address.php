<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Address extends ValueObject {
	public $lodging_address_id;
	public $parent_id;
	public $parent_type;
	public $address_line_one;
	public $address_line_two;
	public $city;
	public $state;
	public $zip;
	public $country;
	public $created_at;
	public $updated_at;
}