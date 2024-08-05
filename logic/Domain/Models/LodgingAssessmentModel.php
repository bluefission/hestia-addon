<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingAssessmentModel extends Model {
	protected $_table = 'hestia_lodging_assessments';
	protected $_fields = [
		'lodging_assessment_id',
		'lodging_report_id',
		'service_provider_id',
		'comments',
		'created_at',
		'updated_at',
	];

	public function report() {
		return $this->ancestor(LodgingReportModel::class, 'lodging_report_id');
	}

	public function serviceProvider() {
		return $this->ancestor(ServiceProviderModel::class, 'service_provider_id');
	}
}