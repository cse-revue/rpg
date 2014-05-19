<?
include_once('room.php');
include_once('inventory.php');

class Bathroom extends Room {
    public $name = "Bathroom";
    public $id = "bathroom";
    public $description = <<<EOT
A damp, rotting smell invades your nostrels. You somehow get the feeling that you are unsafe here.
There is a door to the east.
EOT
;

    public function on_enter() {
        if (inventory_has_item('milk')) {
            echo nl2br(htmlspecialchars(<<<EOT
The spoilt milk you are carrying has attracted a grue.
You are eaten by the grue.
You die.


Restarting...
EOT
));
            session_destroy();
            exit;
        }
    }
}
