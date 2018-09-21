<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Dataset;

class Psi extends Dataset
{

    protected static $path = "/v1/environment/psi";

    public function __construct(\DateTime $date = null, bool $useTime = false)
    {
        if ($date === null) {
            $date = new \DateTime();
        }
        if (!$useTime) {
            $dateString = $date->format("Y-m-d");
            $this->addParameter("date", $dateString);
        } else {
            $dateString = $date->format("r");
            $this->addParameter("date_time", $dateString);
        }

        $this->populateData();
    }
}
