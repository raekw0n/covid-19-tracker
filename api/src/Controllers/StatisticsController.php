<?php

namespace Covid\Controllers;

use Klein\Request;
use Klein\Response;
use Pimple\Container;
use Covid\Models\Statistics;

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
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function fetch(Request $request, Response $response)
    {
        $country  = $request->param('country');
        $province = $request->param('province');

        if ($country) {
            return $response->json(['data' => $this->model->getByCountry($country)]);
        } else if ($province) {
            return $response->json(['data' => $this->model->getByprovince($province)]);
        }

        $statistics = $this->model->getAllStatistics();
        return $response->json(['totals' => $this->model->getTotals($statistics), 'data' => $statistics]);
    }

    /**
     * Update statistics.
     *
     * @param Response $response
     * @return mixed
     */
    public function update(Response $response)
    {
        $data = $this->api->call('stats')->data->covid19Stats;

        foreach ($data as $country) {
            $this->model->setAttributes(toArray($country));
            $this->model->save();
        }

        return $response->json(['data' => $data]);
    }
}