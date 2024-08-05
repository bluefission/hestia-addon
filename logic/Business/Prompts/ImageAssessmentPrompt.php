<?php
namespace AddOns\Hestia\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class ImageAssessmentPrompt extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "Provide a detailed, professional assessment as a home inspector or general contractor would describing issues or concerns with the attached image: ";
}