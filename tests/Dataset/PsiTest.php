<?php
declare (strict_types = 1);

namespace KeythKatz\DataGovSg\Test\Dataset;

class PsiTest extends \PHPUnit\Framework\TestCase
{
    protected $datagov;

    protected function setup()
    {
        date_default_timezone_set("Asia/Singapore");
        $this->datagov = new \KeythKatz\DataGovSg\DataGovSg();
    }

    public function testDateTime()
    {
        $psi = $this->datagov->getPsi(new \DateTime("2018-09-22T08:00:00+08:00"), true);
        $this->assertSame(2, $psi->getO3SubIndex("north"));
    }

    public function testDateOnly()
    {
        $psi = $this->datagov->getPsi(new \DateTime("2018-09-22"));
        $this->assertSame(10, $psi->getO3SubIndex("national"));
    }
}
