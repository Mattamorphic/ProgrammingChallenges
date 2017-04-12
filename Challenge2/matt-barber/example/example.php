<?hh

include 'vendor/autoload.php';
use mfmbarber\HackSla\SupportTicket;

$date1 = DateTime::createFromFormat('d/m/Y H:i:s', '05/03/2017 08:00:00');
$date1->setTimezone(new DateTimeZone('Asia/Singapore'));
$date2 = DateTime::createFromFormat('d/m/Y H:i:s', '16/03/2017 10:00:00');
$ticket = new SupportTicket($date1, 9);
echo ($ticket->checkSLA($date2)) ? "OK" : "NOT OK";
