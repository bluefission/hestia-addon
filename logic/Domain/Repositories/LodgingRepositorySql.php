<?php
namespace AddOns\Hetia\Domain\Repositories;

use BlueFission\Connections\Database\MysqlLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;
use AddOns\Hestia\Domain\Models\LodgingModel as Model;
use AddOns\Hestia\Domain\Lodging;

class LodgingRepositorySql implements ILodgingRepository extends GenericRepositorySql
{
    public function __construct(MysqlLink $link)
    {
        $model = new LodgingModel();
        parent::__construct($link, $model, "lodgings");
    }
}