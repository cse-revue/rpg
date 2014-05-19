<?

$inventory = null;
$room_inventory = null;

function init_inventory() {
    global $inventory;
    global $room_inventory;
    
    if (!isset($_SESSION['inventory'])) {
        $_SESSION['inventory'] = array();
    }
        
    if (!isset($_SESSION['room_inventory'])) {
        $_SESSION['room_inventory'] = array();
    }

    $inventory = $_SESSION['inventory'];
    $room_inventory = $_SESSION['room_inventory'];
}

function init_room_inventory($rooms) {
    global $room_inventory;
    foreach ($rooms as $room) {
        $room_inventory[$room->id] = array();
    }
}

function inventory_add_item($item, $description = "") {
    global $inventory;
    $inventory[$item] = $description;
}

function inventory_set_description($item, $description) {
    global $inventory;
    $inventory[$item] = $description;
}

function inventory_remove_item($item) {
    global $inventory;
    unset($inventory[$item]);
}

function inventory_has_item($item) {
    global $inventory;
    return isset($inventory[$item]);
}

function inventory_as_array() {
    global $inventory;
    return $inventory;
}

function save_inventory() {
    global $inventory;
    global $room_inventory;
    $_SESSION['inventory'] = $inventory;
    $_SESSION['room_inventory'] = $room_inventory;
}

function room_inventory_add_item($room, $item, $description = "") {
    global $room_inventory;
    $room_inventory[$room][$item] = $description;
}

function room_inventory_remove_item($room, $item) {
    global $room_inventory;
    unset($room_inventory[$room][$item]);
}

function room_inventory_has_item($room, $item) {
    global $room_inventory;
    return isset($room_inventory[$room][$item]);
}

function take_from_room($room, $item) {
    global $room_inventory;
    global $inventory;

    assert(room_inventory_has_item($room, $item));

    inventory_add_item($item, $room_inventory[$room][$item]);
    room_inventory_remove_item($room, $item);
}

function drop_in_room($room, $item) {
    global $room_inventory;
    global $inventory;

    assert(inventory_has_item($item));

    room_inventory_add_item($room, $item, $inventory[$item]);
    inventory_remove_item($item);
}

function room_inventory_as_array($room) {
    global $room_inventory;
    return $room_inventory[$room];
}
