/**
 * @function
 * Non-regexy way of validating date/time format, i.e. 10-02-2017 14:00:00
 * @params { String } - The date string.
 * @returns { Boolean } - Does it follow the right convention?
 */
function validateDateString(dateString) {
  const errorMsg = `${dateString} needs to be in the format: DD-MM-YYYY HH:MM:SS`
  if (dateString.length !== 19) {
    throw new Error(errorMsg)
  }
  let stringIndex = 0
  while (stringIndex !== dateString.length) {
    let char = dateString.charAt(stringIndex)
    switch (stringIndex) {
      case 2: case 5:
        if (char !== '-')
          throw new Error(errorMsg)
        break;
      case 13: case 16:
        if (char !== ':')
          throw new Error(errorMsg)
      default:
        if (typeof parseInt(char) !== 'number')
          throw new Error(errorMsg)
    }
    stringIndex++
  }
}

/**
 * @function
 * Convert the date string into an array of arguments
 * for the date constructor.
 * @params { String } - The date string.
 * @params { String } - The delimiter.
 * @returns { Array } - Array of date arguments.
 */
function getDateArguments(dateString, delimiter) {
  let time = dateString
    .split(' ')[1]
    .split(':')
    .map((d) => parseInt(d))
  let date = dateString
    .split(delimiter)
    .reverse()
    .map((d, i) => i === 1 ? parseInt(d) - 1 : parseInt(d))
  return date.concat(time)
}

/**
 * @function
 * Convert date using a given timezone.
 * @params { Date } - The date object.
 * @returns { Date } - Converted date object using timezone.
 */
function convertDateToTimezone(date, timeZone) {
  let converted = date.toLocaleString('en-GB', { timeZone: timeZone } )
  let dateArgs = getDateArguments(converted.split(',').join(''), '/')
  return new Date(...dateArgs)
}

/**
 * @function
 * Convert the date string to a date object
 * @params { String } - The date string.
 * @returns { Date } - The date object
 */
function convertToDate(dateString, timeZone) {
  validateDateString(dateString)
  let dateArgs = getDateArguments(dateString, '-')
  let dateObj = new Date(...dateArgs)
  return timeZone !== undefined ? convertDateToTimezone(dateObj, timeZone) : dateObj
}

/**
 * @function
 * Find how many days are between two dates
 * @params { Date } - The first date
 * @params { Date } - The second date
 * @returns { Number } - The number of days between dates
 */
function daysBetweenDates(first, second, hoursInDay) {
  const DAY = 1000 * 60 * 60 * hoursInDay
  return Math.round((+second - +first) / DAY)
}

/**
 * @function
 * Check whether the date is a specified day
 * @params { Array } - The days to be checked against
 * @params { Date } - The date
 * @returns { Boolean } - Is date a specified day?
 */
function isDay(days, date) {
  const DAYS = { 
    'sunday': 0, 'monday': 1, 'tuesday': 2, 'wednesday': 3,
    'thursday': 4, 'friday': 5, 'saturday': 6
  }
  return days.map(d => DAYS[d]).includes(date.getDay())
}

/**
 * @function
 * Check whether a ticket has passed its SLA.
 * @params { Date } - The date the ticket was created.
 * @params { Date } - The date the ticket was completed.
 * @params { Number } - The number of days for the SLA.
 * @params { Array } - The days of the week to exclude.
 * @params { Number } - The hours in the working day.
 * @returns { Boolean } - Whether the ticket has passed its SLA.
 */
function failedSLA({
  created,
  end, 
  range,
  hoursInDay = 24,
  excludeDays = [ 'saturday', 'sunday' ],
  timeZone
}) {
  
  created = convertToDate(created, timeZone.startZone)
  end = convertToDate(end, timeZone.endZone)
  
  if (created >= end) {
    throw new Error('Start date must be before end date.')
  }  
  
  let index = daysBetweenDates(created, end, hoursInDay)
  let days = index
	
  while (index !== 0) {
    // Remove days if current date falls within excluded 
    // days (i.e. weekends)
    if (isDay(excludeDays, created)) {
      days--
    }
    
    created.setDate(created.getDate() + 1)
    index--    
  }
  
  return days >= range
}

module.exports = failedSLA