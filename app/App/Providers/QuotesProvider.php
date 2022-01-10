<?php
namespace Moorexa\Framework\App\Providers;

use Closure;
use Queries\{General, Model};
use Lightroom\Packager\Moorexa\Interfaces\ViewProviderInterface;
/**
 * @package Quotes View Page Provider
 * @author Moorexa <moorexa.com>
 */

class QuotesProvider implements ViewProviderInterface
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
     * @method QuotesProvider view
     * @param string $id
     */
    public function view($id = '')
    {
        // filter id
        $filter = filter(['id' => $id], [
            'id' => 'required|number|notag|min:1'
        ]);

        // not good ?
        if (!$filter->isOk()) return $this->view->redirect('quotes');

        // load model
        $model = Model::loadModel('quotes');
        $model->quoteid = $filter->id;

        // fetch single quote
        $quote = General::getSingleQuote($model);

        // data does not have date
        if (!is_string($quote->date)) return $this->view->redirect('quotes');

        // render view
        $this->view->render('view-quote', ['data' => $quote]);
    }
}