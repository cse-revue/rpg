<?
class Room {
    public $exits = array();
    public $locked = array();

    public $description = "You are in a room.";
    public $name = "Room";
    public $id = "room";

    public function connect($ex, $room) {
        $this->exits[$ex] = $room;
    }

    public function lock($ex, $msg = "The door is locked.") {
        $this->locked[$ex] = $msg;
    }
    
    public function is_locked($ex) {
        return isset($this->locked[$ex]);
    }

    public function unlock_test($ex) {

    }

    public function unlock($ex) {
        unset($this->locked[$ex]);
    }

    public function lock_msg($ex) {
        return $this->locked[$ex];
    }

    public function init() {
    }
}
