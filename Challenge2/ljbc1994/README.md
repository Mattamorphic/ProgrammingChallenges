# SLA Checker (Challenge 2) #

This SLA checker is implemented in JavaScript and contains just a single function.

## Dependencies ##

- The function is written in ES6 JS, you'll need to transpile using Babel if you wish to use it in an ES5 environment.

## Installation ##

Copy this project, then run `npm install` from the root of this project

## Usage ##
Just import the function and away you go! 

```js
import failedSLA from './src'

const hasFailed = failedSLA({
  created: '06-03-2017 08:00:00',
  end: '17-03-2017 10:00:00',
  range: 10,
  hoursInDay: 24,
  timeZone: {
    startZone: 'Australia/Sydney',
    endZone: 'Australia/Sydney'
  }
})

console.log(hasFailed)
```

## Tests ##

Tests have been written using Mocha/Chai, and can be run from the root of the project:
```
$ npm test
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
