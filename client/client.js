function Interpreter() {
}

Interpreter.prototype.evaluate = function(str, after) {
    $.post('server/rpg.php', {input: str}, after);
}

$(function() {
    var game_console = new Console(
        document.getElementById("console-input"),
        document.getElementById("console-output"),
        new Interpreter()
    );
    game_console.setup_keys();
    game_console.focus();
    game_console.async = true;

    window.onresize = function() {
        game_console.scroll_to_bottom();
    }

    $('#console-input').val('help');
    game_console.process();
});

