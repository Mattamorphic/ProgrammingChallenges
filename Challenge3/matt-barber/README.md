# Morse Converter (Challenge 3) #

MorseCode converter uses a custom two way map class, that allows for maps with keys as values and values as keys

## Motivation ##
I've been learning the Hack programming language, and the Hip Hop Virtual Machine (HHVM) - so seemed like a good excuse to make something usable.

## Dependancies ##

- This was written using HHVM v3.18, it's probably backwards compatible to a degree though
- PHPUnit 5.7.* - There isn't compatibility with HHVM above this yet


## Installation ##

Copy this project, then run composer install from the root of this project

## Usage ##
There is 1 method in the MorseCode class that is documented in the string convert interface

```
/**
 * Convert a string to a different string (infer the type in both directions)
 *
 * @param string $s The string to convert
 *
 * @return string
**/
public function convert(string $s) : string;

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
