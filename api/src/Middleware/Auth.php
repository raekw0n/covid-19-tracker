<?php

namespace Covid\Middleware;

/**
 * Class Auth
 */
class Auth
{
    /**
     * Basic Authentication.
     */
    public function require()
    {
        $user = env('APP_USER');
        $pass = env('APP_PASSWORD');

        header('Cache-Control: no-cache, must-revalidate, max-age=0');

        $attempt = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $guard = (
            !$attempt ||
            $_SERVER['PHP_AUTH_USER'] != $user ||
            $_SERVER['PHP_AUTH_PW']   != $pass
        );

        if ($guard) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
    }
}