<?php
namespace Queries;
/**
 * @package Data
 * @author Amadi Ifeanyi <amadiify.com>
 */
class Data
{
    /**
     * @var array $data
     */
    private $data = [];

    // extract
    public function __construct(array $data)
    {
        $this->data = array_flip($data);
    }

    // read data
    public function __get(string $name)
    {
        if (isset($this->data[$name])) return $this->data[$name];
    }

    // set data
    public function __set(string $name, $data)
    {
        $this->data[$name] = $data;
    }

    // get all
    public function getData()
    {
        return $this->data;
    }
}