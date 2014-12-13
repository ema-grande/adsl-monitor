<div class="starter-template">
	<h2>ADSL Speed</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Tabella velocit&agrave; download <?php if (!isset($this->all)) { echo $this->today; }; ?></h3>
	<div>Telecom Alice 7 mega:
		<ul>
			<li>Banda garantita <?php echo BB_LIMIT ?> Mbps/s</li>
			<li>Ritardo di trasmissione (ping) <?php echo PING_LIMIT ?> ms</li>
		</ul>
	</div>
	<div id="tab">
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationTop"></ul><?php } ?>
	<table class="table">
	<thead>
		<tr>
			<th class="sort" data-sort="id">#</th>
			<th class="sort" data-sort="time">Ora</th>
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

		$diff = $now - strtotime($item->time);
		$diffH = gmdate("H", $diff);
		$diffMin = gmdate("i", $diff);
		$diffSec = gmdate("s", $diff);
?>
		<tr>
			<td class="id"><?php echo $i ?></td>
		<?php if( $diff < 7200 ) { ?>
			<td class="time"><?php
				if (isset($item->time)) {
					$time = "";
					( $diffH != "00" ) ? $time = $time . "$diffH h " : $time;
					( $diffMin != "00" ) ? $time = $time . "$diffMin min " : $time;
					$time = $time . "$diffSec sec ago";
					echo $time;
				} ?></td>
		<?php } else { ?>
			<td class="time"><?php if (isset($item->time)) echo htmlspecialchars($item->time, ENT_QUOTES, 'UTF-8'); ?></td>
		<?php } ?>
			<td class="dl"><?php
				if (isset($item->dl)) echo htmlspecialchars($item->dl, ENT_QUOTES, 'UTF-8');
				if ( $speed < BB_LIMIT and $speed != 0 ) printf('<span class="label label-default">LOW</span>'); ?></td>
			<td class="up"><?php if (isset($item->up)) echo htmlspecialchars($item->up, ENT_QUOTES, 'UTF-8'); ?></td>
			<td class="ping"><?php
				if (isset($item->ping)) echo htmlspecialchars($item->ping, ENT_QUOTES, 'UTF-8');
				if ( $p > PING_LIMIT ) printf('<span class="label label-default">HIGH</span>'); ?></td>
		</tr>
<?php		$i++;
			$last = $item->time;
	}
?>
	</tbody>
	</table>
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationBot"></ul><?php } ?>
	</div>
</div>
<script>
	var options = {
		valueNames: [ 'id', 'time', 'dl', 'up', 'ping' ]
	};
</script>
