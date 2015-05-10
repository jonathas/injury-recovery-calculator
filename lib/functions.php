<?php

/**
 * Returns if the dateTime is valid according to the 12 hour format
 * @param $startDateTime
 * @return bool
 */
function isDateValid($startDateTime)
{
    $dateTime = DateTime::createFromFormat("Y-m-d h:i a", $startDateTime);
    if (true === ($dateTime && $dateTime->format("Y-m-d h:i a") == $startDateTime))
        return true;

    return false;
}
