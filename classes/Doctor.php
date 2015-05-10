<?php

class Doctor {

    private $shiftStartTime = "10:00 am";
    private $shiftEndTime = "04:00 pm";
    private $shiftStartDateTime;
    private $shiftEndDateTime;
    private $shiftDurationTime;

    public function __construct()
    {
        $this->setShiftDate(DateTime::createFromFormat("Y-m-d h:i a", date('Y-m-d h:i a')));
    }

    /**
     * @param DateTime $dateTime
     */
    public function setShiftDate(DateTime $dateTime)
    {
        $startDateTime = $dateTime->format('Y-m-d') . ' ' . $this->shiftStartTime;
        $endDateTime = $dateTime->format('Y-m-d') . ' ' . $this->shiftEndTime;

        $this->shiftStartDateTime = DateTime::createFromFormat('Y-m-d h:i a', $startDateTime);
        $this->shiftEndDateTime = DateTime::createFromFormat('Y-m-d h:i a', $endDateTime);

        $diff = $this->shiftEndDateTime->diff($this->shiftStartDateTime);
        $this->shiftDurationTime = $diff->h;
    }

    /**
     * Returns remaining work hours today for a given dateTime
     * @param DateTime $dateTime
     * @return int
     */
    public function getRemainingWorkHours(DateTime $dateTime)
    {
        //0 => Sunday, 6 => Saturday
        if($dateTime->format('w') == 0 || $dateTime->format('w') == 6)
        {
            return 0;
        }

        $this->setShiftDate($dateTime);

        if($dateTime <= $this->shiftStartDateTime)
        {
            return $this->shiftDurationTime;
        }
        else
        {
            $diff = $this->shiftEndDateTime->diff($dateTime);
            return $diff->h;
        }
    }

    /**
     * @return int
     */
    public function getShiftDurationTime()
    {
        return $this->shiftDurationTime;
    }

}