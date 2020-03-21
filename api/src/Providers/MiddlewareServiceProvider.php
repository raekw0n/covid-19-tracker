<?php

namespace Covid\Providers;

use Pimple\Container;
use Covid\Middleware\Auth;
use Pimple\ServiceProviderInterface;

/**
 * Class ApiServiceProvider
 */
class MiddlewareServiceProvider implements ServiceProviderInterface
{
    /**
     * Register middleware service provider.
     *
     * @param Container $container
     * @return Container|string
     */
    public function register(Container $container)
    {
        $container['auth'] = new Auth();

        return $container;
    }
}