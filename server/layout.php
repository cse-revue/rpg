<?
include_once("rooms/foyer.php");
include_once("rooms/landing.php");
include_once("rooms/living_room.php");
include_once("rooms/kitchen.php");
include_once("rooms/steves_room.php");
include_once("rooms/bathroom.php");

# Create room objects
$foyer = new Foyer();
$landing = new Landing();
$living_room = new LivingRoom();
$kitchen = new Kitchen();
$steves_room = new StevesRoom();
$bathroom = new Bathroom();

# Declare list of rooms
$room_array = array(
    $foyer,
    $landing,
    $living_room,
    $kitchen,
    $steves_room,
    $bathroom
);

# Declare connections between rooms and locked connections
$foyer->connect("up", $landing);
$landing->connect("down", $foyer);
$landing->lock("north");
$landing->lock("east", "This door is locked. A sign on the door says \"look in the crisper\".");
$landing->lock("south");
$foyer->connect("left", $living_room);
$living_room->connect("aft", $foyer);
$living_room->connect("fore", $kitchen);
$kitchen->connect("aft", $living_room);
$landing->connect("east", $steves_room);
$steves_room->connect("west", $landing);
$landing->connect("west", $bathroom);
$bathroom->connect("east", $landing);

$all_rooms = array();
foreach ($room_array as $room) {
    $all_rooms[$room->id] = $room;
}

function init_rooms() {
    global $room_array;
    foreach ($room_array as $room) {
        $room->init();
    }
}
