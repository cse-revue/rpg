<?

$flags = null;

function init_flags() {
    global $flags;
    
    if (!isset($_SESSION['flags'])) {
        $_SESSION['flags'] = array();
    }

    $flags = $_SESSION['flags'];
}

function set_flag($flag) {
    global $flags;
    $flags[$flag] = true;
}

function clear_flag($flag) {
    global $flags;
    unset($flags[$flag]);
}

function test_flag($flag) {
    global $flags;
    return isset($flags[$flag]);
}

function save_flags() {
    global $flags;
    $_SESSION['flags'] = $flags;
}
