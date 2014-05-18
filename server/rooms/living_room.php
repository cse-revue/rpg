<?
include_once('room.php');

class LivingRoom extends Room {
    public $name = "Living Room";
    public $id = "living_room";
    public $description = <<<EOT
There is a table with chairs set around it.
There is a foyer to the aft.
There is a kitchen to the fore.
EOT
;

}
