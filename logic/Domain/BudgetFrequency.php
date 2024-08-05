<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class BudgetFrequency extends ValueObject {
	public $budget_frequency_id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
}