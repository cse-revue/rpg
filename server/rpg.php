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
    $_SESSION['room'] = 'anemone';
    init_room_inventory($all_rooms);
}

$i->room = $all_rooms[$_SESSION['room']];

if (isset($_POST['input'])) {
    $output = $i->interpret($_POST['input']);
    if ($output == null) {
        $output = "I don't know how to do that.";
    }
    echo nl2br(htmlspecialchars($output));
} else {
    startup_text();
}


save_flags();
save_inventory();

function startup_text() {
    global $i;

    echo nl2br(htmlspecialchars(sprintf(<<<EOT
Ctrl+F Nemo

%s
%s
EOT
, $i->help(), $i->look())));
 
}

function restart() {
    global $all_rooms;
    global $i;

    session_destroy();
    $_SESSION['room'] = 'anemone';
    $i->room = $all_rooms[$_SESSION['room']];
    init_room_inventory($all_rooms);

    echo nl2br(htmlspecialchars($i->look()));
    exit;
}

?>
