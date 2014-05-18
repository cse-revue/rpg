<?

$inventory = null;

function init_inventory() {
    global $inventory;
    
    if (!isset($_SESSION['inventory'])) {
        $_SESSION['inventory'] = array();
    }

    $inventory = $_SESSION['inventory'];
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
    $_SESSION['inventory'] = $inventory;
}
