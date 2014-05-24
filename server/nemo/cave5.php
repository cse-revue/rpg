<?
include_once('room.php');

class Cave5 extends Room {
    public $name = "Lifeless Cavern";
    public $id = "cave5";
	
    public $description = <<<EOT
An open cavern, lifeless but soothing in its smoothness and stillness, undisturbed by time.
Your arrival disturbed the stillness and caused mud to fall and block up one eastern passage.
There is an open tunnel to the West.
EOT
;
}
