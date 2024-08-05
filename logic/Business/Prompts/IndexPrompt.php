<?php
namespace AddOns\Hesita\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class IndexPrompt extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "{input}
Create an outline for a keynote slide show of 6 to 10 slides that presents the premise above in an organized and compelling way. 
1. ";
}