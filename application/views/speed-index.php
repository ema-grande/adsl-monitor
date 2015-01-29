<!-- speed-index -->
<div class="container starter-template">
	<h2 class="page-header">ADSL Speed</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Download speed table for <?php printf("%s", $this->section) ?></h3>
	<div>Telecom Alice 7 mega:
		<ul>
			<li>Guaranteed bandwidth <?php printf("%.1f", BB_LIMIT) ?> Mbps/s</li>
			<li>Transmission delay (ping) <?php printf("%d", PING_LIMIT) ?> ms</li>
		</ul>
	</div>
	<div id="tab">
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationTop"></ul><?php } ?>
	<table class="table">
	<thead>
		<tr>
			<th class="sort" data-sort="id">#</th>
			<th class="sort" data-sort="time">Time</th>
			<th class="sort" data-sort="dl">Download</th>
			<th class="sort" data-sort="up">Upload</th>
			<th class="sort" data-sort="ping">Ping</th>
		</tr>
	</thead>
	<tbody class="list">
<?php
	$i = 1;
	$now = time();
	foreach ($this->list as $item) {
		$speed=(float) substr($item->dl, 0, strpos($item->dl, " "));
		$p=(int) substr($item->ping, 0, strpos($item->ping, " "));

		$diff = $now - $item->time;
?>
		<tr>
			<td class="id"><?php printf("%d", $i) ?></td>
		<?php if( $diff < 7200 ) { 
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
			<td class="time"><?php if (isset($item->time)) printf("%s", htmlspecialchars(date("Y-m-d H:i", $item->time), ENT_QUOTES, 'UTF-8')); ?></td>
		<?php } ?>
			<td class="dl"><?php
				if (isset($item->dl)) printf("%s", htmlspecialchars($item->dl, ENT_QUOTES, 'UTF-8'));
				if ( $speed < BB_LIMIT and $speed != 0 ) printf('<span class="label label-default">LOW</span>'); ?></td>
			<td class="up"><?php if (isset($item->up)) printf("%s", htmlspecialchars($item->up, ENT_QUOTES, 'UTF-8')); ?></td>
			<td class="ping"><?php
				if (isset($item->ping)) printf("%s", htmlspecialchars($item->ping, ENT_QUOTES, 'UTF-8'));
				if ( $p > PING_LIMIT ) printf('<span class="label label-default">HIGH</span>'); ?></td>
		</tr>
<?php		$i++;
			$last = $item->time;
	} ?>
	</tbody>
	<?php if (isset($this->avg)) {?>
	<tbody>
		<tr>
			<td>Avarage</td>
			<td></td>
			<td><?php printf("%.2f Mbit/s", $this->avg['dl']); if ( $this->avg['dl'] < BB_LIMIT and $speed != 0 ) printf('<span class="label label-default">LOW</span>'); ?></td>
			<td><?php printf("%.2f Mbit/s", $this->avg['up']) ?></td>
			<td><?php printf("%.0f ms", $this->avg['ping']); if ( $this->avg['ping'] > PING_LIMIT ) printf('<span class="label label-default">HIGH</span>'); ?></td>
		</tr>
	</tbody><?php } ?>
	</table>
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationBot"></ul><?php } ?>
	</div>
</div>
<script>
	var options = {
		valueNames: [ 'id', 'time', 'dl', 'up', 'ping' ]
	};
</script>
<!-- / speed-index -->
