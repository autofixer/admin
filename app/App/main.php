<?php
namespace Moorexa\Framework;

use Lightroom\Packager\Moorexa\MVC\Controller;
use function Lightroom\Requests\Functions\{session};
use Moorexa\Framework\App\Models\{Authentication, Services, Mechanic};
use Moorexa\Framework\App\Providers\{
    QuotesProvider, 
    ServicesProvider, 
    MechanicProvider,
    UserProvider
};
use function Lightroom\Templates\Functions\{render, redirect, json, view};
/**
 * Documentation for App Page can be found in App/readme.txt
 *
 *@package      App Page
 *@author       Moorexa <www.moorexa.com>
 *@author       Amadi Ifeanyi <amadiify.com>
 **/

class App extends Controller
{
    /**
    * @method App home
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

    public function home() : void 
    {
        $this->view->render('home');
    }

    /**
    * @method App login
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function login(Authentication $model) : void
    {
        // add js
        view()->requireJs(HOME . '/assets/app/pages/login.js');

        // render view
        $this->view->render('login');
    }

    /**
    * @method App forgotPassword
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function forgotPassword() : void
    {
        $this->view->render('forgotpassword');
    }

    /**
    * @method App logout
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function logout() : void
    {
        session()->drop('auth.user');

        // redirect
        alert('logout-successful', [
            'route' => 'login'
        ]);
    }

    /**
    * @method App subscribers
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function subscribers() : void
    {
        $this->view->render('subscribers');
    }

    /**
    * @method App messages
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function messages() : void
    {
        $this->view->render('messages');
    }

    /**
    * @method App quotes
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function quotes(QuotesProvider $provider) : void
    {
        $this->view->render('quotes');
    }

    /**
    * @method App services
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function services(ServicesProvider $provider) : void
    {
        $this->view->render('services');
    }

    /**
    * @method App mechanics
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function mechanics($view, MechanicProvider $provider, Mechanic $model) : void
    {
        // render add
        if ($view == 'add') $this->view->render('add-mechanic');

        // render default view
        $this->view->render('mechanics');
    }

    /**
    * @method App users
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
    public function users(UserProvider $provider) : void
    {
        $this->view->render('users');
    }
}
// END class