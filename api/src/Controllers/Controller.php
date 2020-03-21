<?php

namespace Covid\Controllers;

use Pimple\Container;
use Danielle\Traits\AjaxDetector;

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

    protected $api;

    protected $auth;

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
        $this->auth = $container['auth'];
        $this->router = $container['router'];

        $this->data['title'] = env("APP_NAME");
    }
}
