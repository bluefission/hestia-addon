<?php
namespace App\Business\Services;

use BlueFission\Services\Service;
use BlueFission\Date;
use AddOns\Hestia\Business\Lodging;
use AddOns\Hestia\Business\LodgingReport;
use AddOns\Hestia\Domain\Repositories\ILodgingRepository;
use AddOns\Hestia\Domain\Repositories\ILodgingReportRepository;
use AddOns\Hestia\Business\Prompts\GeneralAssessmentPrompt as Prompt;

class AIAssessmentService extends Service {

	const ASSESSMENT_STALE_DAYS = 30;
	
	private $_llmClient;
	private $_imageAssessmentService;
	private $_repo;
	private $_reportRepo;

	public function __construct( ILodgingRepository $repo, ILodgingReportRepository $reportRepo, $imageAssessmentService, $llmClient ) {
		$this->_repo = $repo;
		$this->_reportRepo = $reportRepo;
		$this->_imageAssessmentService = $imageAssessmentService;
		$this->_llmClient = $llmClient;

		parent::__construct();
	}

	public function assess(Lodging $lodging) {
		$model = $this->_repo->find($lodging->id);

		if ( !$model || !$model->id ) {
			return;
		}

		$images = $model->images();

		$imageAssessments = [];
		foreach ($images as $image) {
			if ( $image->assessment != '' || Date::diff($image->update_at, time(), 'days') < self::ASSESSMENT_STALE_DAYS ) {
				continue;
			}

			$result = $this->_imageAssessmentService->assess($image->data);
			$imageAssessments[] = $image;
			$image->assessment = $result;
			$image->save();
		}

		$imageAssessment = implode("\n", $imageAssessments);

		$prompt = new Prompt(
			$model->type->value,
			$model->built_year,
			$model->renovated_year,
			$model->condition->value,
			$model->address->city,
			$model->address->state,
			$model->address->country,
			$model->address->zip,
			$model->description,
			$imageAssessment,
			$model->notes,
			$model->contacts->first()->description,
			Date::format('F')
		);

		$result = $this->_llmClient->generate($prompt, [

		]);

		$report = new LodgingReport();
		$report->lodging_id = $lodging->id;
		$report->report = $result;

		$this->_reportRepo->write($report);
	}
}