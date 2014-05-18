<?
include_once("rooms/foyer.php");
include_once("rooms/landing.php");
include_once("rooms/living_room.php");
include_once("rooms/kitchen.php");
include_once("rooms/steves_room.php");

$foyer = new Foyer();
$landing = new Landing();
$living_room = new LivingRoom();
$kitchen = new Kitchen();
$steves_room = new StevesRoom();

$room_array = array(
    $foyer,
    $landing,
    $living_room,
    $kitchen,
    $steves_room
);


$foyer->connect("up", $landing);
$landing->connect("down", $foyer);
$landing->lock("north");
$landing->lock("east", "This door is locked. A sign on the door says \"look in the crisper\".");
$landing->lock("south");
$landing->lock("west");

$foyer->connect("left", $living_room);
$living_room->connect("aft", $foyer);
$living_room->connect("fore", $kitchen);
$kitchen->connect("aft", $living_room);
$landing->connect("east", $steves_room);
$steves_room->connect("west", $landing);

$rooms = array();
foreach ($room_array as $room) {
    $rooms[$room->id] = $room;
}

function init_rooms() {
    global $room_array;

    foreach ($room_array as $room) {
        $room->init();
    }
}
