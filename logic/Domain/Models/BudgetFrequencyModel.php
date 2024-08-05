<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class BudgetFrequencyModel extends Model {
	protected $_table = 'hestia_budget_frequencies';
	protected $_fields = [
		'budget_frequency_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	public function profiles()
	{
		return $this->descendents(ProfileModel::class, 'budget_frequency_id');
	}
}