<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Test\Dataset;

class Pm25Test extends \PHPUnit\Framework\TestCase
{
    protected $datagov;

    protected function setup()
    {
        date_default_timezone_set("Asia/Singapore");
        $this->datagov = new \KeythKatz\DataGovSg\DataGovSg();
    }

    public function testDateTime()
    {
        $pm25 = $this->datagov->getPm25(new \DateTime("2018-09-22T08:00:00+08:00"), true);
        $this->assertSame(11, $pm25->getPm25OneHourly("north"));
    }

    public function testDateOnly()
    {
        $pm25 = $this->datagov->getPm25(new \DateTime("2018-09-22"));
        $this->assertSame(19, $pm25->getPm25OneHourly("north"));
    }

    public function testAllRegionsAreValid()
    {
        $pm25 = $this->datagov->getPm25(new \DateTime("2018-09-22"));
        $this->assertSame(15, $pm25->getPm25OneHourly("west"));
        $this->assertSame(6, $pm25->getPm25OneHourly("east"));
        $this->assertSame(17, $pm25->getPm25OneHourly("central"));
        $this->assertSame(13, $pm25->getPm25OneHourly("south"));
        $this->assertSame(19, $pm25->getPm25OneHourly("north"));
    }

    public function testInvalidRegionsThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $pm25 = $this->datagov->getPm25(new \DateTime("2018-09-22"));
        $this->assertSame(10, $pm25->getPm25OneHourly("national"));
    }
}
