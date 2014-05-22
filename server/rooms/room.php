<?
class Room {
    public $exits = array();
    public $locked = array();

    public $description = "You are in a room.";
    public $name = "Room";
    public $id = "room";

    protected $verbs;

    public function apply_verb($verb, $item) {
        if (isset($this->verbs[$verb])) {
            return $this->verbs[$verb]($item);
        }
        return null;
    }

    # called from layout to connect rooms together
    public function connect($ex, $room) {
        $this->exits[$ex] = $room;
    }

    # locks an exit of a room
    public function lock($ex, $msg = "The door is locked.") {
        $this->locked[$ex] = $msg;
    }
    
    # test if an exit is locked
    public function is_locked($ex) {
        return isset($this->locked[$ex]);
    }

    /* implemented by subclasses and called each time the player attempts to 
     * open a locked door. Return value is unused, and this function should
     * call the appropraite unlock method to unlock the door.
     */
    public function unlock_test($ex) {

    }

    # unlocks the door to an exit
    public function unlock($ex) {
        unset($this->locked[$ex]);
    }

    # get the message to tell the player that the door is locked
    public function lock_msg($ex) {
        return $this->locked[$ex];
    }

    /* implemented by subclasses to perform any initialization on the room */
    public function init() {
    }

    /* implemented by subclasses to perform an action each time the room is
     * entered */
    public function on_enter() {

    }

    /* prepended to commands that do not match any recognized verbs and
     * the interpreting is re-attempted
     */
    public function default_verb() {
        return "";
    }
}
