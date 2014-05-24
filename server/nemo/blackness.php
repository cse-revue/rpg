<?
include_once('room.php');

class Blackness extends Room {
    public $name = "Blackness";
    public $id = "blackness";
    public $description = <<<EOT
You find yourself in the dark void of the ocean. There is nothing here.
EOT
;

    public function on_enter() {
        if (isset($_SESSION['blackness_count'])) {
            $_SESSION['blackness_count'] = ((int)$_SESSION['blackness_count']) + 1;
        } else {
            $_SESSION['blackness_count'] = 0;
        }

        switch ((int)$_SESSION['blackness_count']) {
        case 1:
            $this->description .= " You feel unsafe here.";
            break;
        case 2:
            $this->description .= " With each passing second you find in this void, you can't shake the feeling you are being watched.";
            break;
        case 3:
            $this->description .= " A dark shape is approaching you from below. Leave now and don't return!";
            break;
        case 4:
            echo nl2br(htmlspecialchars(<<<EOT
You are eaten by a grue. You die.

Restarting...\n
EOT
));
            restart();

        }
    }
}
