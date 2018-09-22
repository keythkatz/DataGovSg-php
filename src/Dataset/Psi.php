<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Dataset;

/**
 * PSI Dataset.
 * https://data.gov.sg/dataset/psi
 */
class Psi extends Dataset
{

    private static $regions = ["national", "north", "south", "east", "west", "central"];

    protected static $path = "/v1/environment/psi";

    public function __construct(\DateTime $date = null, bool $useTime = false)
    {
        if ($date !== null) {
            if (!$useTime) {
                $dateString = $date->format("Y-m-d");
                $this->addParameter("date", $dateString);
            } else {
                $dateString = $date->format("c");
                $this->addParameter("date_time", $dateString);
            }
        }

        $this->populateData();
    }

    private function validateRegion(string $region)
    {
        if (!in_array(strtolower($region), self::$regions)) {
            throw new \InvalidArgumentException("\"$region\" is not in the list of regions.");
        }
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getO3SubIndex(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->o3_sub_index->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getPm10TwentyFourHourly(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->pm10_twenty_four_hourly->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getPm10SubIndex(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->pm10_sub_index->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getCoSubIndex(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->co_sub_index->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getPm25TwentyFourHourly(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->pm25_twenty_four_hourly->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getSo2SubIndex(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->so2_sub_index->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getCoEightHourMax(string $region): float
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->co_eight_hour_max->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getNo2OneHourMax(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->no2_one_hour_max->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getSo2TwentyFourHourly(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->so2_twenty_four_hourly->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getPm25SubIndex(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->pm25_sub_index->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getPsiTwentyFourHourly(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->psi_twenty_four_hourly->$region;
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getO3EightHourMax(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->o3_eight_hour_max->$region;
    }
}
