<div class="starter-template">
	<h2>ADSL Speed</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Download speed table <?php if (!isset($this->all)) { echo $this->today." ".date("H:i:s"); }; ?></h3>
	<div>Telecom Alice 7 mega:
		<ul>
			<li>Guaranteed bandwidth <?php echo BB_LIMIT ?> Mbps/s</li>
			<li>Transmission delay (ping) <?php echo PING_LIMIT ?> ms</li>
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
		<tr>
			<td class="id"><?php echo "" ?></td>
			<td class="time"><?php echo htmlspecialchars($this->list->avg['num'], ENT_QUOTES, 'UTF-8');?></td>
			<td class="dl"><?php echo htmlspecialchars($this->list->avg['dl'], ENT_QUOTES, 'UTF-8');?></td>
			<td class="up"><?php echo htmlspecialchars($this->list->avg['up'], ENT_QUOTES, 'UTF-8'); ?></td>
			<td class="ping"><?php echo htmlspecialchars($this->list->avg['ping'], ENT_QUOTES, 'UTF-8');?></td>
		</tr>
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
