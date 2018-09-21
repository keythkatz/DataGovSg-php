<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Dataset;

abstract class Dataset
{

    protected static $path;
    protected $parameters = [];

    protected function addParameter(string $name, string $data)
    {
        $this->parameters[$name] = $data;
    }

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
        echo ($response->getBody());
    }
}
