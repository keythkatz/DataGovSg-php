<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg;

class DataGovSg
{
    const API_URL = "https://api.data.gov.sg";

    /**
     * Get the PSI dataset.
     * @param  \DateTime|null $date    PHP DateTime object.
     * @param  bool|boolean   $useTime Whether to specify the time.
     * @return \KeythKatz\DataGovSg\Dataset\Psi
     */
    public function getPsi(\DateTime $date = null, bool $useTime = false): \KeythKatz\DataGovSg\Dataset\Psi
    {
        return new \KeythKatz\DataGovSg\Dataset\Psi($date, $useTime);
    }
}
