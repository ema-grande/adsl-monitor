<!-- ping -->
<div class="container starter-template">
	<h2 class="page-header">ADSL Ping</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Ping table<?php printf(" for %s %s", $this->section, $this->today) ?></h3>
<?php
	$listCount = count($this->list);
	if ( $listCount != 0 ) {
?>
	<div id="tab">
	<?php if ($listCount >= 200){ ?><ul class="pagination paginationTop"></ul><?php } ?>
	<table class="table">
	<thead>
		<tr>
			<th class="sort" data-sort="id">#</th>
			<th class="sort" data-sort="time">Time</th>
			<th class="sort" data-sort="ping">Ping</th>
		</tr>
	</thead>
	<tbody class="list">
<?php
	$i = 1;
	$now = time();
	foreach ($this->list as $item) {
		$diff = $now - $item->time;
?>
		<tr>
			<td class="id"><?php printf("%d", $i) ?></td>
		<?php if( $diff < 1800 ) { 
			$diffH = gmdate("H", $diff);
			$diffMin = gmdate("i", $diff);
			$diffSec = gmdate("s", $diff); ?>
			<td class="time"><?php
				if (isset($item->time)) {
					$time = "";
					( $diffH != "00" ) ? $time = $time . "$diffH h " : $time;
					( $diffMin != "00" ) ? $time = $time . "$diffMin min " : $time;
					$time = $time . "$diffSec sec ago";
					printf("%s", $time);
				} ?></td>
		<?php } else { ?>
			<td class="time"><?php if (isset($item->time)) printf("%s", htmlspecialchars(date("Y-m-d H:i:s", $item->time), ENT_QUOTES, 'UTF-8')); ?></td>
		<?php } ?>
			<td class="ping"><?php if (isset($item->ping)) printf("%s", htmlspecialchars($item->ping, ENT_QUOTES, 'UTF-8')); ?></td>
		</tr>
<?php		$i++;
	}
?>
	</tbody>
	</table>
	<?php if ($listCount >= 200){ ?><ul class="pagination paginationBot"></ul><?php } ?>
	</div>
<?php } else { ?>
	<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-alert"></span>
		<span class="sr-only">Warning:</span>
		Nothing to show here!
	</div>
<?php } ?>
</div>
<script>
	var options = {
		valueNames: [ 'id', 'time', 'ping' ]
	};
</script>
<!-- / ping -->
