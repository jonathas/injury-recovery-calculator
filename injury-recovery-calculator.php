<?php

require_once 'vendor/autoload.php';
require_once 'lib/functions.php';
require_once 'classes/InjuryRecoveryCalculator.php';

try {

    if (PHP_SAPI === 'cli')
    {
        $argument1 = (isset($argv[1])) ? $argv[1] : "";
        $argument2 = (isset($argv[2])) ? $argv[2] : "";
    }
    elseif(isset($_POST))
    {
        $argument1 = (isset($_POST['startTime'])) ? $_POST['startTime'] : "";
        $argument2 = (isset($_POST['hoursNeeded'])) ? $_POST['hoursNeeded'] : "";
    }

    $args = validateParameters($argument1, $argument2);

    $irc = new InjuryRecoveryCalculator();

    print $irc->calculateRecoveryDate($args[0], $args[1]);

} catch (Exception $e) {
    print $e->getMessage();
}