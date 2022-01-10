<?php
namespace Moorexa\Framework\App\Providers;

use Closure;
use Queries\{General};
use Moorexa\Framework\App\Models\User;
use Lightroom\Packager\Moorexa\Interfaces\ViewProviderInterface;
/**
 * @package User View Page Provider
 * @author Moorexa <moorexa.com>
 */

class UserProvider implements ViewProviderInterface
{
    /**
     * @method ViewProviderInterface setArguments
     * @param array $arguments
     * 
     * This method sets the view arguments
     */
    public function setArguments(array $arguments) : void {}

    /**
     * @method ViewProviderInterface viewWillEnter
     * @param Closure $next
     * 
     * This method would be called before rendering view
     */
    public function viewWillEnter(Closure $next) : void
    {
        // route passed
        $next();
    }

    /**
     * @method UserProvider edit 
     * @param string $id
     */
    public function edit($id, User $Model)
    {
        // filter id
        $filter = filter(['id' => $id], [
            'id' => 'required|number|notag|min:1'
        ]);

        // not good ?
        if (!$filter->isOk()) return $this->view->redirect('users');

        // fetch single quote
        $data = General::getUserByID($filter->id);

        // data does not have date
        if (!is_string($data->username)) return $this->view->redirect('users');

        // render view
        $this->view->render('edit-user', ['data' => $data]);
    }

    /**
     * @method UserProvider add 
     * @return void
     */
    public function add(User $Model)
    {
        // render view
        $this->view->render('add-user');
    }
}