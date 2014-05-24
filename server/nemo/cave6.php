<?
include_once('room.php');

class Cave6 extends Room {
    public $name = "Narrow passage";
    public $id = "cave6";
    public $description = <<<EOT
There is an old, rusty, abandoned fridge in the this passageway.
The passage runs from east to west, and there is a hole in the south wall.
EOT
;


    public function init() {
        
        if (test_flag('fridge_open')) {
            $this->description .= "\nThe fridge is open.";
        }

        $this->verbs = array(
            "open" => function($rest) {
                switch ($rest[0]) {
                case "fridge":
                    if (test_flag('fridge_open')) {
                        return "The fridge is already open";
                    }
                    set_flag('fridge_open');
                    return "You open the fridge.";
                default:
                    return null;
                }
            },
            "close" => function($rest) {
                switch ($rest[0]) {
                case "fridge":
                    if (!test_flag('fridge_open')) {
                        return "The fridge is already closed";
                    }
                    clear_flag('fridge_open');
                    return "You close the fridge.";
                default:
                    return null;
                }

            },
            "take" => function($rest) {
                switch ($rest[0]) {
                    case "milk":
                        if (test_flag('taken_milk')) return "The milk is no longer there.";
                        if (!test_flag('fridge_open')) return "You can't see milk.";
                        set_flag('taken_milk');
                        inventory_add_item('milk', "it smells funny. Yes, smells. Underwater. Fish have noses, too");
                        return "You take the milk.";
                    case "key":
                        if (test_flag('taken_key1')) return "The key is no longer there.";
                        if (!test_flag('fridge_open')) return "You can't see a key.";
                        set_flag('taken_key1');
                        inventory_add_item('key1', "you found this in an abandoned fridge");
                        return "You take the key.";
                     default: return null;
                 }
 
            },
            "examine" => function($rest) {
                 switch ($rest[0]) {
                     case "fridge": 
                         if (!test_flag('fridge_open')) return "It is closed.";
                         $str = "It contains:\n";
                         $fridge_empty = true;
                         if (!test_flag('taken_milk')) {
                             $fridge_empty = false;
                             $str .= "Spoilt Milk. Like, really spoilt. Like, so solid it can't dissolve in the salt water around it\n";
                         }
                         if (!test_flag('taken_key1')) {
                             $fridge_empty = false;
                             $str .= "Awesome key, say what?";
                         }
                         if ($fridge_empty) {
                             $str .= "(nothing)";
                         }
                         return $str;
 
                     default:
                         return null;
                }
 
            }
        );


    }
}
