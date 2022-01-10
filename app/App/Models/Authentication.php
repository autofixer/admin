<?php
namespace Moorexa\Framework\App\Models;

use Closure;
use Queries\{Model as QueryModel, General};
use Lightroom\Packager\Moorexa\{
    MVC\Model, Interfaces\ModelInterface
};
use function Lightroom\Requests\Functions\{session};
use function Lightroom\Security\Functions\{hash_password, verify_password, md5s};
/**
 * Authentication model class auto generated.
 *
 *@package App Authentication Model
 *@author Amadi Ifeanyi <amadiify.com>
 **/

class Authentication extends Model
{
    /**
     * @method ModelInterface onModelInit
     * @param ModelInterface $model
     * @param Closure $next
     * @return void
     */
    public function onModelInit(ModelInterface $model, Closure $next) : void 
    {
        // call closure
        $next();
    }

    /**
     * @method Authentication postLogin
     * @return void
     */
    public function postLogin()
    {
        // add filter
        $filter = filter('post', [
            'email'     => 'required|email|min:6',
            'password'  => 'required|min:4'
        ]);

        // are we good?
        if ($filter->isOk()) :

            // load model
            $model = QueryModel::loadModel('user');
            $model->email = $filter->email;

            // find user by email
            $user = General::getUserByEmail($model);

            // user not found
            if ($user->adminid == 0) return alert('invalid-username');

            // check password
            if (!verify_password($filter->password, $user->password, $user->passwordSalt)) return alert('incorrect-password');

            // set session
            session()->set('auth.user', $user);

            // get last page
            $lastPage = implode('/',  session()->get('lastpage'));

            // redirect now
            if ($lastPage != 'login' && $lastPage != 'app/login') func()->redirect($lastPage);

            // goto dashboard
            func()->redirect('home');

        endif;
    }
}