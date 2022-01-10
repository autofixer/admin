<?php
namespace Queries;

use Lightroom\Database\DatabaseHandler;
use function Lightroom\Database\Functions\{db};
/**
 * @package General
 * @author Amadi Ifeanyi <amadiify.com>
 */
class General
{
    use UnpackData;

    const ADMIN_USERS = 'admin_users';
    const CONTACT_MESSAGES = 'contact_messages';
    const SUBSCRIBERS = 'newsletter_subscribers';
    const QUOTES = 'service_quotes';
    const SERVICES = 'service_requests';
    const STATE = 'country_states';
    const MECHANIC = 'mechanics';
    const MECHANIC_REPORT = 'mechanic_report';

    /**
     * @method General getUserByEmail
     * @param Data $data
     * @return mixed
     */
    public static function getUserByEmail(Data $data)
    {
        $query = db(static::ADMIN_USERS)->get('email = ?', $data->email)->go();
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            $row = $query->fetch(FETCH_OBJ);

            // add data
            $data->adminid = $row->adminid;
            $data->username = $row->username;
            $data->password = $row->password;
            $data->passwordSalt = $row->password_salt;
            $data->allowGlobalEdit = intval($row->allow_global_edit);

        endif;

        // return data
        return $data;
    }

    /**
     * @method General createUser
     * @param Data $data
     * @return bool
     */
    public static function createUser(Data $data) : bool
    {
        // $created 
        $created = false;

        // run query
        db(static::ADMIN_USERS)->insert($data->getData())->go();

        // are we good ?
        if (DatabaseHandler::$lastInsertId != 0) $created = true;

        // return bool
        return $created;
    }

    /**
     * @method General UpdateUser
     * @param Data $data
     * @return mixed
     */
    public static function UpdateUser(Data $data)
    {
        // run query
        $query = db(static::ADMIN_USERS)->update($data)
        ->where('adminid = ?', $data->adminid)->go();

        // are we good
        if ($query) return true;
    }

    /**
     * @method General DeleteUser
     * @param Data $data
     * @return mixed
     */
    public static function DeleteUser(Data $data)
    {
        // run query
        $query = db(static::ADMIN_USERS)->delete('adminid = ?', $data->adminid)->go();

        // are we good
        if ($query) return true;
    }

    /**
     * @method General getAllSubscribers
     * @return array
     */
    public static function getAllSubscribers() : array
    {
        // @var mixed $query
        $query = db(static::SUBSCRIBERS)->get()->orderBy('subscriberid', 'desc')->go();

        // subscribers
        $subscribers = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) :

                // load subscriber model
                $model = Model::loadModel('subscriber');

                // unpack data
                $model->email = $row->email_address;
                $model->subscriberid = $row->subscriberid;
                $model->date = $row->date_created;

                // add to array
                $subscribers[] = $model;

            endwhile;

        endif;

        // return data
        return $subscribers;
    }

    /**
     * @method General getAllContactMessages
     * @return array
     */
    public static function getAllContactMessages() : array 
    {
        // @var mixed $query
        $query = db(static::CONTACT_MESSAGES)->get()->orderBy('contactid', 'desc')->go();

        // messages
        $messages = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $messages[] = self::unpackContactMessage($row);

        endif;

        // return data
        return $messages;
    }

    /**
     * @method General getSingleContactMessage
     * @param Data $data
     * @return mixed
     */
    public static function getSingleContactMessage(Data $data)
    {
        // @var mixed $query
        $query = db(static::CONTACT_MESSAGES)->get('contactid = ?', $data->contactid)->go();
        
        // are we good ?
        if ($query->rowCount() > 0) $data = self::unpackContactMessage($query->fetch(FETCH_OBJ));

        // return data
        return $data;
    }

    /**
     * @method General getSingleQuote
     * @param Data $data
     * @return mixed
     */
    public static function getSingleQuote(Data $data)
    {
        // @var mixed $query
        $query = db(static::QUOTES)->get('quoteid = ?', $data->quoteid)->go();
        
        // are we good ?
        if ($query->rowCount() > 0) $data = self::unpackServiceQuotes($query->fetch(FETCH_OBJ));

        // return data
        return $data;
    }

    /**
     * @method General getAllQuotes
     * @return mixed
     */
    public static function getAllQuotes()
    {
        // @var mixed $query
        $query = db(static::QUOTES)->get()->orderBy('quoteid', 'desc')->go();

        // quotes
        $response = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackServiceQuotes($row);

        endif;

        // return data
        return $response;
    }

    /**
     * @method General getAllStates
     * @return mixed
     */
    public static function getAllStates()
    {
        // @var mixed $query
        $query = db(static::STATE)->get()->orderBy('state_name', 'asc')->go();

        // quotes
        $response = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackState($row);

        endif;

        // return data
        return $response;
    }

    /**
     * @method General getStatistics
     * @return mixed
     */
    public static function getStatistics()
    {
        // get today date
        $todayDate = date('Y-m-d');

        // queries
        $queries = (object)[
            'subscribers'   => db(static::SUBSCRIBERS)->get('subscriberid'),
            'users'         => db(static::ADMIN_USERS)->get('adminid'),
            'quotes'        => db(static::QUOTES)->get('quoteid'),
            'diagnosis'     => db(static::SERVICES)->get('serviceid')->where('service_type = ?', 'diagnosis'),
            'maintenance'   => db(static::SERVICES)->get('serviceid')->where('service_type = ?', 'maintenance'),
            'repair'        => db(static::SERVICES)->get('serviceid')->where('service_type = ?', 'repair'),
            'messages'      => db(static::CONTACT_MESSAGES)->get('contactid'),
        ];

        // load new model for general statistics
        $model = Model::loadModel('statistics');

        // get today submission
        $model->today = Model::loadModel('statistics');
        $model->today->subscribers = $queries->subscribers->like('date_created', "%$todayDate%")->go()->rowCount();
        $model->today->users = $queries->users->like('date_created', "%$todayDate%")->go()->rowCount();
        $model->today->quotes = $queries->quotes->like('date_created', "%$todayDate%")->go()->rowCount();
        $model->today->diagnosis = $queries->diagnosis->like('date_submitted', "%$todayDate%")->go()->rowCount();
        $model->today->maintenance = $queries->maintenance->like('date_submitted', "%$todayDate%")->go()->rowCount();
        $model->today->repair = $queries->repair->like('date_submitted', "%$todayDate%")->go()->rowCount();
        $model->today->messages = $queries->messages->like('date_created', "%$todayDate%")->go()->rowCount();

        // queries
        $queries = (object)[
            'subscribers'   => db(static::SUBSCRIBERS)->get('subscriberid'),
            'users'         => db(static::ADMIN_USERS)->get('adminid'),
            'quotes'        => db(static::QUOTES)->get('quoteid'),
            'diagnosis'     => db(static::SERVICES)->get('serviceid')->where('service_type = ?', 'diagnosis'),
            'maintenance'   => db(static::SERVICES)->get('serviceid')->where('service_type = ?', 'maintenance'),
            'repair'        => db(static::SERVICES)->get('serviceid')->where('service_type = ?', 'repair'),
            'messages'      => db(static::CONTACT_MESSAGES)->get('contactid'),
        ];

        // unpack general data
        foreach ($queries as $key => $query) $model->{$key} = $query->go()->rowCount();

        // return model
        return $model;
    }

    /**
     * @method General getServicesRequested
     * @param array $where
     * @return mixed
     */
    public static function getServicesRequested(array $where = [])
    {
        // @var mixed $query
        $query = db(static::SERVICES)->get($where)->orderBy('serviceid', 'desc')->go();

        // quotes
        $response = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackServiceRequested($row);

        endif;

        // return data
        return $response;
    }

    /**
     * @method General getSingleServiceRequested
     * @param Data $data
     * @return mixed
     */
    public static function getSingleServiceRequested(Data $data)
    {
        // @var mixed $query
        $query = db(static::SERVICES)->get('serviceid = ?', $data->serviceid)->go();

        // are we good ?
        if ($query->rowCount() > 0) $data = self::unpackServiceRequested($query->fetch(FETCH_OBJ));

        // return data
        return $data;
    }

    /**
     * @method General UpdateService
     * @param Data $data
     * @return mixed
     */
    public static function UpdateService(Data $data)
    {
        // run query
        $query = db(static::SERVICES)->update([
            'service_fee'       => $data->serviceFee,
            'statusid'          => $data->status->statusid,
            'mechanicid'        => $data->mechanic->mechanicid,
            'date_assigned'     => $data->dateAssigned
        ])
        ->where('serviceid = ?', $data->serviceid)->go();

        // are we good
        if ($query) return true;
    }

    /**
     * @method General getStatusByID
     * @param int $id
     * @return mixed
     */
    public static function getStatusByID(int $id)
    {
        // load model
        $model = Model::loadModel('status');

        // run query
        $query = db('global_status')->get('statusid = ?', $id)->go();

        // unpack
        if ($query->rowCount() > 0) $model = self::unpackStatus($query->fetch(FETCH_OBJ));

        // return data
        return $model;
    }

    /**
     * @method General getAllStatus
     * @return array
     */
    public static function getAllStatus() : array
    {
        // run query
        $query = db('global_status')->get()->orderBy('status_name', 'desc')->go();

        // create response
        $response = [];

        // unpack
        if ($query->rowCount() > 0) :
    
            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackStatus($row);

        endif;

        // return data
        return $response;
    }

    /**
     * @method General getStatusByID
     * @param int $id
     * @return mixed
     */
    private static function getManufacturerByID(int $id)
    {
        // load model
        $model = Model::loadModel('manufacturer');

        // run query
        $query = db('manufacturers')->get('manufacturerid = ?', $id)->go();

        // unpack
        if ($query->rowCount() > 0) :

            // fetch data
            $row = $query->fetch(FETCH_OBJ);

            // extract data
            $model->name = $row->manufacturer_name;
            $model->manufacturerid = $row->manufacturerid;
            $model->logo = STORAGE_URL . '/files/' . $row->manufacturer_logo;

        endif;

        // return data
        return $model;
    }

    /**
     * @method General getStateByID
     * @param int $id
     * @return mixed
     */
    private static function getStateByID(int $id)
    {
        // load model
        $model = Model::loadModel('state');

        // run query
        $query = db(static::STATE)->get('stateid = ?', $id)->go();

        // unpack
        if ($query->rowCount() > 0) $model = self::unpackState($query->fetch(FETCH_OBJ));

        // return data
        return $model;
    }

    /**
     * @method General createMechanic
     * @param Data $data
     * @return bool
     */
    public static function createMechanic(Data $data) : bool
    {
        // $created 
        $created = false;

        // run query
        db(static::MECHANIC)->insert([
            'mechanic_name'     => $data->name,
            'mechanic_email'    => $data->email,
            'mechanic_phone'    => $data->phone,
            'stateid'           => $data->state
        ])->go();

        // are we good ?
        if (DatabaseHandler::$lastInsertId != 0) $created = true;

        // return bool
        return $created;
    }

    /**
     * @method General UpdateMechanic
     * @param Data $data
     * @return mixed
     */
    public static function UpdateMechanic(Data $data)
    {
        // run query
        $query = db(static::MECHANIC)->update([
            'mechanic_name'     => $data->name,
            'mechanic_email'    => $data->email,
            'mechanic_phone'    => $data->phone,
            'stateid'           => is_string($data->state) ? $data->state : $data->state->stateid
        ])
        ->where('mechanicid = ?', $data->mechanicid)->go();

        // are we good
        if ($query) return true;
    }

    /**
     * @method General DeleteMechanic
     * @param Data $data
     * @return mixed
     */
    public static function DeleteMechanic(Data $data)
    {
        // run query
        $query = db(static::MECHANIC)->delete('mechanicid = ?', $data->mechanicid)->go();

        // are we good
        if ($query) return true;
    }

    /**
     * @method General getMechanicByID
     * @param Data $data
     * @return mixed
     */
    public static function getMechanicByID($id)
    {
        $query = db(static::MECHANIC)->get('mechanicid = ?', $id)->go();

        // create data
        $data = Model::loadModel('mechanic');
        
        // are we good ?
        if ($query->rowCount() > 0) $data = self::unpackMechanic($query->fetch(FETCH_OBJ));

        // return data
        return $data;
    }

    /**
     * @method General getAllMechanics
     * @return mixed
     */
    public static function getAllMechanics()
    {
        // @var mixed $query
        $query = db(static::MECHANIC)->get()->orderBy('mechanic_name', 'asc')->go();

        // quotes
        $response = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackMechanic($row);

        endif;

        // return data
        return $response;
    }

    /**
     * @method General getAllUsers
     * @return mixed
     */
    public static function getAllUsers()
    {
        // @var mixed $query
        $query = db(static::ADMIN_USERS)->get()->orderBy('username', 'asc')->go();

        // quotes
        $response = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackUser($row);

        endif;

        // return data
        return $response;
    }

    /**
     * @method General getUserByID
     * @param Data $data
     * @return mixed
     */
    public static function getUserByID($id)
    {
        $query = db(static::ADMIN_USERS)->get('adminid = ?', $id)->go();

        // create data
        $data = Model::loadModel('user');
        
        // are we good ?
        if ($query->rowCount() > 0) $data = self::unpackUser($query->fetch(FETCH_OBJ));

        // return data
        return $data;
    }

    /**
     * @method General getServiceReport
     * @param int $serviceid
     * @param int $mechanicid
     * @return mixed
     */
    public static function getServiceReport(int $serviceid, int $mechanicid)
    {
        // @var mixed $query
        $query = db(static::MECHANIC_REPORT)->get(['serviceid' => $serviceid, 'mechanicid' => $mechanicid])->orderBy('reportid', 'desc')->go();

        // quotes
        $response = [];
        
        // are we good ?
        if ($query->rowCount() > 0) :

            // fetch data 
            while ($row = $query->fetch(FETCH_OBJ)) $response[] = self::unpackServiceReport($row);

        endif;

        // return data
        return $response;
    }
}