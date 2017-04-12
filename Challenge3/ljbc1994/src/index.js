import values from 'object.values'

/**
 * @function
 * Convert words to morse and vice versa.
 */
function morseConverter() {
  
  const letterReference = { 
    'A': '.-',       'K': '-.-',       'U': '..-',         '4': '....-',       
    'B': '-...',     'L': '.-..',      'V': '...-',        '5': '.....',
    'C': '-.-.',     'M': '--',        'W': '.--',         '6': '-....',
    'D': '-..',      'N': '-.',        'X': '-..-',        '7': '--...',
    'E': '.',        'O': '---',       'Y': '-.--',        '8': '---..',
    'F': '..-.',     'P': '.--.',      'Z': '--..',        '9': '----.',
    'G': '--.',      'Q': '--.-',      '0': '-----',       
    'H': '....',     'R': '.-.',       '1': '.----',       
    'I': '..',       'S': '...',       '2': '..---',     
    'J': '.---',     'T': '-',         '3': '...--', 
  }
  
  /**
   * @constant
   * Generate a new object flipping the key/values
   * from `letterReference`
   */
  const morseReference =  (() => {
    let keys = Object.keys(letterReference)
    let vals = values(letterReference)
    return vals.reduce((obj, val, index) => {
      obj[`"${val}"`] = keys[index]
      return obj
    }, {})
  })()
  
  /**
   * @function
   * Check whether the value contains letters
   * @params { string } The value
   * @returns { number } The number of chars that are letters
   */
  function hasLetters(value) {
    let refKeys = Object.keys(letterReference)
    return value
      .toUpperCase()
      .split('')
      .filter((char) => ~refKeys.indexOf(char))
      .length
  }
  
  /**
   * @function
   * Converts a word to morse code
   * @params { string } word
   * @returns { string } The morse code
   */
  function toMorse(word) {
    return word
      .split('')
      .map((char) => letterReference[char.toUpperCase()])
      .join(' ')
  }
  
  /**
   * Converts from morse code to words
   * @params { string } morse code
   * @returns { string } The word(s)
   */
  function fromMorse(morse) {
    return morse
      .split(' ')
      .map((char) => morseReference[`"${char}"`] || ' ')
      .join('')
  }
  
  return (val) => 
    hasLetters(val) 
    ? toMorse(val) 
    : fromMorse(val)
  
}

module.exports = morseConverter