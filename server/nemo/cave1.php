<?
include_once('room.php');

class Cave1 extends Room {
    public $name = "A boring rock";
    public $id = "cave1";
	
    public $description = <<<EOT
A boring, rocky covered place. Nothing interesting to look at.
Exit passageways are to the North, East and West.
EOT
;
}
