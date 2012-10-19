<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">

		<title>Prototyping in Code - 500S Design Bootcamp</title>

        <meta name="description" content="HTML5/CSS3 Slides for 500S Design Bootcamp">
        <meta name="author" content="Kevin Xu">

		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="css/reveal.css">
        <link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/theme/apple.css" id="theme">

		<!-- For syntax highlighting -->
		<link rel="stylesheet" href="lib/css/zenburn.css">

		<!-- If the query includes 'print-pdf', use the PDF print sheet -->
		<script>
			document.write( '<link rel="stylesheet" href="css/print/' + ( window.location.search.match( /print-pdf/gi ) ? 'pdf' : 'paper' ) + '.css" type="text/css" media="print">' );
		</script>

		<!--[if lt IE 9]>
		<script src="lib/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="reveal">

			<!-- Any section element inside of this container is displayed as a slide -->
			<div class="slides">

				<section>
					<h1>Prototyping in Code</h1>
					<h3>And other goodies</h3>
					<img src="images/code.jpeg" alt="" width="500px">
				</section>

				<section>
					<h1>Twitter Bootstrap</h1>
					<h2>Or</h2>
					<h1>Zurb Foundation</h1>
					<h2>?????</h2>
				</section>

				<section>
					<h2>Foundation</h2>
					<a href="http://foundation.zurb.com/" target="_blank">http://foundation.zurb.com/</a>
					<img src="images/foundation.png" alt="">
				</section>

				<section>
					<h2>AuctionBase</h2>
					<a href="http://stanford.edu/~kevinx/cgi-bin/auctionbase/" target="_blank">http://stanford.edu/~kevinx/cgi-bin/auctionbase/</a>
					<img src="images/auctionbase2.png" alt="">
				</section>

				<section>
					<h2>Brandseen</h2>
					<a href="http://brandseenapp.com/" target="_blank">http://brandseenapp.com/</a>
					<img src="images/brandseen.png" alt="">
				</section>

				<section>
					<h2>GrandSentral</h2>
					<a href="http://grandsentral.com/" target="_blank">http://grandsentral.com/</a>
					<img src="images/grandsentral.png" alt="">
				</section>

                <section class="end">
                    <h1>Questions?</h1>
                    <p>
                        <strong id="overview">Press ESC</strong> to see slide overview
                    </p>
                    <p>
                        <a href="http://imkevinxu.com/prototyping">http://imkevinxu.com/prototyping</a>
                    </p>
                    <img src="images/skydive.jpeg" alt="Skydiving Kevin Xu" id="skydive">
                    <p>
                        <a href="http://twitter.com/imkevinxu" target="_blank">
                            <img src="images/twitter.png" alt="Twitter @imkevinxu" class="social">
                        </a>
                        <a href="http://linkedin.com/in/imkevinxu" target="_blank">
                            <img src="images/linkedin.png" alt="Linkedin Kevin Xu" class="social">
                        </a>
                        <a href="https://github.com/imkevinxu" target="_blank">
                            <img src="images/github.png" alt="Github imkevinxu" class="social">
                        </a>
                    </p>
                </section>

			</div>

		</div>

		<script src="lib/js/head.min.js"></script>
		<script src="js/reveal.min.js"></script>

		<script>

			// Full list of configuration options available here:
			// https://github.com/hakimel/reveal.js#configuration
			Reveal.initialize({
				controls: true,
				progress: true,
				history: true,

				theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
				transition: Reveal.getQueryHash().transition || 'default', // default/cube/page/concave/zoom/linear/none

				// Optional libraries used to extend on reveal.js
				dependencies: [
					{ src: 'lib/js/highlight.js', async: true, callback: function() { window.hljs.initHighlightingOnLoad(); } },
					{ src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
					{ src: 'lib/js/showdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
					{ src: 'lib/js/data-markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
					{ src: 'plugin/zoom-js/zoom.js', condition: function() { return !!document.body.classList; } },
					{ src: '/socket.io/socket.io.js', async: true, condition: function() { return window.location.host === 'localhost:1947'; } },
					{ src: 'plugin/speakernotes/client.js', async: true, condition: function() { return window.location.host === 'localhost:1947'; } }
				]
			});

		</script>

	</body>
</html>
