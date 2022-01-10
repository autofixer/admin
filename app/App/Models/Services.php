<?php
namespace Moorexa\Framework\App\Models;

use Closure;
use HttpClient\Http;
use Queries\{General, Model as QueryModel};
use Lightroom\Packager\Moorexa\{
    MVC\Model, Interfaces\ModelInterface
};
/**
 * Services model class auto generated.
 *
 *@package App Services Model
 *@author Amadi Ifeanyi <amadiify.com>
 **/

class Services extends Model
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
     * @method Model assignService
     * @return void
     */
    public function assignService() : void
    {
        $post = filter('POST', [
            'serviceid'     => 'required|number|notag|min:1',
            'mechanicid'    => 'required|number|notag|min:1',
            'service_fee'   => 'required|number|notag|min:1'
        ]);

        // are we good ?
        if ($post->isOk()) :

            // load model
            $model = QueryModel::loadModel('services');
            $model->serviceid = $post->serviceid;
            $model->mechanic = General::getMechanicByID(intval($post->mechanicid));
            $model->serviceFee = $post->service_fee;
            $model->status = General::getStatusByID(4);
            $model->dateAssigned = time();

            // update service
            if (General::UpdateService($model)) alert('service-assigned');

            // load data
            $model = QueryModel::loadModel('services');
            $model->serviceid = $post->serviceid;

            // load service
            $service = General::getSingleServiceRequested($model);

            // send mail
            Http::body([
                'service'   => 'services',
                'method'    => 'send job alert to mechanic',
                'id'        => $post->mechanicid,
                'url'       => MAIN_SITE .'/job?utm='.base64_encode(json_encode([
                    'status'        => $service->status->getData(),
                    'mechanic'      => $service->mechanic->getData(),
                    'service'       => $service->getData(),
                    'manufacturer'  => $service->manufacturer->getData()
                ]))
            ])->post(SERVICE_API . '/api');

        endif;
    }

    /**
     * @method Model updateService
     * @return void
     */
    public function updateService() : void
    {
        $post = filter('POST', [
            'serviceid'     => 'required|number|notag|min:1',
            'mechanicid'    => 'required|number|notag|min:1',
            'service_fee'   => 'required|number|notag|min:1',
            'statusid'      => 'required|number|notag|min:1'
        ]);

        // are we good ?
        if ($post->isOk()) :

            // load data
            $model = QueryModel::loadModel('services');
            $model->serviceid = $post->serviceid;

            // load service
            $service = General::getSingleServiceRequested($model);

            // load message 
            $message = 'This service has been successfully updated';

            // did mechanic change
            if ($service->mechanic->mechanicid != $post->mechanicid) :

                // mechanic changed
                $service->dateAssigned = time();

                // update message
                $message = 'This service has been successfully assigned to another mechanic';

                // update mechanic
                $mechanic = General::getMechanicByID($post->mechanicid);

                // response
                $response = [
                    'status'        => $service->status->getData(),
                    'mechanic'      => $mechanic->getData(),
                    'service'       => $service->getData(),
                    'manufacturer'  => $service->manufacturer->getData()
                ];

                // send mail to current mechanic
                Http::body([
                    'service'   => 'services',
                    'method'    => 'send job alert to mechanic',
                    'id'        => $post->mechanicid,
                    'url'       => MAIN_SITE .'/job?utm='.base64_encode(json_encode($response))
                ])->post(SERVICE_API . '/api');

                // send alert mail to previous mechanic
                Http::body([
                    'service'   => 'services',
                    'method'    => 'send cancellation job alert to mechanic',
                    'id'        => $service->mechanic->mechanicid,
                    'url'       => MAIN_SITE .'/job?utm='.base64_encode(json_encode($response))
                ])->post(SERVICE_API . '/api');

                // update mechanic
                $service->mechanic = $mechanic;

            endif;

            // update data
            $service->serviceFee = floatval($post->service_fee);
            $service->status = General::getStatusByID($post->statusid);

            // run update
            if (General::UpdateService($service)) alert('service-updated', $message);

        endif;
    }
}