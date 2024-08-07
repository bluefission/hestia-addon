<?php
namespace AddOns\Hestia\Domain\Queries;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Hestia\Domain\Models\LodgingModel;

class AllLodgingsQuerySql extends GenericQuerySql
{
    public function __construct(MySQLLink $link)
    {
        $model = new LodgingModel();
        parent::__construct($link, $model);
    }
}