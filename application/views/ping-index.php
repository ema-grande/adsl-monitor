<div class="starter-template">
	<h2>Ping</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Ping table <?php if (!isset($this->all)) { echo $this->today; }; ?></h3>
	<div id="tab">
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationTop"></ul><?php } ?>
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
		$diff = $now - strtotime($item->time);
		$diffH = gmdate("H", $diff);
		$diffMin = gmdate("i", $diff);
		$diffSec = gmdate("s", $diff);
?>
		<tr>
			<td class="id"><?php echo $i ?></td>
		<?php if( $diff < 1800 ) { ?>
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
			<td class="ping"><?php if (isset($item->ping)) echo htmlspecialchars($item->ping, ENT_QUOTES, 'UTF-8'); ?></td>
		</tr>
<?php		$i++;
	}
?>
	</tbody>
	</table>
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationBot"></ul><?php } ?>
	</div>
</div>
<script>
	var options = {
		valueNames: [ 'id', 'time', 'ping' ]
	};
</script>
