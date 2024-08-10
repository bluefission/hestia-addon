<?php
namespace AddOns\Hestia\Business\Http;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\BlueCore\Auth as Authenticator;
use BlueFission\Services\Application as App;

use BlueFission\Data\Storage\Storage;

class DashboardController extends Service {

	public function index() 
    {
        $auth = App::makeInstance(Authenticator::class);

        if ( $auth->isAuthenticated() ) {
            $navMenuManager = instance('nav');
            $sideNav = $navMenuManager->renderMenu('sidebar');
            return template('hestia-addon/default', 'lodging-dashboard.html', ['csrf_token'=>store('_token'), 'side-nav'=>$sideNav, 'title'=>env('APP_NAME')." Dashbaord"]);
        } else {
            return template('hestia-addon/default', 'default.html', ['csrf_token'=>store('_token')]);
        }
    }

    public function seekerSignup() 
    {
        return template('hestia-addon/default', 'seeker-signup.html');
    }

    public function ownerSignup() 
    {
        return template('hestia-addon/default', 'owner-signup.html');
    }

    public function signup() 
    {
        return template('hestia-addon/default', 'signup.html');
    }

    public function login() 
    {
        return template('hestia-addon/default', 'login.html');
    }

    public function dashboard( ) 
    {
        return template('hestia-addon/default', 'panels/dashboard.html');
    }

    public function users( ) 
    {
        return template('hestia-addon/default', 'panels/users.html', ['realname'=>'System Admin']);
    }

    public function addons( ) 
    {
        return template('hestia-addon/default', 'panels/addons.html');
    }

    public function content( ) 
    {
        return template('hestia-addon/default', 'panels/content.html');
    }

    public function terminal( ) 
    {
        return template('hestia-addon/default', 'panels/terminal.html');
    }

    public function registration( ) 
    {
        return template('hestia-addon/default', 'register.html');
    }

    public function forgotpassword( ) 
    {
        return template('hestia-addon/default', 'forgotpassword.html');
    }
}