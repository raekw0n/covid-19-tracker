<?php

namespace Covid\Factories;

use Covid\Models\Collection;

/**
 * Class CollectionFactory
 */
class CollectionFactory
{
    /**
     * Create collection instances.
     *
     * @param $object
     * @param $name
     * @return Collection|null
     */
    public static function create($object, $name)
    {
        $collection = new Collection();
        return $collection->collect($collection, $object, $name);
    }
}