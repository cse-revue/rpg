<?
include_once('room.php');

class Kitchen extends Room {
    public $name = "Kitchen";
    public $id = "kitchen";
    public $description = <<<EOT
There is a fridge in the corner.
The living room is to the aft.
EOT
;


    public function init() {
        if (test_flag('fridge_open')) {
            $this->description .= "\nThe fridge is open.";
        }
    }
}
