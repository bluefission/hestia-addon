<?php
namespace AddOns\Hestia\Domain\Queries;

use BlueFission\Connections\Database\MysqlLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Hestia\Domain\Models\LodgingReportModel;
use AddOns\Hestia\Domain\Models\ProfileModel;
use BlueFission\Services\Authenticator;

class AllLodgingReportsByUserQuerySql implements IAllLodgingReportsByUserQuery extends GenericQuerySql
{
    private $_user;

    public function __construct(MysqlLink $link, Authenticator $auth)
    {
        $model = new LodgingReportModel();
        $this->_user = $auth->getUser();
        parent::__construct($link, $model);
    }

    public function fetch() 
    {
        $profile = new ProfileModel();
        $profile->user_id = $this->_user->id;
        $reports = $profile->read()
            ->lodgings()
            ->flatMap(function($lodging) {
                return $lodging->reports()->toArray();
            })->toArray();

        $data = $reports;
    }
}