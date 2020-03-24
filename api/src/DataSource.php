<?php

namespace Covid;

use Covid\Models\Statistics;

class DataSource
{
    protected $file;

    protected $handle;

    protected $data = [];

    protected static $modelMappings = [
        'Country_Region' => 'country',
        'Province_State' => 'province',
        'Confirmed'      => 'confirmed',
        'Deaths'         => 'deaths',
        'Recovered'      => 'recovered',
        'Last_Update'    => 'last_updated'
    ];

    /**
     * DataSource constructor.
     *
     * @param null $file
     */
    public function __construct($file = null)
    {
        if (is_null($file)) {
            $this->file = date('Y-m-d') . '.csv';
        } else {
            $this->file = pathinfo($file)['extension'] === 'csv' ? $file : $file . '.csv';
        }

        $this->file = $this->storagePath() . $this->file;
    }

    /**
     * Import statistics
     *
     * @return mixed
     */
    public function import()
    {
        $this->handle = fopen($this->file, 'r');
        $line = 0;
        $imported = 0;
        $total = 0;
        while (($row = fgetcsv($this->handle)) !== false) {
            ++$total;
            if($line === 0) {
                $keys = $row;
            } else {
                if(isset($keys)) {
                    foreach ($keys as $key) {
                        if ($key === 'Country_Region') $this->data[$line][static::$modelMappings[$key]] = $row[3];
                        if ($key === 'Province_State') $this->data[$line][static::$modelMappings[$key]] = $row[2];
                        if ($key === 'Confirmed')      $this->data[$line][static::$modelMappings[$key]] = $row[7];
                        if ($key === 'Deaths')         $this->data[$line][static::$modelMappings[$key]] = $row[8];
                        if ($key === 'Recovered')      $this->data[$line][static::$modelMappings[$key]] = $row[9];
                        if ($key === 'Last_Update')    $this->data[$line][static::$modelMappings[$key]] = $row[4];
                    }

                    $statistics = (new Statistics(app()))->setAttributes($this->data[$line]);

                    if($statistics->save()) {
                        ++$imported;
                    }
                }
            }
            $line++;
        }

        return ['imported' => $imported, 'total' => $total];
    }

    /**
     * Fetch the storage path for CSV files.
     *
     * @return string
     */
    private function storagePath()
    {
        return __DIR__ . '/../storage/data/';
    }
}