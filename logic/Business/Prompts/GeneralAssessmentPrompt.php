<?php
namespace AddOns\Hestia\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class GeneralAssessmentPrompt extends Prompt
{
	protected $_fields = [
		'type',
		'year_built',
		'renovated_year',
		'condition',
		'city',
		'state',
		'country',
		'zip',
		'description',
		'visual_assessment',
		'property_notes',
		'party_notes',
		'month',
	];
	protected $_template = "
	Type: {type}
	Year Built: {year_built}
	Year Renovated: {renovated_year}
	Reported Condition: {condition}
	Location: {city}, {state} {country} {zip}
	Responsible Party Description: {description}
	Visual Assessment: {visual_assessment}
	Internal Notes Regarding Property: {property_notes}
	Internal Notes Regarding Responsible Party: {party_notes}
	Current Month: {month}

	For the lodging described above, provide a detailed, professional assessment as a home inspector or general contractor would describing issues or concerns with the location (do not divulge any internal information in this assessment): ";
}