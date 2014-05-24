<?
include_once('room.php');

class Cave14 extends Room {
    public $name = "Nemo room";
    public $id = "cave14";
	
    public $description = <<<EOT
"What?! How'd you find this room! It wasn't even in the room description!"
Exclaimed the narrator, who you find sitting in a reclining chair, 
surrounded by video screens of his face.

"Well done. You deserve a reward."
!
Found Nemo :)
EOT
;

    public function on_enter() {
        echo nl2br($this->description);
        restart();
    }
}
