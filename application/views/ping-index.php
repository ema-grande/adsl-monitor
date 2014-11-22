<div class="starter-template">
	<h2>ADSL Speed</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Tabella ping alti <?php if (!isset($this->all)) { echo $this->today; }; ?></h3>
	<div id="tab">
	<?php if (count($this->list) >= 200){ ?><ul class="pagination paginationTop"></ul><?php } ?>
	<table class="table">
	<thead>
		<tr>
			<th class="sort" data-sort="id">#</th>
			<th class="sort" data-sort="time">Ora</th>
			<th class="sort" data-sort="ping">Ping</th>
		</tr>
	</thead>
	<tbody class="list">
<?php
	$i = 1;
	foreach ($this->list as $item) {
?>
		<tr>
			<td class="id"><?php echo $i ?></td>
			<td class="time"><?php if (isset($item->time)) echo htmlspecialchars($item->time, ENT_QUOTES, 'UTF-8'); ?></td>
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
