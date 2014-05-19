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

if (isset($_POST['input'])) {
    echo nl2br(htmlspecialchars($i->interpret($_POST['input'])));
} else {
    echo nl2br(htmlspecialchars(sprintf(<<<EOT
Welcome to "Middle Earth"! Your goal is to get to Steve's room.

%s
%s
EOT
, $i->help(), $i->look())));
 
}


save_flags();
save_inventory();
?>
