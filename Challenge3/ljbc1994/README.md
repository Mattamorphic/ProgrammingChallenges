# Morse Converter (Challenge 3) #

The Morse Converter uses a single function to convert from morse code to text and vice versa. 

## Dependencies ##

- This was written using ES6 JavaScript, so you'll have to transpile using Babel to use in an ES5 environment.


## Installation ##

Copy this project, then run `npm install` from the root of this project

## Usage ##
Just import the module and away you go!

```js
import morsey from './src'

morsey('HELLO WORLD') // gives '.... . .-.. .-.. ---  .-- --- .-. .-.. -..'
morsey('.... . .-.. .-.. ---  .-- --- .-. .-.. -..') // gives 'HELLO WORLD'

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
