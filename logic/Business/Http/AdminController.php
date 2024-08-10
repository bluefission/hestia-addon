<?php
namespace AddOns\Hestia\Business\Http;

use BlueFission\Services\Service;
use BlueFission\Services\Request;

class AdminController extends Service {

    public function main( ) 
    {
        return template('hestia-addon/default', 'admin/panels/index.html');
    }
}