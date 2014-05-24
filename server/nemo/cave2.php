<?
include_once('room.php');

class Cave2 extends Room {
    public $name = "Dead end";
    public $id = "cave2";
	
    public $description = <<<EOT
A dead end, in this case literally with a skeleton in the corner.
There is an exit to the East.
EOT
;
 public function init() {

        $this->verbs = array(
            "take" => function($rest) {
                switch ($rest[0]) {
                    case "skeleton":
                        return "You can't just take a skeleton. You have to ask_out first";
                     default: return null;
                 }
 
            },
            "examine" => function($rest) {
                 switch ($rest[0]) {
                     case "skeleton": 
                         return "A decomposed skeleton. It's still wearing what looks to be a pirate-party hat";
 
                     default:
                         return null;
                }
 
            },
			"ask" => function($rest){
                if (array_slice($rest, 0, 2) == array("out", "skeleton")) {
                    return "No, you cannot ask out the skeleton. Don't even try";
                } else {
                    return "Ask what?";
				}
			}
        );
    }

}
