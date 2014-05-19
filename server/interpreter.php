<?

include_once("layout.php");
include_once("flags.php");

class Interpreter {

    public $room;

    public function interpret($command) {
        $words = split(" +", $command);

        switch ($words[0]) {
        case "go": return $this->go($words[1]);
        case "look": return sprintf("[%s]\n%s", $this->room->name, $this->room->description);

        case "open":
                     switch ($this->room->id) {
                         case "kitchen":
                             switch ($words[1]) {
                                 case "fridge": 
                                     if (test_flag('fridge_open')) {
                                         return "The fridge is already open.";
                                     }
                                     set_flag('fridge_open');
                                     $str = "You open the fridge.\n";
                                     $str .= $this->examine("fridge");
                                     return $str;

                                 default:
                                     return "You can't open that!";
                             }

                         default:
                             return "You can't open that!";
                     }


        case "close":
                     switch ($this->room->id) {
                         case "kitchen":
                             switch ($words[1]) {
                                 case "fridge":
                                     if (!test_flag('fridge_open')) {
                                         return "The fridge is already closed";
                                     }
                                     clear_flag('fridge_open');
                                     return "You close the fridge.";
                                 default:
                                     return "You can't close that!";
                             }

                         default:
                             return "You can't close that!";
                     }

        case "take":
                     switch ($this->room->id) {
                         case "kitchen":
                             switch ($words[1]) {
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

                                 default: return "You can't take that!";
                             }
                         default: return "You can't take that!";
                     }

        case "examine": return $this->examine($words[1]);

        case "inventory": return $this->inventory();

        case "help":
            return <<<EOT
Commands

go <direction>: go in a direction
look: look around a room
open: open an item
close: close an item
take: take an item
examine: examine an item
inventory: print out list of items in inventory
help: print this message

EOT
;

        case "restart":
                          session_destroy();
                          return "restarting...";

        default: 
                          if ($this->go_test($words[0])) {
                              return $this->go($words[0]);
                          } else {
                              return "Unknown command.";
                          }
        }

    }

    private function examine($thing) {
        switch ($this->room->id) {
            case "kitchen":
                switch ($thing) {
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
                        return "You can't examine that!";
                }
            default:
                return "You can't examine that!";
        }
    }

    private function inventory() {
        $inventory = inventory_as_array();
        $str = "";
        foreach ($inventory as $item => $description) {
            $str .= $item;
            if ($description != "") {
                $str .= ": $description";
            }
            $str .= "\n";
        }
        return $str;
    }

    private function change_room($new_room) {
        $_SESSION['room'] = $new_room->id;
        $this->room = $new_room;
    }

    private function go($direction) {
        $unlock_msg = $this->room->unlock_test($direction);

        if ($this->room->is_locked($direction)) {
            return $this->room->lock_msg($direction);
        }
        
        if (!isset($this->room->exits[$direction])) {
            return "You cannot go that way!";
        }

        $this->change_room($this->room->exits[$direction]);
        return sprintf("%s\nYou go %s.\n[%s]", $unlock_msg, $direction, $this->room->name);
    }

    private function go_test($direction) {
        if ($this->room->is_locked($direction)) {
            return true;
        }
        
        if (!isset($this->room->exits[$direction])) {
            return false;
        }

        return true;

    }
}
