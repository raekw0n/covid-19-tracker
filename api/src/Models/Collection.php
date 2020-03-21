<?php

namespace Covid\Models;

use Exception;

class Collection
{
    private $items = [];

    public function keys() {
        return array_keys($this->items);
    }

    public function length() {
        return count($this->items);
    }

    public function keyExists($key) {
        return isset($this->items[$key]);
    }

    /**
     * @param $obj
     * @param null $key
     * @throws Exception
     */
    public function addItem($obj, $key = null) {
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
     * @param $key
     * @throws Exception
     */
    public function deleteItem($key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        } else {
            throw new Exception("Invalid key $key.");
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function getItem($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            throw new Exception("Invalid key $key.");
        }
    }
}