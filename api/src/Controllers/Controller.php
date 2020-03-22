<?php

namespace Covid\Controllers;

use Covid\Models\Collection;
use Pimple\Container;
use Covid\Factories\CollectionFactory;

/**
 * Abstract base controller class.
 */
abstract class Controller
{
    /** @var mixed $log */
    protected $log;

    /** @var mixed $db */
    protected $db;

    /** @var mixed $api */
    protected $api;

    /** @var mixed $router */
    protected $router;

    /** @var array $data */
    public $data = [];

    /**
     * Abstract Controller constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->log = $container['log'];
        $this->db  = $container['db'];
        $this->api = $container['api'];
        $this->router = $container['router'];

        $this->data['title'] = env("APP_NAME");
    }

    /**
     * Create collections.
     *
     * @param $object
     * @param string $name
     * @return \Covid\Models\Collection|null
     */
    public function collect($object, $name = 'id')
    {
        return CollectionFactory::create($object, $name);
    }

    /**
     * Paginate data.
     *
     * @param array $data
     * @param $offset
     * @param $limit
     * @return array
     */
    public function paginate(Collection $collection, $page, $limit)
    {
        return [
            'page'  => (int) $page,
            'limit' => (int) $limit,
            'pages' => (int) ceil($collection->length() / $limit),
            'items' => array_slice($collection->items(), (($page - 1) * $limit), $limit),
        ];
    }
}
