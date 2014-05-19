<?
include_once('layout.php');
include_once('interpreter.php');
include_once('flags.php');
include_once('inventory.php');

$i = new Interpreter();
session_start();

init_flags();
init_inventory();
init_rooms();

if (!isset($_SESSION['room'])) {
    $_SESSION['room'] = 'foyer';
    init_room_inventory($all_rooms);
}


$i->room = $all_rooms[$_SESSION['room']];

if (isset($_POST['input'])) {
    echo nl2br(htmlspecialchars($i->interpret($_POST['input'])));
} else {
    startup_text();
}


save_flags();
save_inventory();

function startup_text() {
    global $i;

    echo nl2br(htmlspecialchars(sprintf(<<<EOT
Welcome to "Middle Earth"! Your goal is to get to Steve's room.

%s
%s
EOT
, $i->help(), $i->look())));
 
}

function restart() {
    global $all_rooms;
    global $i;

    session_destroy();
    $_SESSION['room'] = 'foyer';
    $i->room = $all_rooms[$_SESSION['room']];
    init_room_inventory($all_rooms);

    echo nl2br(htmlspecialchars($i->look()));
    exit;
}

?>
