<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingAssessment extends ValueObject {
	public $lodging_assessment_id;
	public $lodging_report_id;
	public $service_provider_id;
	public $comments;
	public $created_at;
	public $updated_at;
}