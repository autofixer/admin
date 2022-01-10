<?php
namespace Moorexa\Framework\App\Models;

use Closure;
use Queries\{General, Model as QueryModel};
use Lightroom\Packager\Moorexa\{
    MVC\Model, Interfaces\ModelInterface
};
use function Lightroom\Database\Functions\{db};
use function Lightroom\Requests\Functions\{post};
use function Lightroom\Security\Functions\{hash_password, md5s};
/**
 * User model class auto generated.
 *
 *@package App User Model
 *@author Amadi Ifeanyi <amadiify.com>
 **/

class User extends Model
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

    public function addUser()
    {
        // run filter
        $filter = filter('post', [
            'name'              => 'required|string|notag|min:2',
            'email'             => 'required|email|min:7',
            'allow_edit'        => 'required|number|min:1',
            'password'          => 'required|min:4',
            'password_again'    => 'required|min:4',
        ]);

        // failed
        if (!$filter->isOk()) return alert('failed-to-add', 'All fields are required');

        // compare password
        if ($filter->password != $filter->password_again) return alert('failed-to-add', 'Password provided do not match!');

        // update name
        $filter->name = strtolower($filter->name);

        // checks
        $checks = (object) [
            'name'  => db(General::ADMIN_USERS)->get('adminid')->where('username = ?', $filter->name)->go()->rowCount(),
            'email' => db(General::ADMIN_USERS)->get('adminid')->where('email = ?', $filter->email)->go()->rowCount(),
        ];

        // check email
        if ($checks->email != 0) return alert('failed-to-add', 'The email address used already exists!');

        // check name
        if ($checks->name != 0) return alert('failed-to-add', 'The name "'.$filter->name.'" already exists for another user!');

        // create user
        $model = QueryModel::loadModel('adduser');
        $model->username = $filter->name;
        $model->email = $filter->email;
        $model->password_salt = md5s(time() . $model->username);
        $model->password = hash_password($filter->password, $model->password_salt);
        $model->allow_global_edit = intval($filter->allow_edit);

        if (General::createUser($model)) :

            // clean post
            post()->clear();

            // all good
            alert('user-added', 'User "'.$filter->name.'" added successfully!');
            
        endif;
    }

    /**
     * @method User updateUser
     * @param int $id
     * @return mixed
     */
    public function updateUser($id)
    {
        // run filter
        $filter = filter('post', [
            'name'          => 'required|string|notag|min:2',
            'email'         => 'required|email|min:7',
            'allow_edit'    => 'required|number|min:1'
        ]);

        // failed
        if (!$filter->isOk()) return alert('failed-to-update', 'All fields are required');

        // load data
        $user = General::getUserByID($id);

        // no permission
        if ($user->allowGlobalEdit == 0) return alert('failed-to-update', 'You don\'t have enough right to edit "'.$user->username.'" information!');

        // update name
        $filter->name = strtolower($filter->name);

        // checks
        $checks = (object) [
            'name'  => db(General::ADMIN_USERS)->get('adminid')->where('username = ?', $filter->name)->go()->rowCount(),
            'email' => db(General::ADMIN_USERS)->get('adminid')->where('email = ?', $filter->email)->go()->rowCount(),
        ];

        // check email
        if ($user->email != $filter->email) if ($checks->email != 0) return alert('failed-to-update', 'The email address used already exists!');

        // check name
        if ($user->username != $filter->name) if ($checks->name != 0) return alert('failed-to-update', 'The name "'.$filter->name.'" already exists for another user!');

        // update record
        if (db(General::ADMIN_USERS)->update([
            'username'          => $filter->name,
            'email'             => $filter->email,
            'allow_global_edit' => intval($filter->allow_edit)
        ])->where('adminid = ?', $id)->go()) return alert('user-updated', 'You have successfully updated "'.$filter->name.'" information');
        

    }

    /**
     * @method User updatePassword
     * @param int $id
     * @return mixed
     */
    public function updatePassword($id)
    {
        // run filter
        $filter = filter('post', [
            'password'          => 'required|min:4',
            'password_again'    => 'required|min:4',
        ]);

        // failed
        if (!$filter->isOk()) return alert('failed-to-update', 'All fields are required');

        // compare password
        if ($filter->password != $filter->password_again) return alert('failed-to-update', 'Password provided do not match!');

        // load info
        $user = General::getUserByID($id);

        // no permission
        if ($user->allowGlobalEdit == 0) return alert('failed-to-update', 'You don\'t have enough right to edit "'.$user->username.'" password!');

        $user->password_salt = md5s(time() . $user->username);
        $user->password = hash_password($filter->password, $user->password_salt);

        // update record
        if (db(General::ADMIN_USERS)->update([
            'password'          => $user->password,
            'password_salt'     => $user->password_salt,
        ])->where('adminid = ?', $id)->go()) return alert('user-updated', 'You have successfully updated "'.$user->username.'" password');
        

    }
}