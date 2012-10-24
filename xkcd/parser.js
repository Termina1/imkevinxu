// Parses input string into Javascript-eval ready expression
// Original Author: Charlie Guo https://github.com/charlierguo
// Customized by: Kevin Xu https://github.com/imkevinxu

var string_eval = function(input_string) {

    var output_string = "";
    var string_pieces = splitStringIntoPieces(input_string);

    for (var i = 0; i < string_pieces.length; i++) {
        // Replacing pi and e with respective Math functions
        if (string_pieces[i] === "pi") {
            string_pieces[i] =  "Math.PI";
        } else if (string_pieces[i] === "e") {
            string_pieces[i]= "Math.E";
        }

        // Concatenating to output_string Javascript-eval ready expression
        if (beginsWithFunction(string_pieces[i])) {
            output_string += "Math." + string_pieces[i];
        } else if (string_pieces[i] === "^") {
            output_string += "Math.pow(" + string_pieces[i-1] + "," + string_pieces[i+1] + ")";
        } else {
            if (i < string_pieces.length && string_pieces[i+1] === "^"
                || i > 0 && string_pieces[i-1] === "^") {
                // do nothing for numbers before and after ^
            } else {
                output_string += string_pieces[i];
            }
        }
    }

    console.log("out" + output_string);

    try {
        var test_output = output_string.split("x").join("1");
        if (typeof(eval(test_output)) !== "number") {
            return "'Invalid function'";
        }
    } catch (err) {
        return "'Invalid function'";
    }

    return output_string;
};

function splitStringIntoPieces(input_string) {
    var operators = "+-*/^x";
    var functions = ["sin(", "cos(", "tan(", "abs(", "pow(", "sqrt(", "log("];
    var inputs = input_string.replace(/^\s\s*/, '').replace(/\s\s*$/, '').toLowerCase();
    for (var i = 0; i < operators.length; i++) {
        inputs = inputs.split(operators[i]).join(" " + operators[i] + " ");
    }
    var inputs_array = inputs.split(" ");

    // Trims empty array spots
    for (var i = 0; i < inputs_array.length; i++) {
        if (inputs_array[i] === "") {
            inputs_array.splice(i, 1);
            i--;
        }
    }
    for (var i = 0; i < inputs_array.length; i++) {
        if (inputs_array[i] === "-" && inputs_array[i+1] === "x") {
            inputs_array[i] = "+(-" + inputs_array[i+1] + ")";
            inputs_array.splice(i+1);
        } else if (inputs_array[i] === "-" && operators.indexOf(inputs_array[i-1]) >= 0) {
            inputs_array[i] = "(-" + inputs_array[i+1] + ")";
            inputs_array.splice(i+1);
        } else if (operators.indexOf(inputs_array[i]) < 0 && functions.indexOf(inputs_array[i]) < 0 && inputs_array[i+1] === "x") {
            console.log(inputs_array);
            inputs_array.splice(i+1, 0, "*");
            i+=2;
        }
    }
    return inputs_array;
}

function beginsWithFunction(str) {
    var functions = ["sin(", "cos(", "tan(", "abs(", "pow(", "sqrt(", "log("];
    for (var j = 0; j < functions.length; j++) {
        if (str.indexOf(functions[j]) == 0) {
            return true;
        }
    }
    return false;
}