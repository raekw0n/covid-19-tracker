<?php

namespace Covid\Controllers;

use Covid\Models\Statistics;
use Pimple\Container;

class StatisticsController extends Controller
{

    protected $model;

    public function __construct(Container $container)
    {
        $this->model = new Statistics($container);

        parent::__construct($container);
    }

    public function get(array $data = [])
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

        return json_encode(['records' => $recorded, 'total' => $total]);
    }
}