<?
include_once('room.php');


class Laundry extends Room {
    public $name = "Laundry";
    public $id = "laundry";
    public $description = <<<EOT
It is too dark to see anything.
EOT
;

    private $alternate_description = <<<EOT
You see a washing machine and basin. A fine white powder covers everything.
EOT
;

    public function default_verb() {
        return "turn";
    }

    public function init() {

        if (test_flag("laundry_light_on")) {
            $this->description = $this->alternate_description;
        }

        $this->verbs = array(
            "turn" => function($rest) {
                switch($rest[0]) {
                case "on":
                    switch ($rest[1]) {
                    case "light":
                    case "lights":
                        if (test_flag("laundry_light_on")) {
                            return "The light is already on.";
                        }
                        set_flag("laundry_light_on");
                        return "You turn on the light.";
                    }
                    return null;
                case "off":
                    switch ($rest[1]) {
                    case "light":
                    case "lights":
                        if (!test_flag("laundry_light_on")) {
                            return "The light is already off.";
                        }
                        clear_flag("laundry_light_on");
                        return "You turn off the light.";
                    }
                    return null;
                }
            }
        );
    }
}
