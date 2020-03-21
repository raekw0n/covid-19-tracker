<?php

namespace Covid\Controllers;

use Pimple\Container;
use Danielle\Traits\AjaxDetector;
use Covid\Models\CollectionFactory;

/**
 * Abstract base controller class.
 */
abstract class Controller
{
    use AjaxDetector;

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
}
