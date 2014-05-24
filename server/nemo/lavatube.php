<?
include_once('room.php');

class LavaTube extends Room {
    public $name = "Lava Tube";
    public $id = "lavatube";
    public $description = <<<EOT
The water is warm here. Bubbles spew from a submerged lava tube.
Beside a rock, you see an old chest with a rusty padlock.
To the east you see a reef.
EOT
;

    public function init() {
        $this->verbs["open"] = function($rest) {
            switch($rest[0]) {
            case "chest":
                if (inventory_has_item("key1") or inventory_has_item("key2")) {
                    echo "You open the chest. You find Nemo!";
                    restart();
                    return;
                } else {
                    return "The chest is locked.";
                }

            default:
                return null;
            }
        };
    }

}
