<?
include_once('room.php');

class StevesRoom extends Room {
    public $name = "Steve's Room";
    public $id = "steves_room";
    public $description = <<<EOT
This room is a mess, but you feel at home anyway.
There is a door to the aft.
EOT
;

}
