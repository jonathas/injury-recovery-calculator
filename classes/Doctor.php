<?php

class Doctor {

    private $shiftStartTime;
    private $shiftEndTime;
    private $shiftDurationTime;

    public function __construct()
    {
        $this->shiftStartTime = DateTime::createFromFormat('h:i a', '10:00 am');
        $this->shiftEndTime = DateTime::createFromFormat('h:i a', '04:00 pm');
        $diff = $this->shiftEndTime->diff($this->shiftStartTime);
        $this->shiftDurationTime = $diff->h - 1;
    }

    /**
     * Returns remaining work hours today for a given dateTime
     * @param DateTime $dateTime
     * @throws Exception
     * @return int
     */
    public function getRemainingWorkHours(DateTime $dateTime)
    {
        if($dateTime < $this->shiftStartTime)
        {
            return $this->shiftDurationTime;
        }
        else
        {
            $diff = $this->shiftEndTime->diff($dateTime);
            return $diff->h - 1;
        }
    }

}