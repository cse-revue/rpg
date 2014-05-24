<?
include_once('room.php');

class Cave12 extends Room {
    public $name = "Cave Entrance";
    public $id = "cave12";
	
    public $description = <<<EOT
An unremarkable dark, branchig cavern
An muted eldritch-glow comes from a cavern to the West
A filtered light comes from a passage to the East
A dark tunnel opens to the North
EOT
;
}