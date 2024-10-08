a<?php
namespace AddOns\Hetia\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;
use AddOns\Hestia\Domain\Models\ImageModel as Model;
use AddOns\Hestia\Domain\Image;

class ImageRepositorySql implements IImageRepository extends GenericRepositorySql
{
    public function __construct(MySQLLink $link)
    {
        $model = new ImageModel();
        parent::__construct($link, $model, "images");
    }
}