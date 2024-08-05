<?php
namespace AddOns\Hestia;

use AddOns\Hestia\Registration\HestiaRegistration;
use BlueFission\Utils\Loader;
use BlueFission\Services\Service;
use BlueFission\BlueCore\Theme;

class HestiaAddOn extends Service {
	private $_loader;

	public function __construct() {
		$this->_loader = Loader::instance();
		listen('OnAppLoaded', [$this, 'bootstrap']);
		parent::__construct();
	}

	public function bootstrap()
	{
		$registration = new HestiaRegistration;
		$registration->init();
		
		$this->autoDiscoverMapping();
	}

	private function autoDiscoverMapping() {
		$this->_loader->load("addons.hestia.mapping.*");
	}
}