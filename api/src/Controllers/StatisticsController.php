<?php

namespace Covid\Controllers;

use Covid\DataSource;
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
     * Return API info.
     *
     * @param Response $response
     * @return Response
     */
    public function info(Response $response)
    {
        return $response->json([
            'description' => 'Track worldwide COVID-19 statistics.',
            'version' => '1.0.0',
            'last_updated' => $this->model->getLastUpdated()
        ]);
    }

    /**
     * Return list of countries.
     *
     * @param Response $response
     * @return Response
     */
    public function countries(Response $response)
    {
        return $response->json(['countries' => $this->model->getAllCountries()]);
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
        $data['last_update'] = $this->model->getLastUpdated();

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
//        TODO new data from the weedmark api contains errors, keep monitoring.
//        $data = $this->api->call('stats')->data->covid19Stats;
//        foreach ($data as $country) {
//            $this->model->setAttributes(toArray($country));
//            $this->model->save();
//        }

        // Fetch data from https://github.com/CSSEGISandData/COVID-19
        $data = (new DataSource('2020-03-23.csv'))->import();

        return $response->json(['data' => $data]);
    }
}