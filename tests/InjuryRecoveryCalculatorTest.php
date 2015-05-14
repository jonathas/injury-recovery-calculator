<?php

require_once 'lib/functions.php';
require_once 'classes/InjuryRecoveryCalculator.php';

class InjuryRecoveryCalculatorTest extends PHPUnit_Framework_TestCase
{

    public $irc;

    public function setUp()
    {
        $this->irc = new InjuryRecoveryCalculator();
    }

    /**
     * @covers              InjuryRecoveryCalculator
     * @expectedException   InvalidArgumentException
     */
    public function testCannotBeCalledWithNoParameters()
    {
        validateParameters();
    }

    /**
     * @covers              InjuryRecoveryCalculator
     * @expectedException   InvalidArgumentException
     */
    public function testCannotBeCalculatedFromNonIntegerValue()
    {
        $this->irc->calculateRecoveryDate('10:00 am', 'a');
    }

    /**
     * @covers              InjuryRecoveryCalculator
     * @expectedException   InvalidArgumentException
     */
    public function testCannotBeCalculatedFromNonPositiveIntegerValue()
    {
        $this->irc->calculateRecoveryDate('10:00 am', -2);
    }

    /**
     * @covers              InjuryRecoveryCalculator
     * @expectedException   InvalidArgumentException
     */
    public function  testCannotBeCalculatedFromZeroValue()
    {
        $this->irc->calculateRecoveryDate('10:00 am', 0);
    }

    /**
     * @covers              InjuryRecoveryCalculator
     * @expectedException   InvalidArgumentException
     */
    public function testCannotBeCalculatedFromInvalidHourFormat()
    {
        $this->irc->calculateRecoveryDate('13:00', 10);
    }

    /**
     * @covers              InjuryRecoveryCalculator
     * @expectedException   InvalidArgumentException
     */
    public function testCannotBeCalculatedFromEmptyParameters()
    {
        $this->irc->calculateRecoveryDate('','');
    }

    /**
     * @covers              InjuryRecoveryCalculator
     */
    public function testDateTimeCannotBe24HourFormat()
    {
        $startDateTime = date("Y-m-d") . " 13:00";
        $this->assertFalse(isDateValid($startDateTime));
    }

    /**
     * @covers              InjuryRecoveryCalculator
     */
    public function testDateTimeMustBe12HourFormat()
    {
        $startDateTime = date("Y-m-d") . " 10:00 am";
        $this->assertTrue(isDateValid($startDateTime));
    }

    /**
     * @covers              InjuryRecoveryCalculator
     */
    public function testDateTimeDistributionOfHoursNeeded()
    {
        $startTime = "10:00 am";
        //Ex: 04:00 pm on Wednesday, May 13th 2015
        $dateTime = DateTime::createFromFormat("h:i a \\o\\n l, F jS Y", $startTime . " " . date(" \\o\\n l, F jS Y"));
        $hoursNeeded = 18; //3 days of work for the doctor

        switch($dateTime->format("w")) {
            //Sunday
            case 0:
                $dateTime->add(new DateInterval('P3DPT6H'));
                break;
            //Saturday
            case 6:
                $dateTime->add(new DateInterval('P4DPT6H'));
                break;
            //Friday
            case 5:
                $dateTime->add(new DateInterval('P4DPT6H'));
                break;
            //Thursday
            case 4:
                $dateTime->add(new DateInterval('P4DPT6H'));
                break;
            default:
                $dateTime->add(new DateInterval('P2DPT6H'));
        }

        $this->assertEquals($this->irc->calculateRecoveryDate($startTime, $hoursNeeded), $dateTime->format("h:i a \\o\\n l, F jS Y"));
    }

}