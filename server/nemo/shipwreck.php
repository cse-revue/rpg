<?
include_once('room.php');

class Shipwreck extends Room {
    public $name = "Shipwreck";
    public $id = "shipwreck";
    public $description = <<<EOT
Resting on the ocean floor, you see the remains of a sunken ship. Text on the side reads "The Torpedo".
Examining the ship further, you notice a door on the main deck of the ship.
EOT
;
    public function init() {
        $this->verbs["open"] = function($rest) {
            switch($rest[0]) {
            case "door":
                if (inventory_has_item("key1") or inventory_has_item("key2")) {
                    set_flag("open_ship_door");
                    return "The door creaks open.";
                } else {
                    return "The door is locked.";
                }
            }
        };

        if (test_flag("open_ship_door")) {
            $this->verbs["go"] = function($rest) {
                if ($rest[0] == "in" or
                    $rest[0] == "through" or
                    array_slice($rest, 0, 2) == array("through", "door")) {
                    $_SESSION['room'] = 'shiproom';

                    return "You go through the door.";
                }
                return null;
            };

        }

    }


}
