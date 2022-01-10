<?php
namespace Queries;

use function Lightroom\Database\Functions\{db};
/**
 * @package UnpackData
 * @author Amadi Ifeanyi <amadiify.com>
 */
trait UnpackData
{
    /**
     * @method UnpackData unpackContactMessage
     * @param object $row
     * @return Data
     */
    public static function unpackContactMessage(object $row) : Data
    {
        // load contact model
        $model = Model::loadModel('contact');

        // unpack data
        $model->email = $row->customer_email;
        $model->contactid = $row->contactid;
        $model->date = $row->date_created;
        $model->name = $row->customer_name;
        $model->phone = $row->customer_phone;
        $model->message = $row->customer_message;

        // return model
        return $model;
    }

    /**
     * @method UnpackData unpackServiceQuotes
     * @param object $row
     * @return Data
     */
    public static function unpackServiceQuotes(object $row) : Data
    {
        // load quote model
        $model = Model::loadModel('quotes');

        // unpack data
        $model->email = $row->customer_email;
        $model->quoteid = $row->quoteid;
        $model->date = $row->date_created;
        $model->name = $row->customer_name;
        $model->phone = $row->customer_phone;
        $model->issue = $row->car_issue;
        $model->location = $row->customer_location;
        $model->serviceType = $row->service_type;
        $model->carModel = $row->car_model;
        $model->carYear = $row->car_year;
        $model->numberOfCars = $row->number_of_cars;
        $model->mileage = $row->mileage;
        $model->manufacturer = self::getManufacturerByID($row->manufacturerid);

        // return model
        return $model;
    }

    /**
     * @method UnpackData unpackServiceRequested
     * @param object $row
     * @return Data
     */
    public static function unpackServiceRequested(object $row) : Data 
    {
        // load service model
        $model = Model::loadModel('services');

        // unpack data
        $model->serviceid = $row->serviceid;
        $model->name = $row->customer_name;
        $model->email = $row->customer_email;
        $model->phone = $row->customer_phone;
        $model->location = $row->customer_location;
        $model->address = $row->customer_address;
        $model->serviceType = $row->service_type;
        $model->manufacturer = self::getManufacturerByID($row->manufacturerid);
        $model->carYear = $row->car_year;
        $model->date = $row->date_submitted;
        $model->needingMechanic = $row->needing_on_site_mechanic;
        $model->dateToVisit = $row->date_mechanic_should_visit;
        $model->timeToVisit = $row->time_mechanic_should_visit;
        $model->comment = $row->customer_comment;
        $model->status = self::getStatusByID($row->statusid);
        $model->subscribeToAplan = $row->subscribe_to_a_plan;
        $model->mechanic = self::getMechanicByID($row->mechanicid);
        $model->serviceFee = floatval($row->service_fee);
        $model->dateAssigned = $row->date_assigned;
        

        // return model
        return $model;
    }

    /**
     * @method UnpackData unpackState
     * @param object $row
     * @return Data
     */
    public static function unpackState(object $row) : Data 
    {
        // load model
        $model = Model::loadModel('state');

        // unpack data
        $model->name = $row->state_name;
        $model->stateid = $row->stateid;

        // return model
        return $model;
    }

    /**
     * @method UnpackData unpackStatus
     * @param object $row
     * @return Data
     */
    public static function unpackStatus(object $row) : Data 
    {
        // load model
        $model = Model::loadModel('status');

        // unpack data
        $model->name = $row->status_name;
        $model->statusid = $row->statusid;

        // return model
        return $model;
    }

    /**
     * @method UnpackData unpackMechanic
     * @param object $row
     * @return Data
     */
    public static function unpackMechanic(object $row) : Data 
    {
        // load model
        $model = Model::loadModel('mechanic');

        // unpack data
        $model->mechanicid = $row->mechanicid;
        $model->name = $row->mechanic_name;
        $model->email = $row->mechanic_email;
        $model->phone = $row->mechanic_phone;
        $model->state = self::getStateByID($row->stateid);
        $model->pending = db(static::SERVICES)->get('serviceid')->where('mechanicid = ? and statusid = ?', $row->mechanicid, 1)->go()->rowCount();
        $model->completed = db(static::SERVICES)->get('serviceid')->where('mechanicid = ? and statusid = ?', $row->mechanicid, 2)->go()->rowCount();
        $model->ongoing = db(static::SERVICES)->get('serviceid')->where('mechanicid = ? and statusid = ?', $row->mechanicid, 4)->go()->rowCount();

        // return model
        return $model;
    }

    /**
     * @method UnpackData unpackUser
     * @param object $row
     * @return Data
     */
    public static function unpackUser(object $row) : Data 
    {
        // load data
        $data = Model::loadModel('user');

        // unpack
        $data->username = $row->username;
        $data->adminid = $row->adminid;
        $data->email = $row->email;
        $data->date = $row->date_created;
        $data->password = $row->password;
        $data->allowGlobalEdit = intval($row->allow_global_edit);

        // return model
        return $data;
    }

    /**
     * @method UnpackData unpackServiceReport
     * @param object $row
     * @return Data
     */
    public static function unpackServiceReport(object $row) : Data 
    {
        // load data
        $data = Model::loadModel('serviceReport');

        // unpack
        $data->reportid = $row->reportid;
        $data->mechanic = self::getMechanicByID($row->mechanicid);
        $data->date = $row->date_created;
        $data->report = $row->report;

        // return data
        return $data;
    }
}