<?hh
/**
 * A file in the HackSla Project
 *
 * @author Matt Barber <mfmabarber@gmail.com>
**/
namespace mfmbarber\HackSla;
/**
 * Abstract ticket class that types of ticket extend from
 *
 * @category Abstract Class
 * @package HackSla
 * @author Matt Barber <mfmbarber@gmail.com>
**/
abstract class AbstractTicket implements TicketInterface
{
  // Base properties
  const string TIMEZONE = 'Europe/London';

  // Unfinished Functionality
  protected Map $days = Map {
    'sunday' => 0,
    'monday' => 1,
    'tuesday' => 2,
    'wednesday' => 3,
    'thursday' => 4,
    'friday' => 5,
    'saturday' => 6
  };
  protected Vector<int> $omit = Vector {};

  // Created date for the ticket
  protected \DateTime $createdDate;

  // SLA in days
  protected int $sla;

  /**
   * Upon instantiation, convert the given createdDate into a valid timezone adjusted
   * object and set the base properties
   *
   * @param DateTime $createdDate The createdDate for the ticket
   * @param int      $sla         The days for the sla as an integer
   * @param Vector   $omit        The days to omit
   *
   * @return void
  **/
  public function __construct(\DateTime $createdDate, int $sla, Vector $omit = Vector {}) {
    // Get the created timzone
    $tz = $createdDate->getTimezone();
    //Set the timezone to the default
    $createdDate->setTimezone(new \DateTimeZone(self::TIMEZONE));
    // Add the offset to the createdDate (time adjusted)
    $createdDate->add(
      \DateInterval::createFromDateString(
        (string) $tz->getOffset($createdDate) . 'seconds')
    );
    $this->createdDate = $createdDate;
    $this->sla = $sla;

    // Unfinished Functionality
    $omit->map(function ($item) {
        $id = $this->days->get(strtolower($item));
        if (null !== $id) {
          $this->omit->add($id);
        }
    });
  }

  /**
   * Get the current SLA as an integer
   *
   * @return int
  **/
  public function getSLA() : int {
    return $this->sla;
  }

  /**
   * Set the curent SLA property
   *
   * @param int $days The days the SLA runs for
   *
   * @return void
  **/
  public function setSLA(int $days) : void {
    $this->sla = $days;
  }

  /**
   * Given a date object, generate and offset between this and
   * the timezone we're in
   *
   * @param DateTime $date The date to compare
   *
   * @return int (signed)
  **/
  public function generateOffset(\DateTime $date) : int {
    return $date->getTimezone()->getOffset($this->createdDate);
  }

  /**
   * Add seconds on to a date object
   *
   * @param DateTime $date   The date object to update
   * @param int      $offset The offset in seconds
   *
   * @return void
  **/
  public function updateDate(\DateTime &$date, int $offset) : void {
    $date->add(\DateInterval::createFromDateString("$offset seconds"));
  }

  /**
   * Check the SLA against a valid date time object
   *
   * @param DateTime $date The date to check against
   *
   * @return bool
  **/
  public abstract function checkSLA(\DateTime $date) : bool;
}
