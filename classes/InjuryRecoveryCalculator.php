<?php

require_once 'lib/functions.php';
require_once 'Doctor.php';

class InjuryRecoveryCalculator {

    /**
     * Takes the start time and the hours of treatment needed,
     * and returns the date and time of full recovery.
     * @param $startTime
     * @param $hoursNeeded
     * @return string
     */
    public function calculateRecoveryDate($startTime, $hoursNeeded)
    {
        try
        {
            //Here's our doctor
            $doc = new Doctor();
            $startDateTime = date('Y-m-d') . " " . $startTime;
            $dateTime = DateTime::createFromFormat("Y-m-d h:i a", $startDateTime);

            if(isDateValid($startDateTime) === false)
            {
                throw new Exception("The informed time is invalid. Please inform a time using a 12 hour time format, like for example 07:00 pm\n");
            }

            //Ensure $hoursNeeded is numeric and > 0
            if(!ctype_digit((string) $hoursNeeded) || $hoursNeeded <= 0) {
              throw new Exception("Please inform an amount of hours needed\n");
            }

            while($hoursNeeded > 0)
            {
                //0 => Sunday, 6 => Saturday
                if($dateTime->format('w') == 0 || $dateTime->format('w') == 6) {
                    //The doctor won't work on weekends
                    $dateTime->add(new DateInterval('P1D'));
                    continue; //Ok, let's go to the next day
                }

                $remainingToday = $doc->getRemainingWorkHours($dateTime);

                //The doctor has more hours today than what we need
                if($remainingToday > $hoursNeeded)
                {
                    $dateTime->add(new DateInterval('PT' . $hoursNeeded . 'H'));
                    $hoursNeeded = 0;
                }
                else
                {
                    $dateTime->add(new DateInterval('PT' . $remainingToday . 'H'));
                    $hoursNeeded -= $remainingToday;
                }

            }

            return $dateTime->format("h:i a \\o\\n l, F jS Y") . "\n";
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

}