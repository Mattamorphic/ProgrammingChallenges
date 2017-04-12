<?hh
/**
 * A file in the HackMorseCode library
 *
 * @author Matt Barber <mfmabarber@gmail.com>
 * @category class
**/
namespace mfmbarber\HackMorseCode\Tests;

use PHPUnit\Framework\TestCase;
use mfmbarber\HackMorseCode\MorseCode;

/**
 * Test suite for the MorseCode::class
 *
 * @author Matt Barber <mfmabarber@gmail.com>
 * @category class
**/
class TestMorseCode extends TestCase
{
  private MorseCode $mc;

  public function __construct() {
    $this->mc = new MorseCode();
  }

  /**
   * Test conversion to Morse
  **/
  public function testToMorse() : void {
    $this->assertEquals('... --- ...', $this->mc->convert('sos'));
  }

  /**
   * Test conversion to String
  **/
  public function testToString() : void {
    $this->assertEquals('sos', $this->mc->convert('... --- ...'));
  }
}
