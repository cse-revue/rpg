<?
include_once('room.php');

class Cave3 extends Room {
    public $name = "Point of no return";
    public $id = "cave3";
	
    public $description = <<<EOT
A dark, foreboding passageway. It gives off the feeling that there's no way back, only forward.
There is a tunnel leading through from the West to the East.
EOT
;
}