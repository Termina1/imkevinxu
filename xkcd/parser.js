// Parses input string into Javascript-eval ready expression
// Original Author: Charlie Guo https://github.com/charlierguo
// Customized by: Kevin Xu https://github.com/imkevinxu

var string_eval = function(input_string) {
    if (!input_string) return "0";

    var operators = "+-*/^"
    //var operator_regex = /\+|-|\*|\/|^/;
    var functions = ["sin(", "cos(", "tan(", "log(", "abs(", "sqrt"]; //brainfuck ಠ_ಠ
    input_string = input_string.split(" ").join("").toLowerCase();
    for (var i = 0; i < operators.length; i++) {
        input_string = input_string.split(operators[i]).join(" " + operators[i] + " ");
    }
    var string_pieces = input_string.split(" ");
    var output_string = "";
    for (var i = 0; i < string_pieces.length; i++) {
        if (functions.indexOf(string_pieces[i].substr(0, 4)) >= 0) {
            output_string += ("Math." + string_pieces[i])
        } else if (string_pieces[i] === "^") {
            output_string += "Math.pow(" + string_pieces[i-1] + "," + string_pieces[i+1] + ")";
        } else {
            if (i < string_pieces.length && string_pieces[i+1] === "^"
                || i > 0 && string_pieces[i-1] === "^") {
                // do nothing
            } else {
                output_string += string_pieces[i];
            }
        }
    }

    try {
        var test_output = output_string.split("x").join("1");
        if (typeof(eval(test_output)) !== "number") {
            return "'Invalid function'";
        }
    } catch (err) {
        return "'Invalid function'";
    }

    return output_string;
}