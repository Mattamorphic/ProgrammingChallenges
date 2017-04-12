<?hh
/**
 * A file in the morse code conversion library
 * @author Matt Barber <mfmbarber@gmail.com>
 * @category class
**/
namespace mfmbarber\HackMorseCode;

/**
 * Class to behave as a two way map, keys and values
 *
 * @author Matt Barber <mfmabarber@gmail.com>
 * @category Class
**/
class TwoWayMap //implements MutableMap
{
  // Our different maps
  private Map<arraykey, arraykey> $a;
  private Map<arraykey, arraykey> $b;

  // Our counter
  private int $count;

  /**
   * Upon instantiation set our base maps
   *
   * @param ?array<arraykey> $a One half
   * @param ?array<arraykey> $b Other half
  **/
  public function __construct(?array<arraykey> $a, ?array<arraykey> $b) {
      // If null, just base maps
      if (!$a && !$b) {
        $this->a = Map {};
        $this->b = Map {};
        $this->count = 0;
        return;
      }
      // Make sure they are the same size
      // TODO : Make a bit more flexible - in fill with null?
      $this->count = count($a);
      if ($this->count !== count($b)) {
        throw new \Exception("Both arrays must have the same amount of values");
      }
      $this->a = new Map(array_combine($a, $b));
      $this->b = new Map(array_combine($b, $a));
  }

  /**
   * Get a value based on a key, check a first, throw an exception if not found
   *
   * @param arraykey $key The key to search for
   *
   * @return arraykey
  **/
  public function get(arraykey $key) : arraykey {
    if ($v = $this->a->get($key)) {
      return $v;
    }
    return $this->b->at($key);
  }

  /**
   * Remove a pair from the two way map
   *
   * @param arraykey $key The key to remove
   *
   * @return void
  **/
  public function remove(arraykey $key) : void {
    if ($v = $this->a->get($key)) {
      $this->a->remove($key);
      $this->b->remove($v);
    } else if ($v = $this->b->at($key)) {
      $this->b->remove($key);
      $this->a->remove($v);
    }
  }

  /**
   * Add a new pairing to the map
   *
   * @param Pair<arraykey, arraykey> $p The pair to add
   *
   * @return void
  **/
  public function add(Pair<arraykey, arraykey> $p) : void {
    ++$this->count;
    $this->a->add($p);
    $this->b->set($p->lastValue(), $p->firstValue());
  }

  /**
   * Get a count of the currnet size of the map
   *
   * @return int
  **/
  public function count() : int {
    return $this->count();
  }

}
