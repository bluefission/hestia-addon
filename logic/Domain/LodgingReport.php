<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingReport extends ValueObject {
	public $lodging_report_id;
	public $lodging_id;
	public $report;
	public $created_at;
	public $updated_at;
}