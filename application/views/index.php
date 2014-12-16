<?php
	$now = time();
	$speedDiff = $now - strtotime($listSpeed[0]->time);
	$discDiff = $now - strtotime($listDrop[0]->time);
	$pingDiff = $now - strtotime($listPing[0]->time);
	$format = "z \d H \h i \m\i\\n s \s\\e\c"
?><br/>
<div class="container starter-template">
	<div class="panel panel-default">
		<div class="panel-heading">Latest speed test</div>
		<div class="panel-body">
			Latest speed test <strong><?php echo gmdate($format, $speedDiff) ?></strong> ago,
			with download speed <strong><?php echo $listSpeed[0]->dl ?></strong>,
			uplaod speed <strong><?php echo $listSpeed[0]->up ?></strong> and
			ping <strong><?php echo $listSpeed[0]->ping ?></strong>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">Latest disconnection</div>
		<div class="panel-body">
			Latest disconnection result <strong><?php echo gmdate($format, $discDiff) ?></strong> ago,
			last for <strong><?php echo gmdate('H:i:s', $listDrop[0]->durata); ?></strong>,
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">Ultimo ping</div>
		<div class="panel-body">
			Latest high ping result <strong><?php echo gmdate($format, $pingDiff) ?></strong> ago,
			of <strong><?php echo $listPing[0]->ping; ?></strong>,
		</div>
	</div>
</div>
