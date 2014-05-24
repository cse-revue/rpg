<?
include_once('room.php');

class Cave10 extends Room {
    public $name = "Eldrich Sh(r)ine";
    public $id = "cave10";
    public $description = <<<EOT
An eldrich glow lights this dead end
There is a pile of rocks, almost looking like a fish-god altar with a golden unlocking device resting upon it
There is a dark tunnel to the South
EOT
;


    public function init() {

        $this->verbs = array(
            "take" => function($rest) {
                switch ($rest[0]) {
                    case "golden":
					case "unlocking":
                    case "key":
                        if (test_flag('taken_key2')) return "The key is no longer there.";
                        set_flag('taken_key2');
                        inventory_add_item('key2', "");
                        return "You take the key.";
                     default: return null;
                 }
 
            },
            "examine" => function($rest) {
                 switch ($rest[0]) {
                     case "rocks": 
                         $str = "It contains:\n";
                         if (!test_flag('taken_key')) {
                             $str .= "One Golden Unlocking Device";
                         }
                         return $str;
 
                     default:
                         return null;
                }
 
            }
        );


    }
}
