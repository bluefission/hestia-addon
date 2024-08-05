<?php
namespace AddOns\Students\Business\Http;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\BlueCore\Auth as Authenticator;

use BlueFission\Data\Storage\Storage;

class DashboardController extends Service {

	public function index( Storage $datasource ) 
    {
        $auth = new Authenticator( $datasource );

        if ( $auth->isAuthenticated() ) {
            // globals('sideNav', $navMenuManager->renderMenu('sideNav'));
            $navMenuManager = instance('nav');
            $sideNav = $navMenuManager->renderMenu('sidebar');
            return template('students/ezdatta', 'default.html', ['csrf_token'=>store('_token'), 'side-nav'=>$sideNav, 'title'=>env('APP_NAME')." Admin"]);
        } else {
            return template('students/ezdatta', 'login.html', ['csrf_token'=>store('_token')]);
        }
    }

    public function dashboard( ) 
    {
        return template('students/ezdatta', 'panels/dashboard.html');
    }

    public function users( ) 
    {
        return template('students/ezdatta', 'panels/users.html', ['realname'=>'System Admin']);
    }

    public function addons( ) 
    {
        return template('students/ezdatta', 'panels/addons.html');
    }

    public function content( ) 
    {
        return template('students/ezdatta', 'panels/content.html');
    }

    public function terminal( ) 
    {
        return template('students/ezdatta', 'panels/terminal.html');
    }

    public function registration( ) 
    {
        return template('students/ezdatta', 'register.html');
    }

    public function forgotpassword( ) 
    {
        return template('students/ezdatta', 'forgotpassword.html');
    }
}