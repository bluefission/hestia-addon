<?php
namespace AddOns\Hestia\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class SlidePrompt extends Prompt
{
	protected $_fields = ['input', 'template', 'number'];
	protected $_template = "{input}
Using the following HTML layout, create the content of slide number {number} in the above presentation.

{template}";
}