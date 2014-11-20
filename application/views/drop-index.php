<div class="starter-template">
	<h2># Disconnessioni</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Tabella delle disconnessioni <?php if (!isset($this->all)) { echo $this->today; }; ?></h3>
	<div id="tab">
	<table class="table">
	<thead>
		<tr>
			<th class="sort" data-sort="id">#</th>
			<th class="sort" data-sort="time">Ora</th>
			<th class="sort" data-sort="durata">Duata</th>
		</tr>
	</thead>
	<tbody class="list">
<?php
	$i = 1;
	$secs = 0;
	foreach ($this->list as $item) {
?>
		<tr>
			<td class="id"><?php echo $i ?></td>
			<td class="time"><?php if (isset($item->time)) echo htmlspecialchars($item->time, ENT_QUOTES, 'UTF-8'); ?></td>
			<td class="durata"><?php if (isset($item->durata)) echo htmlspecialchars(gmdate('H:i:s',$item->durata), ENT_QUOTES, 'UTF-8'); ?></td>
		</tr>
<?php
		$i++;
		$secs = $secs + $item->durata;
	}
?>
	</tbody>
	<tr>
		<td>Totale durata</td>
		<td>#################</td>
		<td><?php echo gmdate("z H:i:s", $secs) ?>*</td>
	</tr>
	</table>
	</div>
	<p class="text-right"><small>* days hours:minutes:seconds</small></p>
</div>
<script>
	var options = {
		valueNames: [ 'id', 'time', 'durata' ]
	};
</script>