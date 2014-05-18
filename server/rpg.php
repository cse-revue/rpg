<?
include_once('layout.php');
include_once('interpreter.php');
include_once('flags.php');
include_once('inventory.php');

$i = new Interpreter();
session_start();

if (!isset($_SESSION['room'])) {
    $_SESSION['room'] = 'foyer';
}

init_flags();
init_inventory();
init_rooms();

$i->room = $rooms[$_SESSION['room']];

echo nl2br(htmlspecialchars($i->interpret($_POST['input'])));

save_flags();
save_inventory();
?>
