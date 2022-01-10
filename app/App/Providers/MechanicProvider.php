<?php
namespace Moorexa\Framework\App\Providers;

use Closure;
use Queries\{General};
use Moorexa\Framework\App\Models\{Mechanic};
use Lightroom\Packager\Moorexa\Interfaces\ViewProviderInterface;
/**
 * @package Mechanic View Page Provider
 * @author Moorexa <moorexa.com>
 */

class MechanicProvider implements ViewProviderInterface
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
     * @method MechanicProvider edit
     * @param string $id
     */
    public function edit($id = '', Mechanic $model)
    {
        // filter id
        $filter = filter(['id' => $id], [
            'id' => 'required|number|notag|min:1'
        ]);

        // not good ?
        if (!$filter->isOk()) return $this->view->redirect('mechanics');

        // fetch single quote
        $data = General::getMechanicByID($filter->id);

        // data does not have date
        if (!is_string($data->name)) return $this->view->redirect('mechanics');

        // render view
        $this->view->render('edit-mechanic', ['data' => $data]);
    }
}