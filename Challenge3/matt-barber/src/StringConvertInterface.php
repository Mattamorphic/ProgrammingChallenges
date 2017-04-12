<?hh
/**
 * A file in the HackMorseCode library
 *
 * @author Matt Barber <mfmbarber@gmail.com>
 * @category interface
**/
namespace mfmbarber\HackMorseCode;

/**
 * The interface for all string converter classes
 *
 * @author Matt Barber <mfmbarber@redweb.com>
 * @category interface
**/

interface StringConvertInterface
{
  /**
   * Convert a string to a different string (infer the type in both directions)
   *
   * @param string $s The string to convert
   *
   * @return string
  **/
  public function convert(string $s) : string;
}
