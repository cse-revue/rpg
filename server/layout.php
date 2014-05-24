<?
include_once("nemo/anemone.php");
include_once("nemo/lavatube.php");
include_once("nemo/blackness.php");
include_once("nemo/caveentrance.php");
include_once("nemo/oceanfloor.php");
include_once("nemo/reef.php");
include_once("nemo/shipwreck.php");
include_once("nemo/shiproom.php");

include_once("nemo/cave1.php");
include_once("nemo/cave2.php");
include_once("nemo/cave3.php");
include_once("nemo/cave4.php");
include_once("nemo/cave5.php");
include_once("nemo/cave6.php");
include_once("nemo/cave7.php");
include_once("nemo/cave8.php");
include_once("nemo/cave9.php");
include_once("nemo/cave10.php");
include_once("nemo/cave11.php");
include_once("nemo/cave12.php");
include_once("nemo/cave13.php");
include_once("nemo/cave14.php");

# Create room objects
$anemone = new Anemone();
$blackness = new Blackness();
$caveentrance = new CaveEntrance();
$oceanfloor = new OceanFloor();
$reef = new Reef();
$lavatube = new LavaTube();
$shipwreck = new ShipWreck();
$shiproom = new ShipRoom();

$cave1 = new Cave1();
$cave2 = new Cave2();
$cave3 = new Cave3();
$cave4 = new Cave4();
$cave5 = new Cave5();
$cave6 = new Cave6();
$cave7 = new Cave7();
$cave8 = new Cave8();
$cave9 = new Cave9();
$cave10 = new Cave10();
$cave11 = new Cave11();
$cave12 = new Cave12();
$cave13 = new Cave13();
$cave14 = new Cave14();

# Declare list of rooms
$room_array = array(
    $anemone,
    $blackness,
    $caveentrance,
    $reef,
    $lavatube,
    $shipwreck,
    $shiproom,
    $oceanfloor,
    $cave1,
    $cave2,
    $cave3,
    $cave4,
    $cave5,
    $cave6,
    $cave7,
    $cave8,
    $cave9,
    $cave10,
    $cave11,
    $cave12,
    $cave13,
    $cave14
);

# Declare connections between rooms and locked connections
$anemone->double_connect("up", $reef);
$reef->double_connect("south", $oceanfloor);
$reef->double_connect("north", $blackness);
$blackness->connect("down", $oceanfloor);
$oceanfloor->connect("up", $blackness);
$oceanfloor->connect("west", $caveentrance);
$caveentrance->connect("east", $oceanfloor);
$caveentrance->connect("north", $lavatube);
$lavatube->connect("south", $caveentrance);
$lavatube->connect("east", $reef);
$reef->connect("west", $lavatube);
$reef->double_connect("east", $shipwreck);

$caveentrance->double_connect("south", $cave1);
$cave1->double_connect("west", $cave2);
$cave1->double_connect("east", $cave3);
$cave3->double_connect("east", $cave4);
$cave4->connect("east", $cave4);
$cave4->connect("west", $cave5);
$cave5->double_connect("west", $cave6);
$cave6->double_connect("west", $cave7);
$cave6->double_connect("south", $cave9);
$cave7->connect("north", $reef);
$cave8->double_connect("west", $cave9);
$cave8->connect("north", $cave5);
$cave9->double_connect("south", $cave12);
$cave11->connect("north", $cave8);
$cave11->connect("up", $shipwreck);
$cave11->double_connect("west", $cave12);
$cave12->double_connect("west", $cave13);
$cave13->double_connect("north", $cave10);
$cave13->double_connect("down", $cave14);



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
