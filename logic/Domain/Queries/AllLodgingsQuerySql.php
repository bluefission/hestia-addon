<?php
namespace AddOns\Hestia\Domain\Queries;

use BlueFission\Connections\Database\MysqlLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Hestia\Domain\Models\LodgingModel;

class AllLodgingsQuerySql extends GenericQuerySql
{
    public function __construct(MysqlLink $link)
    {
        $model = new LodgingModel();
        parent::__construct($link, $model);
    }
}