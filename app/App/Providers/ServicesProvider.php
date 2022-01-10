<?php
namespace Moorexa\Framework\App\Providers;

use Closure;
use Queries\{General, Model};
use Moorexa\Framework\App\Models\{Authentication, Services};
use Lightroom\Packager\Moorexa\Interfaces\ViewProviderInterface;
/**
 * @package Services View Page Provider
 * @author Moorexa <moorexa.com>
 */

class ServicesProvider implements ViewProviderInterface
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
     * @method ServicesProvider diagnosis
     * @return void
     */
    public function diagnosis()
    {
        # code...
        $this->view->render('services/diagnosis');
    }

    /**
     * @method ServicesProvider repair
     * @return void
     */
    public function repair()
    {
        # code...
        $this->view->render('services/repair');
    }

    /**
     * @method ServicesProvider maintenance
     * @return void
     */
    public function maintenance()
    {
        # code...
        $this->view->render('services/maintenance');
    }

    /**
     * @method ServicesProvider view
     * @return void
     */
    public function view($id = '', Services $Model)
    {
        // filter id
        $filter = filter(['id' => $id], [
            'id' => 'required|number|notag|min:1'
        ]);

        // not good ?
        if (!$filter->isOk()) return $this->view->redirect('services');

        // load model
        $model = Model::loadModel('services');
        $model->serviceid = $filter->id;

        // fetch single quote
        $service = General::getSingleServiceRequested($model);

        // data does not have date
        if (!is_string($service->date)) return $this->view->redirect('services');

        # code...
        $this->view->render('services/view', ['data' => $service]);
    }
}