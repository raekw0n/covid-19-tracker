<?php

namespace Covid;

use Covid\Models\Statistics;

/**
 * Class DataSource
 */
class DataSource
{
    /** @var string $file */
    protected $file;

    /** @var resource $handle */
    protected $handle;

    /** @var array $data */
    protected $data = [];

    /** @var array $fillable */
    protected static $fillable = [
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
     * Import statistics.
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
            if ($line === 0) {
                $keys = $row;
            } else {
                if (isset($keys)) {
                    foreach ($keys as $idx => $key) {
                        if (isset(static::$fillable[$key])) {
                            $this->data[$line][static::$fillable[$key]] = $row[$idx];
                        }
                    }

                    $statistics = (new Statistics(app()))->setAttributes($this->data[$line]);

                    if ($statistics->save()) {
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