<?
include_once('room.php');
include_once('inventory.php');


class Landing extends Room {
    public $name = "Landing at top of stairs";
    public $id = "landing";
    public $description = <<<EOT
There is a staircais going down.
There are doors to the north, east, south and west.
EOT
;


    public function unlock_test($ex) {
        $ret = "";
        switch ($ex) {
        case "east":
            if (inventory_has_item("key")) {
                $ret .= "Door unlocked with fridge key!\n";
                $this->unlock("east");
            }
        }
        
        return $ret;
    }
}
