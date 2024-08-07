a<?php
namespace AddOns\Hetia\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;
use AddOns\Hestia\Domain\Models\ServiceProviderModel as Model;
use AddOns\Hestia\Domain\ServiceProvider;

class ServiceProviderRepositorySql implements IServiceProviderRepository extends GenericRepositorySql
{
    public function __construct(MySQLLink $link)
    {
        $model = new ServiceProviderModel();
        parent::__construct($link, $model, "images");
    }

    public function search( $criteria )
    {
        $this->_model->condition('name', 'LIKE', '%'.$criteria.'%');
        $this->_model->condition('description', 'LIKE', '%'.$criteria.'%');
        $results = $this->_model->read();

        return $results;
    }
}