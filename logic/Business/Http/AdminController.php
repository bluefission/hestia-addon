<?php
namespace AddOns\Students\Business\Http;

use BlueFission\Services\Service;
use BlueFission\Services\Request;

class AdminController extends Service {

    public function main( ) 
    {
        return template('bluefission/hestia', 'panels/index.html');
    }
}