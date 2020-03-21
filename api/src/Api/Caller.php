<?php

namespace Covid\Api;

use GuzzleHttp\Client;

/**
 * Class Caller.
 */
class Caller extends Api
{
    /** @var Client the api client */
    private $client;

    /**
     * Monitor constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('API_URL'),
        ]);
    }

    /**
     * Call Api.
     *
     * @param string $method
     * @param string $endpoint
     *
     * @return array|bool
     */
    public function call(string $endpoint, string $method = 'GET')
    {
        if (env('APP_DEBUG') === true) {
            $file = __DIR__.'/../../tests/'.$endpoint.'.json';
            if (file_exists($file)) {
                return json_decode(file_get_contents($file));
            } else {
                return false;
            }
        }

        if (substr($endpoint, 0, 1) !== '/') {
            $endpoint = '/'.$endpoint;
        }

        try {
            $response = $this->client->request($method, 'api/v1'.$endpoint);
            if ($response && $response->getStatusCode() === 200) {
                return json_decode($response->getBody()->getContents());
            } else {
                return false;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();

            return false;
        }
    }
}
