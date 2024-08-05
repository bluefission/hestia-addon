<?php
namespace Addons\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class LodgingAssessmentItem extends ValueObject {
	public $lodging_assessment_item_id;
	public $lodging_assessment_id;
	public $service_id;
	public $priority;
	public $comments;
	public $timeframe;
	public $service_timeframe_unit_id;
	public $cost;
	public $charge_type_id;
	public $created_at;
	public $updated_at;
}