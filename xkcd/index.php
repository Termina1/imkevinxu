
<!DOCTYPE HTML>
<html>
<head>
    <title>XKCD-style Graphs</title>

    <!-- Facebook Meta Data -->
    <meta property="og:url" content="http://imkevinxu.com/xkcd" />
    <meta property="og:title" content="XKCD-style Graphs" />
    <meta property="og:description" content="XKCD-style Graphs created in Javascript D3" />
    <meta property="og:image" content="http://imkevinxu.com/xkcd/graph.png" />
    <meta property="og:type" content="website" />

    <style>
        @font-face {
            font-family: "xkcd";
            src: url('http://antiyawn.com/uploads/Humor-Sans.ttf');
        }

        body {
            font-family: "xkcd", sans-serif;
            font-size: 16px;
            color: #333;
        }

        a {
            text-decoration: none;
            color: steelblue;
        }

        a:hover {
            color: #0E5C9E;
        }

        .container {
            width: 700px;
            margin: 20px auto;
            text-align: center;
        }

        #plot {
            width: 700px;
            margin: 70px auto;
        }

        #plot h1 {
            text-align: center;
        }

        #plot h1:nth-child(n+2) {
            margin-top: 120px;
        }

        p {
            margin: 10px 0 20px;
            font-size: 20px;
            line-height: 1.5em;
        }

        text.title {
            font-size: 20px;
        }

        path {
            fill: none;
            stroke-width: 2.5px;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        path.axis {
            stroke: black;
        }

        path.bgline {
            stroke: white;
            stroke-width: 6px;
        }

        footer {
            display: block;
            height: 50px;
        }

        .social {
            float: left;
        }

        .social .twitter-share-button {
            width: 86px !important;
            height: 24px !important;
        }

        .credit {
            float: right;
        }
    </style>

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

        <h1>XKCD-style Graphs</h1>
        <h2>Credit to <a href="http://dan.iel.fm/xkcd/" target="_blank">Dan Foreman-Mackey</a></h2>

    </div>

    <div id="plot"></div>

    <footer class="container">

        <div class="social">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://imkevinxu.com/xkcd/" data-via="imkevinxu">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <div class="fb-like" data-href="http://imkevinxu.com/xkcd/" data-send="false" data-width="200" data-show-faces="true"></div>
        </div>

        <div class="credit">
            <a href="https://twitter.com/charlierguo" target="_blank">@charlierguo</a>
            &nbsp;
            <a href="http://twitter.com/imkevinxu" target="_blank">@imkevinxu</a>
        </div>

    </footer>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://d3js.org/d3.v2.min.js"></script>
    <script src="xkcd.js"></script>

    <script>
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
        plot("#plot", parameters);
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
            parameters = {  title: "Sin and Cosine",
                            xlabel: "X",
                            ylabel: "Y",
                            xlim: xlim,
                            ylim: [-1.1, 1.1] },
            plot = xkcdplot();
        plot("#plot", parameters);
        plot.plot(data);
        plot.plot(data2, {stroke: "red"});
        plot.draw();

    </script>

</body>
</html>
