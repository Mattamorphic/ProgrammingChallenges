<?hh
/**
 * A file in the HackSla Project
 *
 * @author Matt Barber <mfmabarber@gmail.com>
**/
namespace mfmbarber\HackSla;
/**
 * Interface that ticket classes must implement
 *
 * @category Interface
 * @package HackSla
 * @author Matt Barber <mfmbarber@gmail.com>
**/
interface TicketInterface
{
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
}
