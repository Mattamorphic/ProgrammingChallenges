<?hh

include 'vendor/autoload.php';

use mfmbarber\HackMorseCode\MorseCode;

$c = new MorseCode();


echo $c->convert('.... . .-.. .-.. --- .-- --- .-. .-.. -..') . "\n";
