<?

include_once("layout.php");
include_once("flags.php");

class Interpreter {

    public $room;

    public $ignored_words = array(
        "the" => true,
        "a" => true
    );

    public function interpret($command, $using_default = false) {
        $all_words = split(" +", $command);

        // put the non-ignored words into an array
        $words = array();
        foreach ($all_words as $word) {
            if (!isset($this->ignored_words[$word])) {
                $words[] = $word;
            }
        }

        if (empty($words)) {
            return null;
        }

        // test for room specific verb
        if (isset($words[1])) {
            $room_specific = $this->room->apply_verb($words[0], array_slice($words, 1));
            if ($room_specific != null) {
                return $room_specific;
            }
        }
        
        // test for all the builtin commands
        switch ($words[0]) {
        case "go": return $this->go($words[1]);
        case "look": 
        case "l":
            return $this->look();
        case "take": return $this->take($words[1]);
        case "inventory": 
        case "inv":
        case "i":
            return $this->inventory();
        case "drop": return $this->drop($words[1]);
        case "exits": return $this->exits();
        case "help": return $this->help();
        case "restart": restart();

        default: 

            // try using the default verb of this room
            if (!$using_default) {
                $default_test = $this->interpret($this->room->default_verb() . " " . $command, true);
                if ($default_test != null) {
                    return $default_test;
                }
            }

            // then try interpreting the command as a direction
            if ($this->go_test($words[0])) {
                return $this->go($words[0]);
            } else {
                return null;
            }
        }

    }

    public function help() {
        return <<<EOT
Commands

go <direction>: go in a direction
look: look around a room
open: open an item
close: close an item
take: take an item
drop: drop an item from your inventory
inventory: print out list of items in inventory
exits: list the directions you can travel out of this room
help: print this message

EOT
;
    }

    public function look() {
        $str = sprintf("[%s (%s)]\n%s\n", $this->room->name, $this->room->id, $this->room->description);

        $items = array();
        $room_inventory = room_inventory_as_array($this->room->id); 
        foreach ($room_inventory as $item => $description) {
            $items[] = $item;
        }
        if (!empty($items)) {
            foreach ($items as $item) {
                $str .= sprintf("There is a %s here.\n", $item);
            }
        }

        return $str;
    }

    private function exits() {
        $str = "";
        $exits = array_keys($this->room->exits);
        $num_exits = count($exits);
        if ($num_exits == 1) {
            $str .= sprintf("This room has an exit to the %s.\n", $exits[0]);
        } else if ($num_exits > 1) {
            $str .= "This room has exits to the ";
            $start = join(", ", array_slice($exits, 0, $num_exits - 1));
            $str .= sprintf("%s and %s.", $start, $exits[$num_exits - 1]);
        }
        return $str;
    }

    private function take($thing) {
        if (room_inventory_has_item($this->room->id, $thing)) {
            take_from_room($this->room->id, $thing);
            return sprintf("You take the %s.", $thing);
        } else {
            return "This room does not contain that item.";
        }
    }

    private function drop($thing) {
        if (inventory_has_item($thing)) {
            drop_in_room($this->room->id, $thing);
            return sprintf("Dropped %s.", $thing);
        } else {
            return "You don't have that item.";
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
        if ($str == "") {
            $str = "(no items)";
        }
        return $str;
    }

    private function change_room($new_room) {
        $_SESSION['room'] = $new_room->id;
        $this->room = $new_room;
    }

    private function go($direction) {
        
        if ($this->room->is_locked($direction)) {
            $unlock_msg = $this->room->unlock_test($direction);
        } else {
            $unlock_msg = "";
        }

        if ($this->room->is_locked($direction)) {
            return $this->room->lock_msg($direction);
        }
        
        if (!isset($this->room->exits[$direction])) {
            return "You cannot go that way!";
        }

        $this->change_room($this->room->exits[$direction]);
        $this->room->on_enter();
        return sprintf("%sYou go %s.\n[%s (%s)]\n%s", $unlock_msg, $direction, $this->room->name, $this->room->id, $this->room->description);
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
