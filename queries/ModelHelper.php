<?php
namespace Queries;

use Lightroom\Adapter\ClassManager;
/**
 * @package ModelHelper
 * @author Amadi Ifeanyi <amadiify.com>
 */
trait ModelHelper
{
    /**
     * @method Model loadModel
     * @param string $method
     * @return class
     */
    public static function loadModel(string $method)
    {
        // get instance
        $class = ClassManager::singleton(static::class);

        // create data
        $data = [];

        // check if method exists
        if (method_exists($class, $method)) $data = $class->{$method}();

        // return class
        return new Data($data);
    }
}