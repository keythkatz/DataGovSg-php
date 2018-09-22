<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Dataset;

/**
 * PM2.5, not PM25.
 * https://data.gov.sg/dataset/pm2-5
 */
class Pm25 extends Dataset
{

    private static $regions = ["north", "south", "east", "west", "central"];

    protected static $path = "/v1/environment/pm25";

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
    public function getPm25OneHourly(string $region): int
    {
        $region = strtolower($region);
        $this->validateRegion($region);
        return $this->items[0]->readings->pm25_one_hourly->$region;
    }
}
