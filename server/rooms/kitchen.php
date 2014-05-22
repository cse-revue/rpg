<?
include_once('room.php');

class Kitchen extends Room {
    public $name = "Kitchen";
    public $id = "kitchen";
    public $description = <<<EOT
There is a fridge in the corner.
The living room is to the aft.
To your right is a darkened doorway.
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
                        inventory_add_item('milk', "it smells funny");
                        return "You take the milk.";
                    case "key":
                        if (test_flag('taken_key')) return "The key is no longer there.";
                        if (!test_flag('fridge_open')) return "You can't see a key.";
                        set_flag('taken_key');
                        inventory_add_item('key', "it has a label: \"Steve's Room\".");
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
                             $str .= "Spoilt Milk\n";
                         }
                         if (!test_flag('taken_key')) {
                             $fridge_empty = false;
                             $str .= "Key labeled \"Steve's Room\"";
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
