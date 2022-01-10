<?php
namespace Moorexa\Framework\App\Models;

use Closure;
use Lightroom\Packager\Moorexa\{
    MVC\Model, Interfaces\ModelInterface
};
use Queries\{General, Model as QueryModel};
use function Lightroom\Database\Functions\{db};
use function Lightroom\Requests\Functions\{post};
/**
 * Mechanic model class auto generated.
 *
 *@package App Mechanic Model
 *@author Amadi Ifeanyi <amadiify.com>
 **/

class Mechanic extends Model
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
     * @method Mechanic addMechanic
     * @return mixed
     */
    public function addMechanic()
    {
        // validate input
        $filter = filter('post', [
            'name'      => 'required|notag|string|min:3',
            'email'     => 'required|email|min:7',
            'phone'     => 'required|number|min:5',
            'stateid'   => 'required|number|min:1',
        ]);

        // failed
        if (!$filter->isOk()) return alert('failed-to-add', 'All fields are required');

        // update name
        $filter->name = ucwords($filter->name);

        // checks
        $checks = (object) [
            'name'  => db(General::MECHANIC)->get('mechanicid')->where('mechanic_name = ? and stateid = ?', $filter->name, $filter->stateid)->go()->rowCount(),
            'email' => db(General::MECHANIC)->get('mechanicid')->where('mechanic_email = ?', $filter->email)->go()->rowCount(),
            'phone' => db(General::MECHANIC)->get('mechanicid')->where('mechanic_phone = ?', $filter->phone)->go()->rowCount(),
        ];

        // check email
        if ($checks->email != 0) return alert('failed-to-add', 'The email address used already exists!');

        // check phone
        if ($checks->phone != 0) return alert('failed-to-add', 'The phone number used already exists!');

        // check name
        if ($checks->name != 0) return alert('failed-to-add', 'The name "'.$filter->name.'" already exists for a mechanic in the same state!');

        // ok we are good to go
        $model = QueryModel::loadModel('mechanic');
        $model->name = $filter->name;
        $model->email = $filter->email;
        $model->phone = $filter->phone;
        $model->state = $filter->stateid;

        // create record
        if (General::createMechanic($model)) :

            // clear post
            post()->clear();

            // alert
            alert('mechanic-added', 'You have successfully added "'.$filter->name.'"');

        endif;
    }

    /**
     * @method Mechanic updateMechanic
     * @return mixed
     */
    public function updateMechanic($id)
    {
        // validate input
        $filter = filter('post', [
            'name'      => 'required|notag|string|min:3',
            'email'     => 'required|email|min:7',
            'phone'     => 'required|number|min:5',
            'stateid'   => 'required|number|min:1',
        ]);

        // failed
        if (!$filter->isOk()) return alert('failed-to-update', 'All fields are required');

        // load data
        $mechanic = General::getMechanicByID($id);

        // update name
        $filter->name = ucwords($filter->name);

        // checks
        $checks = (object) [
            'name'  => db(General::MECHANIC)->get('mechanicid')->where('mechanic_name = ? and stateid = ?', $filter->name, $filter->stateid)->go()->rowCount(),
            'email' => db(General::MECHANIC)->get('mechanicid')->where('mechanic_email = ?', $filter->email)->go()->rowCount(),
            'phone' => db(General::MECHANIC)->get('mechanicid')->where('mechanic_phone = ?', $filter->phone)->go()->rowCount(),
        ];

        // check email
        if ($mechanic->email != $filter->email) if ($checks->email != 0) return alert('failed-to-update', 'The email address used already exists!');

        // check phone
        if ($mechanic->phone != $filter->phone) if ($checks->phone != 0) return alert('failed-to-update', 'The phone number used already exists!');

        // check name
        if ($mechanic->name != $filter->name) if ($checks->name != 0) return alert('failed-to-update', 'The name "'.$filter->name.'" already exists for a mechanic in the same state!');

        // ok we are good to go
        $model = QueryModel::loadModel('mechanic');
        $model->name = $filter->name;
        $model->email = $filter->email;
        $model->phone = $filter->phone;
        $model->state = $filter->stateid;

        // create record
        if (General::UpdateMechanic($model)) alert('mechanic-updated', 'You have successfully updated "'.$filter->name.'" record');
    }
}