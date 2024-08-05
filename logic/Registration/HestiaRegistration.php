<?php
namespace AddOns\Hestia\Registration;

use AddOns\Hestia\Business\Managers\LodgingManager;
use BlueFission\BlueCore\IExtension;
use BlueFission\BlueCore\Theme;
use BlueFission\Utils\Loader;

class HestiaRegistration implements IExtension 
{
	private $_app;
	private $_name = "Hestia";

	public function __construct()
	{
		$this->_app = instance();
		$this->_loader = Loader::instance();
		$this->_loader->addPath(dirname(dirname(__DIR__)));
	}

	public function init()
	{
		$this->_app->addTheme(new Theme('hestia/default', 'default'));
		$this->_loader->load("mapping.*");

		$this->bindings();
		$this->arguments();
		$this->registrations();
	}

	private function registrations()
	{
		$this->_app->delegate('hestia', LodgingManager::class);
	}
	
	private function arguments()
	{
		$llmClient = $this->_app->configuration('hestia')['llmClient'];
		$this->_app->bindArgs( ['llmClient'=>$llmClient], 'App\Business\Services\ImageBasedAssessmentService');
	}

	private function bindings()
	{
		$this->_app->bind('AddOns\Hestia\Domain\Queries\IAllLodgingsQuery', 'AddOns\Hestia\Domain\Queries\AllLodgingsQuerySql');
		$this->_app->bind('AddOns\Hestia\Domain\Repositories\ILodgingRepository', 'AddOns\Hestia\Domain\Repositories\LodgingRepositorySql');
	}

	public function name()
	{
		return $this->_name;
	}

	public function install()
	{
		$this->updateDB();	
	}

	public function uninstall()
	{
		$this->revertDB();
	}

	public function updateDB()
	{

	}

	public function revertDB()
	{
		
	}
}