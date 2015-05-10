<?php

/**
 * @param   string $argument1
 * @param   string $argument2
 * @throws  InvalidArgumentException if needed arguments are not informed
 * @return  array
 */
function validateParameters($argument1 = "", $argument2 = "")
{
    if($argument1 === "" || $argument2 === "")
    {
        throw new InvalidArgumentException("Please inform a time using a 12 hour time format, like for example 07:00 pm and the amount of hours needed for the treatment\n");
    }

    return array($argument1, $argument2);
}

/**
 * Returns if the dateTime is valid according to the 12 hour format
 * @param   string  $startDateTime
 * @return  bool
 */
function isDateValid($startDateTime)
{
    $dateTime = DateTime::createFromFormat("Y-m-d h:i a", $startDateTime);
    if (true === ($dateTime && $dateTime->format("Y-m-d h:i a") == $startDateTime))
        return true;

    return false;
}
