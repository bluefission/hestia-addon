<?php
namespace AddOns\Hestia\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class PremisePrompt extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "{input}
Draft a premise for a keynote slide show presenting compelling information for the topic above: ";
}