<?php

namespace Covid\Models;

use Danielle\Models\Model;

/**
 * Class Statistics
 */
class Statistics extends Model
{
    /** @var $id */
    protected $id;

    /** @var $country */
    protected $country;

    /** @var $province */
    protected $province;

    /** @var $confirmed */
    protected $confirmed;

    /** @var $deaths */
    protected $deaths;

    /** @var $recovered */
    protected $recovered;

    /** @var $last_updated */
    protected $last_updated;

    /** @var $post */
    protected $post;

    /**
     * Save blog post.
     *
     * @return bool
     */
    public function save()
    {
        try {
            $this->db->query(
                'INSERT INTO statistics (country, province, confirmed, deaths, recovered, last_updated) 
                VALUES (:country, :province, :confirmed, :deaths, :recovered, :last_updated)'
            );

            $this->db->bind(':country', $this->country);
            $this->db->bind(':province', $this->province);
            $this->db->bind(':confirmed', $this->confirmed);
            $this->db->bind(':deaths', $this->deaths);
            $this->db->bind(':recovered', $this->recovered);
            $this->db->bind(':last_updated', $this->last_updated);

            $this->db->execute();
        } catch (\Exception $e) {
            $this->log->error($e->getMessage());
            return false;
        }

        return true;
    }

    public function collect($data)
    {
        $collection = new Collection();
        foreach ($data as $key => $stat) {
            try {
                $collection->add($stat, $stat['id']);
            } catch (\Exception $e) {
                app('log')->error($e->getMessage());
                return null;
            }
        }

        return $collection;
    }

    /**
     * Get all posts.
     *
     * @return mixed
     */
    public function getAllStatistics()
    {
        $this->db->query('SELECT id, country, province, confirmed, deaths, recovered, last_updated
                            FROM statistics ORDER BY confirmed DESC;');
        return $this->db->resultset();
    }

    /**
     * Get totals.
     *
     * @param array $statistics
     * @return array
     */
    public function getTotals(array $statistics)
    {
        $totals = [
            'confirmed' => 0,
            'deaths' => 0,
            'recovered' => 0,
        ];

        foreach($statistics as $key => $country) {
            $totals['confirmed'] += $country['confirmed'];
            $totals['deaths'] += $country['deaths'];
            $totals['recovered'] += $country['recovered'];
        }

        return $totals;
    }

    /**
     * Set attributes.
     *
     * @param array $data
     * @return mixed
     */
    public function setAttributes(array $data)
    {
        if (is_null($data['province']) || $data['province'] === '') {
           $data['province'] = $data['country'];
        }

        try {
            $this->setCountry($data['country']);
            $this->setProvince($data['province']);
            $this->setConfirmed($data['confirmed']);
            $this->setDeaths($data['deaths']);
            $this->setRecovered($data['recovered']);
            $this->setLastUpdated($data['lastUpdate']);

            $this->post = $data;

        } catch (\Exception $e) {
            $this->log->error($e->getMessage());
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getByCountry(string $country)
    {
        $this->setCountry($country);

        $this->db->query('SELECT id, country, province, confirmed, deaths, recovered, last_updated
                            FROM statistics WHERE country RLIKE :country ORDER BY confirmed DESC;');
        $this->db->bind(':country', $this->country);

        return $this->db->resultset();
    }

    /**
     * @param mixed $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getByProvince(string $province)
    {
        $this->setProvince($province);

        $this->db->query('SELECT id, country, province, confirmed, deaths, recovered, last_updated
                            FROM statistics WHERE province RLIKE :province ORDER BY confirmed DESC;');
        $this->db->bind(':province', $this->province);

        return $this->db->resultset();
    }

    /**
     * @param mixed $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param mixed $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return mixed
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * @param mixed $deaths
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;
    }

    /**
     * @return mixed
     */
    public function getRecovered()
    {
        return $this->recovered;
    }

    /**
     * @param mixed $recovered
     */
    public function setRecovered($recovered)
    {
        $this->recovered = $recovered;
    }

    /**
     * @return mixed
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }

    /**
     * @param mixed $last_updated
     */
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }

}