<div class="starter-template">
	<h2>ADSL Avarage Speed</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Download average speed <?php if (!isset($this->all)) { echo $this->today." ".date("H:i:s"); }; ?></h3>
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
			<td class="time"><?php echo round($this->avg['num'], 2) ?></td>
			<td class="dl"><?php echo round($this->avg['dl'], 2)." Mbit/s"?></td>
			<td class="up"><?php echo round($this->avg['up'], 2)." Mbit/s" ?></td>
			<td class="ping"><?php echo round($this->avg['ping'], 2)." ms" ?></td>
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
