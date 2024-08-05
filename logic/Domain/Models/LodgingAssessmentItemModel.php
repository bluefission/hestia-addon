<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingAssessmentItemModel extends Model {
	protected $_table = 'hestia_lodging_assessment_items';
	protected $_fields = [
		'lodging_assessment_item_id',
		'lodging_assessment_id',
		'service_id',
		'priority',
		'comments',
		'timeframe',
		'service_timeframe_unit_id',
		'cost',
		'service_charge_type_id',
		'created_at',
		'updated_at',
	];

	public function assessment() {
		return $this->ancestor(LodgingAssessmentModel::class, 'lodging_assessment_id');
	}

	public function service() {
		return $this->ancestor(ServiceModel::class, 'service_id');
	}

	public function timeframeUnit() {
		return $this->ancestor(TimeframeUnitModel::class, 'service_timeframe_unit_id');
	}

	public function chargeType() {
		return $this->ancestor(ServiceChargeTypeModel::class, 'service_charge_type_id');
	}
}