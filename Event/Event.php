<?php
namespace Rx\Event;


use Rx\Contract\EventInterface;

class Event implements EventInterface
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var mixed
     */
    public $data;
    /**
     * @var array
     */
    public $labels;

    /**
     * Event constructor.
     * @param $name
     * @param $data
     * @param array $labels
     */
    public function __construct($name, $data = null, $labels = [])
    {
        $this->name = $name;
        $this->data = $data;
        $this->labels = $labels;
    }

    /**
     * @param $name
     * @return bool
     */
    public function is($name) {
        return $this->name === $name;
    }

    /**
     * @param string $name filter with * possible
     * @return bool
     */
    public function contains($name) {
        return fnmatch($name, $this->name, FNM_CASEFOLD);
    }
    public function getName() {
        return $this->name;
    }
    public function getData($key = null) {
        if (null !== $key) {
            return array_get($this->data, $key, null);
        }

        return $this->data;
    }
    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function hasLabel($key, $value = null) {
        if(!$value) {
            return (bool) isset($this->labels[$key]);
        }
        return boolval(array_get($this->labels, $key, false) === $value);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getLabel($key) {
        return array_get($this->labels, $key);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return ["name" => $this->name, "labels" => $this->labels, "data" => $this->data];
    }
}