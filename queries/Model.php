<?php
namespace Queries;

/**
 * @package class Model
 * @author Amadi Ifeanyi <amadiify.com>
 */
class Model
{
    use ModelHelper;

    /**
     * @method Model user
     * @return array
     */
    public function user() : array 
    {
        return [
            'adminid',
            'username',
            'email',
            'password',
            'passwordSalt'
        ];
    }

    /**
     * @method Model adduser
     * @return array
     */
    public function adduser() : array 
    {
        return [
            'username',
            'email',
            'password',
            'password_salt'
        ];
    }

    /**
     * @method Model subscriber
     * @return array
     */
    public function subscriber() : array 
    {
        return [
            'subscriberid',
            'email',
            'date',
        ];
    }

    /**
     * @method Model contact
     * @return array
     */
    public function contact() : array 
    {
        return [
            'contactid',
            'email',
            'date',
            'name',
            'phone',
            'message'
        ];
    }

    /**
     * @method Model quotes
     * @return array
     */
    public function quotes() : array 
    {
        return [
            'quoteid',
            'email',
            'date',
            'name',
            'phone',
            'issue',
            'serviceType',
            'location',
            'carModel',
            'carYear',
            'manufacturer',
            'numberOfCars',
            'mileage',
        ];
    }

    /**
     * @method Model statistics
     * @return array
     */
    public function statistics() : array 
    {
        return [
            'subscribers',
            'users',
            'quotes',
            'diagnosis',
            'repair',
            'maintenance',
            'messages'
        ];
    }

    /**
     * @method Model services
     * @return array
     */
    public function services() : array 
    {
        return [
            'serviceid',
            'serviceType',
            'email',
            'date',
            'name',
            'phone',
            'location',
            'address',
            'manufacturer',
            'carYear',
            'carModel',
            'needingMechanic',
            'dateToVisit',
            'timeToVisit',
            'comment',
            'status',
            'subscribeToAplan',
            'mechanic',
            'serviceFee',
            'dateAssigned'
        ];
    }

    /**
     * @method Model status
     * @return array
     */
    public function status() : array 
    {
        return [
            'name',
            'statusid'
        ];
    }

    /**
     * @method Model manufacturer
     * @return array
     */
    public function manufacturer() : array 
    {
        return [
            'name',
            'logo',
            'visible',
            'manufacturerid'
        ];
    }

    /**
     * @method Model state
     * @return array
     */
    public function state() : array 
    {
        return [
            'name',
            'stateid'
        ];
    }

    /**
     * @method Model mechanic
     * @return array
     */
    public function mechanic() : array 
    {
        return [
            'name',
            'email',
            'phone',
            'state',
            'mechanicid',
            'pending',
            'completed',
            'ongoing'
        ];
    }

    /**
     * @method Model serviceReport
     * @return array
     */
    public function serviceReport() : array 
    {
        return [
            'mechanic',
            'report',
            'date',
            'reportid'
        ];
    }
}