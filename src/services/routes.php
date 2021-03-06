<?php

use Lightroom\Packager\Moorexa\Router as Route;
use function Lightroom\Requests\Functions\{session};
/*
 ***************************
 * 
 * @ Route
 * info: Add your GET, POST, DELETE, PUT request handlers here. 
*/
Route::any('*', function($route){
    return Moorexa\Middlewares\Authentication::isAuthenticated($route);
}); 