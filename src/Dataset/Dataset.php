<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Dataset;

abstract class Dataset
{

    /**
     * /path/to/dataset on api.data.gov.sg. Necessary to override.
     * @var string
     */
    protected static $path;

    protected $parameters = [];

    /**
     * Add a parameter to be sent in the get request.
     * @param string $name
     * @param string $data
     */
    protected function addParameter(string $name, string $data)
    {
        $this->parameters[$name] = $data;
    }

    /**
     * Fetch, decode, and set to itself the data from
     * the API with the set parameters.
     */
    protected function populateData()
    {
        $url = \KeythKatz\DataGovSg\DataGovSg::API_URL . static::$path . "?";
        $first = true;
        foreach ($this->parameters as $name => $data) {
            if ($first) {
                $first = false;
            } else {
                $url .= "&";
            }

            $url .= $name . "=" . $data;
        }

        $guzzle = new \GuzzleHttp\Client();
        $response = $guzzle->request("GET", $url);
        $obj = json_decode((string) $response->getBody());
        foreach ($obj as $key => $value) {
            $this->$key = $value;
        }
    }
}
