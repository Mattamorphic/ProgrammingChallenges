# SLA Checker (Challenge 2) #

This SLA checker is implemented in Hack and uses abstraction to make it easily extendable

## Motivation ##
I've been learning the Hack programming language, and the Hip Hop Virtual Machine (HHVM) - so seemed like a good excuse to make something usable.

## Dependancies ##

- This was written using HHVM v3.18, it's probably backwards compatible to a degree though
- PHPUnit 5.7.* - There isn't compatibility with HHVM above this yet


## Installation ##

Copy this project, then run composer install from the root of this project

## Usage ##
There are 3 methods as specified in the TicketInterface currently these are documented as follows:

```
/**
 * Get the current SLA as an integer
 *
 * @return int
**/
public function getSLA() : int;

/**
 * Set the curent SLA property
 *
 * @param int $days The days the SLA runs for
 *
 * @return void
**/
public function setSLA(int $days) : void;

/**
 * Check the SLA against a valid date time object
 *
 * @param DateTime $date The date to check against
 *
 * @return bool
**/
public function checkSLA(\DateTime $date) : bool;
```

## Tests ##

Tests have been written using PHPUnit, and can be run from the root of the project:
```
$ hhvm vendor/bin/phpunit tests/
```

## Contributing ##

To contribute to this project

- Create a fork of the project
- Create a feature/bugfix branch off of develop
- Commit your changes
- Write your tests
- Once you are happy - PR back into develop
- Once reviewed, the PR is accepted.
- Hurrah!

Ensure you comment your code!

## License ##
This project is fully open sourced under MIT license
