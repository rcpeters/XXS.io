<?php
if (isset($_GET['url'])) {
 
   $url = $_GET['url'];
   $script = $_GET['script'];
   $html = file_get_contents($url);
   $dom = @DOMDocument::loadHTML($html);

   if (!$dom->getElementsByTagName('base')->length) {
      $html = preg_replace('/<head>/', sprintf('<head><base href="%s"/>', $url), $html);
   }
 
   print preg_replace('/<\/body>/', sprintf('<script src="%s" /></script></body>',$script), $html);
} else {
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>XXS.io</title>
		<link href='http://fonts.googleapis.com/css?family=Plaster|Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
		<style>
			html {
				background-color: #cfdabc;
			}
			
			body {
				font-family: 'Plaster', cursive; 
				color: #000000;
				margin: 0px;
				padding: 0px;
				border: 0px;
				width: 100%;
				height: 100%;
				font-size: 2em;
			}
			
			a:link {color: #666666;}      /* unvisited link */
			a:visited {color: #666666;}  /* visited link */
			a:hover {color: #666666;}  /* mouse over link */
			a:active {color: #666666;}  /* selected link */
			
			.g1 { 
				color: #cfdabc
			}
			
			.g2 { 
				color: #c9d7c0
			}

			.g3 { 
				color: #c2d4c4
			}

			.g4 { 
				color: #a3b492
			}

			.g5 { 
				color: #8aa676
			}

			.g6 { 
				color: #aba89f
			}

			.g7 { 
				color: #777d6d
			}
			
			#fb {
				font-size: 1em;
				color: #777d6d;
				padding: 0px;
			}
			
			#fb0, #fb1, #fb2, #fb3, #fb4, #fb5 {			
				opacity: 0;
			}
			
			#info { 
			    padding: 0px;
				font-family: 'Karla', sans-serif;
				opacity: 0;
				width: 80%;
			}
			
			.hFbLBack { 
				background-color:rgba(119, 125, 109, 1)
			}
			
			.center {
				margin-left:auto;
				margin-right:auto;
				width:80%;
			}
			
			.content {
				padding: 0px;
			}
			
		</style>
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
		<script type="text/javascript">
			function fadeOutIn (id, speed, count) {	
				$('#'+id).animate({
					opacity: 0.1,
				}, speed, function() {
					$('#'+id).animate({
					opacity: 1,
				}, speed, function() {
						if (count > 0 ) {
							fadeOutIn(id, Math.round(speed + speed * 0.20), count - 1);
						} else if (id == 'fb5') {
							$('#info').animate({
								opacity: 1
								}, 1000, function () {
							});
						}
					});
				});
			}
			
			function fadeInLetter (id, func) {
				$('#'+id).animate({
					opacity: 1,
					}, 50, function () {
						fadeOutIn(id, 100, 5);
				});
			}
			
			function positioning() {
				var winW = $(window).width();
				var winH = $(window).height();
				$("#fb").css("font-size", Math.floor(winW/12) + 'px');
				var contentH = $("#content").outerHeight(true);
				$("#content").css("margin-top", Math.floor(winH - contentH) / 2 + 'px');				
			}
			
			$( function () {
			   
				positioning();
				
				for (var i = 0; i < 6; i++) {
					window.setTimeout('fadeInLetter("fb'+ i +'")', i*200);
				}
				
				$(window).resize(positioning);
				
			});
			
			
		
		</script>
	</head>
	<body>
		<div id="content" class="center">
			<div id="fb"> 
				<span class="hFbLetter" id="fb0">X</span>
				<span class="hFbLetter" id="fb1">X</span>
				<span class="hFbLetter" id="fb2">S</span>
				<span class="hFbLetter" id="fb3">.</span>
				<span class="hFbLetter" id="fb4">i</span>
				<span class="hFbLetter" id="fb5">o</span>
			</div>
			<div id="info">
				<br />
				<strong>Prototype Your JS Mashups Faster</strong>:<br />
				Get hacking, just include an url & script parameter and we'll insert the script before the end body tag.<br />
			 	<br /><span style="font-size: 50%">Maybe you're a sick bastard and think testing a javascript<br /> that inserts veggies on bacolicio.us would be fun.<br />
                                <a href="http://xxs.io?url=http://bacolicio.us&script=http://rcpeters.com/veggie.js">http://xxs.io?url=http://<strong>bacolicio.us</strong>&script=http://rcpeters.com/<strong>veggie.js</strong></a></span>
			</div>
		</div>
	</body>
</html>






<?php
}
