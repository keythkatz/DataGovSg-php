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
        $this->assertSame(6, $psi->getO3SubIndex("national"));
        $this->assertSame(26, $psi->getPm10TwentyFourHourly("national"));
        $this->assertSame(26, $psi->getPm10SubIndex("national"));
        $this->assertSame(7, $psi->getCoSubIndex("national"));
        $this->assertSame(15, $psi->getPm25TwentyFourHourly("national"));
        $this->assertSame(16, $psi->getSo2SubIndex("national"));
        $this->assertSame(0.66, $psi->getCoEightHourMax("national"));
        $this->assertSame(38, $psi->getNo2OneHourMax("national"));
        $this->assertSame(26, $psi->getSo2TwentyFourHourly("national"));
        $this->assertSame(55, $psi->getPm25SubIndex("national"));
        $this->assertSame(55, $psi->getPsiTwentyFourHourly("national"));
        $this->assertSame(15, $psi->getO3EightHourMax("national"));
    }

    public function testDateOnly()
    {
        $psi = $this->datagov->getPsi(new \DateTime("2018-09-22"));
        $this->assertSame(10, $psi->getO3SubIndex("national"));
        $this->assertSame(27, $psi->getPm10TwentyFourHourly("national"));
        $this->assertSame(27, $psi->getPm10SubIndex("national"));
        $this->assertSame(10, $psi->getCoSubIndex("national"));
        $this->assertSame(15, $psi->getPm25TwentyFourHourly("national"));
        $this->assertSame(14, $psi->getSo2SubIndex("national"));
        $this->assertSame(1.0, $psi->getCoEightHourMax("national"));
        $this->assertSame(62, $psi->getNo2OneHourMax("national"));
        $this->assertSame(23, $psi->getSo2TwentyFourHourly("national"));
        $this->assertSame(54, $psi->getPm25SubIndex("national"));
        $this->assertSame(54, $psi->getPsiTwentyFourHourly("national"));
        $this->assertSame(24, $psi->getO3EightHourMax("national"));
    }

    public function testAllRegionsAreValid()
    {
        $psi = $this->datagov->getPsi(new \DateTime("2018-09-22"));
        $this->assertSame(10, $psi->getO3SubIndex("west"));
        $this->assertSame(10, $psi->getO3SubIndex("national"));
        $this->assertSame(5, $psi->getO3SubIndex("east"));
        $this->assertSame(4, $psi->getO3SubIndex("central"));
        $this->assertSame(3, $psi->getO3SubIndex("south"));
        $this->assertSame(3, $psi->getO3SubIndex("north"));
    }

    public function testInvalidRegionsThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $psi = $this->datagov->getPsi(new \DateTime("2018-09-22"));
        $this->assertSame(10, $psi->getO3SubIndex("hurrdurr"));
    }
}
