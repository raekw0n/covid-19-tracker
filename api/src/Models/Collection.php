<?php

namespace Covid\Models;

use Exception;

class Collection
{
    /** @var array $items */
    private $items = [];

    /**
     * Create a new collection instance.
     *
     * @param $collection
     * @param $object
     * @param $name
     * @return Collection|null
     */
    public function collect(Collection $collection, $object, $name)
    {
        foreach ($object as $key => $obj) {
            try {
                $collection->add($obj, $obj[$name]);
            } catch (\Exception $e) {
                app('log')->error($e->getMessage());
                return null;
            }
        }

        return $collection;
    }

    /**
     * Return all keys in the collection.
     *
     * @return array
     */
    public function keys() {
        return array_keys($this->items);
    }

    /**
     * Return an item by key in the collection.
     *
     * @param $key
     * @return bool
     */
    public function key($key) {
        return $this->items[$key];
    }

    /**
     * Return the length of the collection.
     *
     * @return int
     */
    public function length() {
        return count($this->items);
    }

    /**
     * Add an item to the collection.
     *
     * @param $obj
     * @param null $key
     * @throws Exception
     */
    public function add($obj, $key = null) {
        if ($key == null) {
            $this->items[] = $obj;
        }
        else {
            if (isset($this->items[$key])) {
                throw new Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
    }

    /**
     * Remove an item from the collection.
     *
     * @param $key
     * @throws Exception
     */
    public function remove($key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        } else {
            throw new Exception("Invalid key $key.");
        }
    }

    /**
     * Return all items in the collection.
     *
     * @return mixed
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * Get an item from the collection.
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function item($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            throw new Exception("Invalid key $key.");
        }
    }
}