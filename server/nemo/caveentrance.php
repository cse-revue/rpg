<?
include_once('room.php');

class CaveEntrance extends Room {
    public $name = "Cave Entrance";
    public $id = "caveentrance";
    public $description = <<<EOT
There is a hole in a rock face to the south.
The water to the north feels warmer.
A vast desert extends to the east.
EOT
;

}
