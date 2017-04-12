<?hh
/**
 * A file in the HackSla Project
 *
 * @author Matt Barber <mfmabarber@gmail.com>
**/
namespace mfmbarber\HackSla;
/**
 * A support ticket
 *
 * @category Class
 * @package HackSla
 * @author Matt Barber <mfmbarber@gmail.com>
**/
final class SupportTicket extends AbstractTicket
{

  /**
   * Check the SLA against a valid date time object
   *
   * @param DateTime $date The date to check against
   *
   * @return bool
  **/
  public function checkSLA(\DateTime $date) : bool {
    // Add the timezone offset to the date, if checking in a different timezone
    $this->updateDate($date, $this->generateOffset($date));
    $date->setTimezone(new \DateTimeZone(self::TIMEZONE));
    // Edge cases
    if ($date <= $this->createdDate) {
      throw new \InvalidArgumentException(
        'Comparison date must be later than the created date'
      );
    }
    // Get the SLA counter, clone the date, and get the interval
    $slaCounter = $this->sla;
    $interval = $this->createdDate->diff($date);
    $created = clone $this->createdDate;
    // If weeks fails the SLA, then return false
    if (false === $this->handleWeeks($created, $slaCounter, $interval->days)) {
      return false;
    }
    // Figure out the remaining days < 7
    return $this->handleDays($created, $date, $slaCounter);
  }

  /**
   * Given a date, a counter, and a total amount of days
   * Foreach week, remove 7 days from days, and 5 days from the counter
   * Update the date object, by adding the week alteration onto it
   *
   * @param DateTime $date    The date to update
   * @param int      $counter The SLA days of the week counter
   * @param int      $days    The actual count of remaining days
   *
   * @return bool
  **/
  private function handleWeeks(\DateTime &$date, int &$counter, int $days) : bool {
    while ($days > 7) {
      $counter -= 5;
      if ($counter < 0) {
        return false;
      }
      $days -= 7;
      $date->add(new \DateInterval('P7D'));
    }
    return true;
  }

  /**
   * Given a start date, and end date and a counter, iterate across the days
   * removing 1 from the counter, where the day index is not equal to saturday
   * or sunday
   *
   * @param DateTime $start   The start date for our period
   * @param DateTime $end     The end date for our period
   * @param int      $counter The counter to decrement
   *
   * @return bool
  **/
  private function handleDays(\DateTime $start, \DateTime $end, int $counter) : bool {
    $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);
    foreach ($period as $date) {
      // If it's not a weekend day - decrement the counter
      $wd = (int) $date->format('w');
      if ($wd < 6 && $wd > 0) {
          --$counter;
      }
      if ($counter < 0) {
        return false;
      }
    }
    return true;
  }

}
