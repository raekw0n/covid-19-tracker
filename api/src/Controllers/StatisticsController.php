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
            $statistics =  $this->model->getByCountry($country);
        } else if ($province) {
            $statistics =  $this->model->getByProvince($province);
        } else {
            $statistics = $this->model->getAllStatistics();
        }

        $data = $this->paginate(
            $this->collect($statistics),
            $request->param('page'),
            $request->param('limit')
        );

        return $response->json(['totals' => $this->model->getTotals(), 'data' => $data]);
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