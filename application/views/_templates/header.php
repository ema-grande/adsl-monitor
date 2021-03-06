<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ADSL Monitor</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- JS -->
	<!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
	<!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

	<!-- CSS -->
	<link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo URL; ?>public/js/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<!-- header -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container"> <!-- container -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo URL; ?>">ADSL STATS</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li<?php if(isset($this->control) and $this->control == "speed") { ?> class="active"<?php } ?>><a href="<?php echo URL; ?>speed">ADSL Speed</a></li>
				<li<?php if(isset($this->control) and $this->control == "drop") { ?> class="active"<?php } ?>><a href="<?php echo URL; ?>drop">ADSL Disconnection</a></li>
				<li<?php if(isset($this->control) and $this->control == "ping") { ?> class="active"<?php } ?>><a href="<?php echo URL; ?>ping">ADSL Ping</a></li>
				<li><a><?php echo date("D d M Y H:i", time()); ?></a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div> <!-- /container -->
	</div>
	<!-- / header -->
