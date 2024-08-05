<?php
namespace App\Business\Services;

use BlueFission\Services\Service;
use BlueFission\Str;
use AddOns\Hestia\Business\Prompts\ImageAssessmentPrompt as Prompt;

class ImageBasedAssessmentService extends Service {

	private $_llmClient;

	public function __construct( $llmClient ) {
		$this->_llmClient = $llmClient;

		parent::__construct();
	}

	public function assess($imageData): string
	{
		// if not encoded data, load path and convert
		if (Str::pos($imageData, 'data:image') === false) {
			$imageData = base64_encode(file_get_contents($imageData));
		}

		$prompt new Prompt('');

		$result = $this->_llmClient->vision($prompt->prompt(), $imageData);
		return $result;
	}
}