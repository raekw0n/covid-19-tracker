<?php

namespace Covid\Providers;

use Covid\Api\Caller;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ApiServiceProvider
 */
class ApiServiceProvider implements ServiceProviderInterface
{
    /**
     * Register api service provider.
     *
     * @param Container $container
     * @return Container|string
     */
    public function register(Container $container)
    {
        $container['api'] = new Caller();

        return $container;
    }
}