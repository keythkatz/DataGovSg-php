<?php
declare(strict_types=1);

namespace KeythKatz\DataGovSg;

class DataGovSg {
	public const API_URL = "https://api.data.gov.sg";

	public function getPsi(\DateTime $date = null, bool $useTime = false): \KeythKatz\DataGovSg\Dataset\Psi
	{
		return new \KeythKatz\DataGovSg\Dataset\Psi($date, $useTime);
	}
}