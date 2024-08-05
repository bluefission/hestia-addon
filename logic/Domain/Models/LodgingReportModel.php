<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LodgingReportModel extends Model {
	protected $_table = 'hestia_lodging_reports';
	protected $_fields = [
		'lodging_report_id',
		'lodging_id',
		'report',
		'created_at',
		'updated_at',
	];

	public function assessments() {
		return $this->descendants(LodgingAssessment::class, 'loding_report_id');
	}

	public function lodging() {
		return $this->ancestor(LodgingModel::class, 'lodging_id');
	}
}