<?php

namespace Covid\Controllers;

use Covid\Models\Statistics;
use Klein\Response;
use Pimple\Container;

class StatisticsController extends Controller
{

    /** @var Statistics $model */
    protected $model;

    /**
     * StatisticsController constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->model = new Statistics($container);

        parent::__construct($container);
    }

    /**
     * Fetch statistics.
     *
     * @return mixed
     */
    public function fetch(Response $response)
    {
        return $response->json(['data' => $this->model->getAllStatistics()]);
    }

    /**
     * Update statistics.
     *
     * @param array $data
     * @return mixed
     */
    public function update(Response $response)
    {
        $data = $this->api->call('stats')->data->covid19Stats;

        $recorded = 0;
        $total = count($data);
        foreach ($data as $country) {
            $this->model->setAttributes(toArray($country));
            if ($this->model->save()) {
                ++$recorded;
            }
        }

        return $response->json(['records' => $recorded, 'total' => $total]);
    }
}