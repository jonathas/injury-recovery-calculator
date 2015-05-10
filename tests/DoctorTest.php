<?php

require_once 'classes/Doctor.php';

class DoctorTest extends PHPUnit_Framework_TestCase
{

    public $doctor;

    public function setUp()
    {
        $this->doctor = new Doctor();
    }

    /**
     * @covers  Doctor
     */
    public function testShiftDurationCannotBeDifferentThanSix()
    {
        $this->assertEquals(6, $this->doctor->getShiftDurationTime());
    }

    /**
     * @covers  Doctor
     */
    public function testRemainingWorkHoursForWeekdayAndInjurySubmittedAtShiftStart()
    {
        //A Monday
        $weekday = Datetime::createFromFormat("Y-m-d h:i a", "2015-05-11 10:00 am");
        $this->assertEquals(6, $this->doctor->getRemainingWorkHours($weekday));
    }

    /**
     * @covers  Doctor
     */
    public function testRemainingWorkHoursForWeekdayAndInjurySubmittedBeforeShiftStart()
    {
        //A Monday
        $weekday = Datetime::createFromFormat("Y-m-d h:i a", "2015-05-11 08:00 am");
        $this->assertEquals(6, $this->doctor->getRemainingWorkHours($weekday));
    }

    /**
     * @covers  Doctor
     */
    public function testRemainingWorkHoursForWeekdayAndInjurySubmittedAfterShiftStart()
    {
        //A Monday
        $weekday = Datetime::createFromFormat("Y-m-d h:i a", "2015-05-11 01:00 pm");
        $this->assertEquals(3, $this->doctor->getRemainingWorkHours($weekday));
    }

    /**
     * @covers  Doctor
     */
    public function testRemainingWorkHoursForWeekend()
    {
        //A Sunday
        $weekend = Datetime::createFromFormat("Y-m-d h:i a","2015-05-10 10:00 am");
        $this->assertEquals(0, $this->doctor->getRemainingWorkHours($weekend));
    }

}