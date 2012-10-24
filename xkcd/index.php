
<!DOCTYPE HTML>
<html>
<head>
    <title>Create your own XKCD-style Graphs</title>

    <link rel="stylesheet" href="style.css" />

    <!-- Facebook Meta Data -->
    <meta property="og:url" content="http://imkevinxu.com/xkcd" />
    <meta property="og:title" content="Create your own XKCD-style Graphs" />
    <meta property="og:description" content="Instant XKCD-style Graphs created in Javascript D3 for your enjoyment" />
    <meta property="og:image" content="http://imkevinxu.com/xkcd/graph.png" />
    <meta property="og:type" content="website" />

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-25074402-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=407882832614060";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</head>
<body>

    <div class="container">

        <h1>Create your own XKCD-style Graphs</h1>
        <h2>Major credit to <a href="http://dan.iel.fm/xkcd/" target="_blank">Dan Foreman-Mackey</a></h2>

        <!-- 100x
        sin(x*2)
        x^2.5
        x^x
        ln
        e
        negative numbers
        negative domain
        x^-2 -->

        <form>
            <div class="left">
                <div class="input">
                    <label for="equation">Equation</label>
                    <input type="text" id="equation" placeholder="x * sin(x)" />
                </div>

                <div class="input">
                    <label for="xmin">X-minimum</label>
                    <input type="text" id="xmin" placeholder="-10" value="-10" />
                </div>

                <div class="input">
                    <label for="xmax">X-maximum</label>
                    <input type="text" id="xmax" placeholder="10" value="10" />
                </div>
            </div>

            <div class="right">
                <div class="input">
                    <label for="title">Title</label>
                    <input type="text" id="title" placeholder="Awesome Graph" value="Awesome Graph" />
                </div>

                <div class="input">
                    <label for="xlabel">X-label</label>
                    <input type="text" id="xlabel" placeholder="Awesome Graph" value="Awesome Graph" />
                </div>

                <div class="input">
                    <label for="ylabel">Y-label</label>
                    <input type="text" id="ylabel" placeholder="Awesome Graph" value="Awesome Graph" />
                </div>
            </div>

            <div class="clear"></div>
        </form>
    </div>

    <div id="plot"></div>
    <div id="examples"></div>

    <footer class="container">

        <div class="social">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://imkevinxu.com/xkcd/" data-via="imkevinxu">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <div class="fb-like" data-href="http://imkevinxu.com/xkcd/" data-send="false" data-width="300" data-show-faces="true"></div>
        </div>

        <div class="credit">
            <a href="https://twitter.com/charlierguo" target="_blank">@charlierguo</a>
            &nbsp;
            <a href="http://twitter.com/imkevinxu" target="_blank">@imkevinxu</a>
        </div>

    </footer>

    <a href="https://github.com/imkevinxu/imkevinxu/tree/master/xkcd" target="_blank">
        <img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub">
    </a>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://d3js.org/d3.v2.min.js"></script>
    <script src="jquery.textchange.min.js"></script>
    <script src="xkcd.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#equation').focus();

            $('input').bind('textchange', function (event, previousText) {
                $("#plot").empty();

                var expression = string_eval($('#equation').val()),
                    xmin = parseInt($('#xmin').val()),
                    xmax = parseInt($('#xmax').val());

                if (expression != "'Invalid function.'" && expression.indexOf("x") >= 0 && !isNaN(xmin) && !isNaN(xmax)) {
                    function f(x) {
                        return eval(expression.split("x").join(x));
                    }
                    var N = 100,
                        xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
                        data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                            return {x: d, y: f(d)};
                        }),
                        parameters = {  title: $('#title').val(),
                                        xlabel: "X",
                                        ylabel: "Y",
                                        xlim: xlim },
                        plot = xkcdplot();
                    plot("#plot", parameters);
                    plot.plot(data);
                    plot.draw();
                } else {
                    console.log("Invalid function.");
                }

            });

        });

        var string_eval = function(input_string) {
            var operators = "+-*/^"
            //var operator_regex = /\+|-|\*|\/|^/;
            var functions = ["sin(", "cos(", "tan(", "log(", "abs(", "sqrt"]; //brainfuck ಠ_ಠ
            input_string = input_string.split(" ").join("").toLowerCase();
            for (var i = 0; i < operators.length; i++) {
                input_string = input_string.replace(operators[i], " " + operators[i] + " ");
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
                    return "'Invalid function.'";
                }
            } catch (err) {
                return "'Invalid function.'";
            }

            return output_string;
        }

    </script>

    <script type="text/javascript">
        // Example Graphs

        function f1 (x) {
            return Math.exp(-0.5 * (x - 1) * (x - 1)) * Math.sin(x + 0.2) + 0.05;
        }
        function f2 (x) {
            return 0.5 * Math.cos(x - 0.5) + 0.1;
        }
        var xmin = -1.0,
            xmax = 7,
            N = 100,
            xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
            data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f1(d)};
            }),
            data2 = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f2(d)};
            }),
            parameters = {  title: "Example",
                            xlabel: "Yumminess",
                            ylabel: "Velociraptor Speed",
                            xlim: xlim },
            plot = xkcdplot();
        plot("#examples", parameters);
        plot.plot(data);
        plot.plot(data2, {stroke: "red"});
        plot.draw();



        function f3 (x) {
            return Math.cos(x);
        }
        function f4 (x) {
            return Math.sin(x);
        }
        var xmin = -1.0,
            xmax = 14,
            N = 100,
            xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
            data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f3(d)};
            }),
            data2 = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f4(d)};
            }),
            parameters = {  title: "Sin(x) and Cos(x)",
                            xlabel: "X",
                            ylabel: "Y",
                            xlim: xlim,
                            ylim: [-1.1, 1.1] },
            plot = xkcdplot();
        plot("#examples", parameters);
        plot.plot(data);
        plot.plot(data2, {stroke: "red"});
        plot.draw();



        function f5 (x) {
            return Math.pow(x, 2);
        }
        function f6 (x) {
            return -Math.pow(x, 2);
        }
        function f7 (x) {
            return 2 * x;
        }
        var xmin = -10,
            xmax = 10,
            N = 100,
            xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
            data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f5(d)};
            }),
            data2 = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f6(d)};
            }),
            data3 = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f7(d)};
            }),
            parameters = {  title: "X^2, X^-2, and 2X",
                            xlabel: "Lava Levels",
                            ylabel: "Heat",
                            xlim: xlim,
                            ylim: [-100, 100] };
            plot = xkcdplot();
        plot("#examples", parameters);
        plot.plot(data);
        plot.plot(data2, {stroke: "red"});
        plot.plot(data3, {stroke: "green"});
        plot.draw();



        function f8 (x) {
            return x * Math.cos(x);
        }
        var xmin = -100,
            xmax = 100,
            N = 200,
            xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
            data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f8(d)};
            }),
            parameters = {  title: "X * cos(X)",
                            xlabel: "Chaos",
                            ylabel: "Insanity",
                            xlim: xlim };
            plot = xkcdplot();
        plot("#examples", parameters);
        plot.plot(data);
        plot.draw();



        function f9 (x) {
            return 10;
        }
        function f10 (x) {
            return 9.8;
        }
        function f11 (x) {
            if (x >= 8 && x < 9) return 0;
            return 10.2;
        }
        var xmin = 0,
            xmax = 10,
            N = 100,
            xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
            data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f9(d)};
            }),
            data2 = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f10(d)};
            }),
            data3 = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f11(d)};
            }),
            parameters = {  title: "Amazon EC2 Uptime",
                            xlabel: "Time",
                            ylabel: "Uptime",
                            xlim: xlim,
                            ylim: [-1, 10.5]};
            plot = xkcdplot();
        plot("#examples", parameters);
        plot.plot(data);
        plot.plot(data2, {stroke: "red"});
        plot.plot(data3, {stroke: "green"});
        plot.draw();
        $('<h3>Inspired by <a href="https://twitter.com/samratjp" target="_blank">@samratjp</a></h3>').insertAfter($("#examples h1")[4]);


        function f12 (x) {
            return Math.pow(x, 2);
        }
        var xmin = 0,
            xmax = 10,
            N = 100,
            xlim = [xmin - (xmax - xmin) / 16, xmax + (xmax - xmin) / 16],
            data = d3.range(xmin, xmax, (xmax - xmin) / N).map(function (d) {
                return {x: d, y: f12(d)};
            }),
            parameters = {  title: "Ruby on Rails vs Brogrammers",
                            xlabel: "RoR Popularity",
                            ylabel: "# of Brogrammers",
                            xlim: xlim,
                            ylim: [-10, 10.5]};
            plot = xkcdplot();
        plot("#examples", parameters);
        plot.plot(data, {stroke: "red"});
        plot.draw();
        $('<h3>Inspired by <a href="https://twitter.com/samratjp" target="_blank">@samratjp</a></h3>').insertAfter($("#examples h1")[5]);

    </script>

</body>
</html>
