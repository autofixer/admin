<?php
namespace Moorexa\Middlewares;

use Closure;
use function Lightroom\Requests\Functions\{session};
use Lightroom\Router\Interfaces\MiddlewareInterface;
/**
 * @package Authentication Middleware
 * @author  Moorexa inc.
 */

class Authentication implements MiddlewareInterface
{
    /**
     * @method Authentication request 
     * @param Closure $render
     * @return void
     * 
     * This method holds the waiting request, call render to move request to the top of the call stack.
     **/
    function request(Closure $render) : void
    {
        
    }

    /**
     * @method Authentication requestClosed
     * @return void
     * 
     * This method would be called when request has been closed.
     **/
    function requestClosed() : void
    {
        // what would you like to do here?
    }

    // #cool stuffs down here
    public static function isAuthenticated(array $route)
    {
        // go to
        $goto = 'app/login';

        // add app
        array_unshift($route, 'app');

        // cache last page
        session()->set('lastpage', $route);

        // check session storage
        if (session()->has('auth.user')) $goto = implode('/', $route);

        // return string
        return $goto;
    }
}