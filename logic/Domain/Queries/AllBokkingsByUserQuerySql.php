<?php
namespace AddOns\Hestia\Domain\Queries;

use BlueFission\Connections\Database\MysqlLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Hestia\Domain\Models\BookingModel;
use AddOns\Hestia\Domain\Models\ProfileModel;
use BlueFission\Services\Authenticator;

class AllBookingsByUserQuerySql implements IAllBookingsByUserQuery extends GenericQuerySql
{
    private $_user;

    public function __construct(MysqlLink $link, Authenticator $auth)
    {
        $model = new BookingModel();
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
                return $lodging->bookings()->toArray();
            })->toArray();

        $data = $reports;
    }
}