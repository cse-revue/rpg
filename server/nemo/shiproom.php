<?
include_once('room.php');

class ShipRoom extends Room {
    public $name = "Ship Room";
    public $id = "shiproom";
    public $description = <<<EOT
This appears to be the old captain's quarters.
Decaying books and navigation equipment are scattered about.
On the desk is a small box.
EOT
;
    public function init() {
        $this->verbs["open"] = function($rest) {
            switch($rest[0]) {
            case "box":
                echo nl2br("You open the box. Inside you find Nemo.\nYou found Nemo!\n");
                restart();
            default:
                return null;
            }
        };

    }

}
