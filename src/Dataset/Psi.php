<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Dataset;

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
                $dateString = $date->format("r");
                $this->addParameter("date_time", $dateString);
            }
        }

        $this->populateData();
    }

    private function validateRegion(string $region)
    {
        if (!in_array(strtolower($region), self::$regions)) {
            throw new InvalidArgumentException("\"$region\" is not in the list of regions.");
        }
    }

    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getO3SubIndex(string $region): int
    {
        $this->validateRegion($region);

        return $this->items[0]->readings->o3_sub_index->$region;
    }
}
