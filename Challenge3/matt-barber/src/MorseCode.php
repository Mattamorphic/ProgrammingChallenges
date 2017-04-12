<?hh
/**
 * A file in the HackMorseCode library
 *
 * @author Matt Barber <mfmbarber@gmail.com>
 * @category class
**/
namespace mfmbarber\HackMorseCode;

/**
 * The primary class for the Morse Code library
 *
 * @author Matt Barber <mfmbarber@redweb.com>
 * @category class
**/
final class MorseCode implements StringConvertInterface
{
  private TwoWayMap $ref;

  /**
   * Upon instantiation build the two way map
   *
   * @return void
  **/
  public function __construct() {
    $this->ref = new TwoWayMap(
      [97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 32],
      ['.-', '-...', '-.-.', '-..', '.', '..-.', '--.', '....', '..', '.---', '-.-', '.-..', '--', '-.', '---', '.--.', '--.-', '.-.', '...', '-', '..-', '...-', '.--', '-..-', '-.--', '--..', ' ']
    );
  }

  /**
   * Convert a string to a morse reference, or back to a string
   *
   * @param string $s The string to convert
   *
   * @return string
  **/
  public function convert(string $s) : string {
    if ($this->isMorse($s)) {
      return $this->toString($s);
    }
    return $this->toMorse(strtolower($s));
  }

  /**
   * Private: Check if a string isMorse or not
   *
   * @param string $s The string to test against
   *
   * @return bool
  **/
  private function isMorse(string $s) : bool {
    return (preg_match('/^[\.|\ |\-]*$/', $s) > 0);
  }

  /**
   * Private: Convert a morse string to a string
   *
   * @param string $s The string to convert
   *
   * @return string
  **/

  private function toString(string $s) : string {
    $v = new Vector(explode(' ', $s));
    return implode('', $v->map($l ==> chr((int)$this->ref->get($l)))->toArray());
  }

  /**
   * Private: Convert an ascii string to morse
   *
   * @param string $s The string to convert
   *
   * @return string
  **/
  private function toMorse(string $s) : string {
    $v = new Vector(str_split($s));
    return implode(' ', $v->map($l ==> $this->ref->get(ord($l)) ?? '')->toArray());
  }
}
