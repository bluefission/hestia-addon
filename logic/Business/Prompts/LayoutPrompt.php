<?php
namespace AddOns\Hestia\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class LayoutPrompt extends Prompt
{
	protected $_fields = ['input', 'templates'];
	protected $_template = "Slides:
{input}

Layouts:
{templates}

Given the outline and the layout descriptions, which number layout is the best layout to use for slide number {number}? 
Layout number: ";
}