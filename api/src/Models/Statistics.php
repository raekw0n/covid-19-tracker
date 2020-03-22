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
     * Save statistics.
     *
     * @return bool
     */
    public function save()
    {
        $this->db->query('SELECT id, country, province, confirmed, deaths, recovered, last_updated
                            FROM statistics WHERE country = :country AND province = :province');
        $this->db->bind(':country', $this->country);
        $this->db->bind(':province', $this->province);
        $check = $this->db->single();

        if ($check && $this->country === $check['country'] && $this->province === $check['province']) {
            try {
                $this->db->query(
                    'UPDATE statistics SET confirmed = :confirmed, deaths = :deaths, recovered = :recovered, last_updated = :last_updated
                    WHERE country = :country AND province = :province'
                );

                $this->db->bind(':confirmed', $this->confirmed);
                $this->db->bind(':deaths', $this->deaths);
                $this->db->bind(':recovered', $this->recovered);
                $this->db->bind(':last_updated', $this->last_updated);
                $this->db->bind(':country', $this->country);
                $this->db->bind(':province', $this->province);

                $this->db->execute();
            } catch (\Exception $e) {
                $this->log->error($e->getMessage());
                return false;
            }
        } else {
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
        }

        return true;
    }

    /**
     * Get all statistics.
     *
     * @return mixed
     */
    public function getAllStatistics()
    {
        $this->db->query('SELECT id, country, province, confirmed, deaths, recovered, last_updated
                            FROM statistics ORDER BY country;');

        $data  = [];
        foreach($this->db->resultset() as $key => $result) {
            $data[] = [
                "id" => $result['id'],
                "country" => $result['country'],
                "province" => $result['province'],
                "confirmed" => (int) $result['confirmed'],
                "deaths" => (int) $result['deaths'],
                "recovered" => (int) $result['recovered'],
                "last_updated" => $result['last_updated']
            ];
        }

        return $data;
    }

    /**
     * Get totals.
     *
     * @param array $statistics
     * @return array
     */
    public function getTotals()
    {
        $this->db->query('SELECT id, country, province, confirmed, deaths, recovered, last_updated
                            FROM statistics ORDER BY confirmed DESC;');
        $statistics = $this->db->resultset();

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
        $this->db->query('SELECT last_updated FROM statistics ORDER BY last_updated DESC LIMIT 1');
        return $this->db->single()['last_updated'];
    }

    /**
     * @param mixed $last_updated
     */
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }

}