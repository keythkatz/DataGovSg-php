# DataGovSg-php
Composer package for data.gov.sg

### Installation
``composer require keythkatz/datagovsg``

## Usage
```php
$datagov = new \KeythKatz\DataGovSg\DataGovSg();

// Fetch data from a supported dataset
$psi = $datagov->getPsi();

// Access data with helper methods
echo $psi->getPsiTwentyFourHourly("national");

// Alternatively, access data directly, according to the same structure in JSON
echo $psi->items[0]->readings->psi_twenty_four_hourly->national;
```

## Supported Datasets
To implement your own dataset, see [Implementing your own Dataset](#implementing-your-own-dataset)

- [PSI](#psi)
- [PM2.5](#pm25)

### PSI
``getPsi(\DateTime $date = null, bool $useTime = false)``

[Dataset](https://data.gov.sg/dataset/psi)

#### Helper Methods
Each reading available in the dataset is implemented in camelCase. For example, the data ``so2_twenty_four_hourly`` is available as ``$psi->getSo2TwentyFourHourly($region)``, where ``$region`` is in ``["national", "north", "south", "east", "west", "central"]``. If there are multiple timings provided, the first one will be returned.

### PM2.5
``getPm25(\DateTime $date = null, bool $useTime = false)``

[Dataset](https://data.gov.sg/dataset/pm2-5)

#### Helper Methods
Each reading available in the dataset is implemented in camelCase. For example, the data ``pm_25`` is available as ``$pm25->getPm25($region)``, where ``$region`` is in ``["north", "south", "east", "west", "central"]``. If there are multiple timings provided, the first one will be returned.

### Implementing your own Dataset
This package is based on the assumption that all datasets return JSON-formatted data. The abstract class ``\KeythKatz\DataGovSg\Dataset\Dataset`` is provided with helper methods.

Extend it with your new dataset, override ``protected static $path`` with the full path to the API, and implement ``__construct``. Additionally, you might want to include helper methods to commonly accessed data. An example is given below:

```php
class Pm25 extends \KeythKatz\DataGovSg\Dataset\Dataset
{
	// Override this with the path to the dataset
	protected static $path = "/v1/environment/pm25";
    
    public function __construct(\DateTime $date = null, bool $useTime = false)
    {
        if ($date !== null) {
            if (!$useTime) {
                $dateString = $date->format("Y-m-d");
                // Added parameters will be sent as a querystring
                $this->addParameter("date", $dateString);
            } else {
                $dateString = $date->format("c");
                // Added parameters will be sent as a querystring
                $this->addParameter("date_time", $dateString);
            }
        }
		
        // Makes a query and pulls the results into itself.
        $this->populateData();
    }
    
    // Helper methods for commonly accessed data
    
    /**
     * Get the reading from the first item in the fetched data.
     * @param  string $region Region of the data. Must match what is available on the API.
     * @return int
     */
    public function getPm25OneHourly(string $region): int
    {
        return $this->items[0]->readings->pm25_one_hourly->$region;
    }
}
```
