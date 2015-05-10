<?php

require_once 'classes/InjuryRecoveryCalculator.php';

if (PHP_SAPI === 'cli')
{
    $argument1 = (isset($argv[1])) ? $argv[1] : "";
    $argument2 = (isset($argv[2])) ? $argv[2] : "";
}
else
{
    $argument1 = (isset($_POST['startTime'])) ? $_POST['startTime'] : "";
    $argument2 = (isset($_POST['hoursNeeded'])) ? $_POST['hoursNeeded'] : "";
}

if($argument1 === "" || $argument2 === "")
{
    die(print "Please inform a time using a 12 hour time format, like for example 07:00 pm and the amount of hours needed for the treatment\n");
}

$calc = new InjuryRecoveryCalculator();
print $calc->calculateRecoveryDate($argument1, $argument2);
