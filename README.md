Injury recovery calculator
==========================

[![Build Status](https://travis-ci.org/jonathas/injury-recovery-calculator.svg?branch=master)](https://travis-ci.org/jonathas/injury-recovery-calculator)

A football player needs t hours to recover from an injury. For a full recovery, he needs to receive t hours of special treatment from the team’s doctor. A user can submit new injuries to the application, which then calculates the exact date and time the player will be able to play again.

The rules
---------

- The doctor works from 10AM to 4PM.

- The doctor only works on regular working days (Monday to Friday). For simplicity's sake, you should not deal with holidays, so only weekends are considered off days.

- The needed recovery time is always provided in hours. It tells how many hours of treatment is needed until the player can be considered recovered.

- A treatment can only be started during the doctor’s working hours.

- If the doctor is out of office at the time of submission, he will start the treatment at the beginning of the next working day.

For instance, if a treatment starts at 11:04AM on Thursday and it takes 10 hours to finish the treatment, the recovery date will be 03:04PM on Friday.

The task
---------

Implement the calculateRecoveryDate method. It takes the start time and the hours of treatment needed, and returns the date and time of full recovery.

Try to avoid using a library that is not part of the language.

A unit tested solution is preferred.

Instructions
------------

Install the dependencies: composer install

Run the tests: php vendor/bin/phpunit tests

Ways to run the project: 

1) php injury-recovery-calculator.php '10:00 am' 10

2) php -S localhost:8080